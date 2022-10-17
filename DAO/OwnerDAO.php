<?php
    namespace DAO;

    use DAO\I_OwnerDAO as I_OwnerDAO;
    use Models\Owner as Owner;

    class OwnerDao implements I_OwnerDAO
    {
        private $ownerList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/Owners.json";
        }

        function Add(Owner $owner)
        {
            $this->RetrieveData();

            $owner->setId_owner($this->GetNextId());

            array_push($this->ownerList, $owner);

            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();

            return $this->ownerList;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $Owners = array_filter($this->ownerList, function($owner) use($id){
                return $owner->getId_owner() == $id;
            });

            $Owners = array_values($Owners); //Reorderding array

            return (count($Owners) > 0) ? $Owners[0] : null;
        }

        function GetByEmail($email)
        {
            $this->RetrieveData();

            $Owners = array_filter($this->ownerList, function($owner) use($email){
                return $owner->getEmail() == $email;
            });

            $Owners = array_values($Owners); //Reorderding array

            return (count($Owners) > 0) ? $Owners[0] : null;
        }

        function GetByDni($dni)
        {
            $this->RetrieveData();

            $Owners = array_filter($this->ownerList, function($owner) use($dni){
                return $owner->getDni() == $dni;
            });

            $Owners = array_values($Owners); //Reorderding array

            return (count($Owners) > 0) ? $Owners[0] : null;
        }
    
        function Remove($id)
        {
            $this->RetrieveData();

            $this->ownerList = array_filter($this->ownerList, function($owner) use($id){
                return $ownerList->getId_owner() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->ownerList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $owner = new Owner();
                     $owner->setId_owner($content["id"]);
                     $owner->setName($content["name"]);
                     $owner->setLast_name($content["last_name"]);
                     $owner->setDni($content["dni"]);
                     $owner->setTelephone($content["telephone"]);
                     $owner->setEmail($content["email"]);
                     $owner->setPassword($content["password"]);
                     $owner->setPets($content["pets"]);

                     array_push($this->ownerList, $owner);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->ownerList as $owner)
            {
                $valuesArray = array();
                $valuesArray["id"] = $owner->getId_owner();
                $valuesArray["name"] = $owner->getName();
                $valuesArray["last_name"] = $owner->getLast_name();
                $valuesArray["dni"] = $owner->getDni();
                $valuesArray["telephone"] = $owner->getTelephone();
                $valuesArray["email"] = $owner->getEmail();
                $valuesArray["password"] = $owner->getPassword();
                $valuesArray["pets"] = $owner->getPets();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->ownerList as $owner)
            {
                $id = ($owner->getId_owner() > $id) ? $owner->getId_owner() : $id;
            }

            return $id + 1;
        }
    }
?>