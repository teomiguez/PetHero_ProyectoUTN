<?php
    namespace DAO;

    use DAO\I_PetDAO as I_PetDAO;
    use Models\Pet as Pet;

    class PetDao implements I_PetDAO
    {
        private $petList = array();
        private $fileName;

            public function __construct() 
            {
                $this->fileName = dirname(__DIR__)."/Data/Pets.json";
            }
    
            function Add(Pet $pet)
            {
                $this->RetrieveData();
    
                $pet->setId_pet($this->GetNextId());
    
                array_push($this->petList, $pet);
    
                $this->SaveData();
            }
    
            function GetAll()
            {
                $this->RetrieveData();
    
                return $this->petList;
            }

            function GetByOwner($id_owner)
            {
                $this->RetrieveData();
                
                $petList = array_filter($this->petList, function ($pet) use ($id_owner) 
                {
                    return $pet->getId_owner() == $id_owner;
                });

                return $petList;
            }
    
            function GetById($id)
            {
                $this->RetrieveData();
    
                $Pets = array_filter($this->petList, function($pet) use ($id){
                    return $pet->getId_pet() == $id;
                });
    
                $Pets = array_values($Pets); //Reorderding array
    
                return (count($Pets) > 0) ? $Pets[0] : null;
            }
    
            function Remove($id)
            {
                $this->RetrieveData();
    
                $this->petList = array_filter($this->petList, function($pet) use($id){
                    return $pet->getId_pet() != $id;
                });
    
                $this->SaveData();
            }
    
            private function RetrieveData()
            {
                 $this->petList = array();
    
                 if(file_exists($this->fileName))
                 {
                     $jsonToDecode = file_get_contents($this->fileName);
    
                     $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                     
                     foreach($contentArray as $content)
                     {
                         $pet = new Pet();
                         $pet->setId_pet($content["id_pet"]);
                         $pet->setId_owner($content["id_owner"]);
                         $pet->setImg($content["img"]);
                         $pet->setName($content["name"]);
                         $pet->setBreed($content['breed']);
                         $pet->setSize($content["size"]);
                         $pet->setPlanVacunacion($content["pv"]);
                         $pet->setVideo($content["video"]);
                         $pet->setInfo($content["info"]);
                         array_push($this->petList, $pet);
                     }
                 }
            }
    
            private function SaveData()
            {
                $arrayToEncode = array();
    
                foreach($this->petList as $pet)
                {
                    $valuesArray = array();
                    $valuesArray["id_pet"] = $pet->getId_pet();
                    $valuesArray["id_owner"] = $pet->getId_owner();
                    $valuesArray["img"] = $pet->getImg();
                    $valuesArray["name"] = $pet->getName();
                    $valuesArray["breed"] = $pet->getBreed();
                    $valuesArray["size"] = $pet->getSize();
                    $valuesArray["pv"] = $pet->getPlanVacunacion();
                    $valuesArray["video"] = $pet->getVideo();
                    $valuesArray["info"] = $pet->getInfo();
                    array_push($arrayToEncode, $valuesArray);
                }
    
                $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
    
                file_put_contents($this->fileName, $fileContent);
            }
    
            private function GetNextId()
            {
                $id = 0;
    
                foreach($this->petList as $pet)
                {
                    $id = ($pet->getId_pet() > $id) ? $pet->getId_pet() : $id;
                }
    
                return $id + 1;
            }
    }
?>