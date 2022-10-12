<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\Guardian as Guardian;

    class GuardianDao implements I_DAO
    {
        private $guardianList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/Guardianes.json";
        }

        function Add(Guardian $guardian)
        {
            $this->RetrieveData();

            $guardian->setId_guardian($this->GetNextId());

            array_push($this->guardianList, $guardian);

            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();

            return $this->guardianList;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $Guardianes = array_filter($this->guardianList, function($guardian) use ($id) {
                return $guardian->getId_guardian() == $id;
            });

            $Guardianes = array_values($Guardianes); //Reorderding array

            return (count($Guardianes) > 0) ? $Guardianes[0] : null;
        }
    }

    function Remove($id)
        {
            $this->RetrieveData();

            $this->guardianList = array_filter($this->guardianList, function($guardian) use($id){
                return $guardian->getId_guardian() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->guardianList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $guardian = new Guardian();
                     $guardian->setId_guardian($content["id_guardian"]);
                     $guardian->setName($content["name"]);
                     $guardian->setLast_name($content["last_name"]);
                     $guardian->setDni($content["dni"]);
                     $guardian->setTelephone($content["telephone"]);
                     $guardian->setAddress($content["address"]);
                     $guardian->setEmail($content["email"]);
                     $guardian->setPassword($content["password"]);
                     $guardian->setRating($content["rating"]);
                     $guardian->setSizeCare($content["sizeCare"]);
                     $guardian->setCost($content["cost"]);
                     $guardian->setDays($content["days"]);
                     array_push($this->dueñoList, $dueño);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->guardianList as $guardian)
            {
                $valuesArray = array();
                $valuesArray["id_guardian"] = $guardian->getId_guardian();
                $valuesArray["name"] = $guardian->getName();
                $valuesArray["last_name"] = $guardian->getLast_name();
                $valuesArray["dni"] = $guardian->getDni();
                $valuesArray["telephone"] = $guardian->getTelephone();
                $valuesArray["address"] = $guardian->getAddress();
                $valuesArray["email"] = $guardian->getEmail();
                $valuesArray["password"] = $guardian->getPassword();
                $valuesArray["rating"] = $guardian->getReputacion();
                $valuesArray["sizeCare"] = $guardian->getSizeCare();
                $valuesArray["cost"] = $guardian->getCost();
                $valuesArray["days"] = $guardian->getDays();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->guardianList as $guardian)
            {
                $id = ($guardian->getId_guardian() > $id) ? $guardian->getId_guardian() : $id;
            }

            return $id + 1;
        }

?>