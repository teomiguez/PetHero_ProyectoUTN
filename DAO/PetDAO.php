<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\Pet as Pet;

    class PetDao implements I_DAO
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
    
            function GetById($id)
            {
                $this->RetrieveData();
    
                $Pets = array_filter($this->petList, function($pet) use($id){
                    return $pet->getId_pet() == $id;
                });
    
                $Pets = array_values($Pets); //Reorderding array
    
                return (count($Pets) > 0) ? $Pets[0] : null;
            }
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
                         $pet->setId_guardian($content["id_guardian"]);
                         $pet->setImg($content["img"]);
                         $pet->setName($content["name"]);
                         $pet->setSize($content["size"]);
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
                    $valuesArray["id"] = $pet->getId_pet();
                    $valuesArray["id_dueño"] = $pet->getId_owner();
                    $valuesArray["id_guardian"] = $pet->getId_guardian();
                    $valuesArray["img"] = $pet->getImg();
                    $valuesArray["name"] = $pet->getName();
                    $valuesArray["tamaño"] = $pet->getSize();
                    $valuesArray["video"] = $pet->getVideo();
                    $valuesArray["obs"] = $pet->getInfo();
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
                    $id = ($pet->getId_mascota() > $id) ? $pet->getId_pet() : $id;
                }
    
                return $id + 1;
            }
    
    ?>