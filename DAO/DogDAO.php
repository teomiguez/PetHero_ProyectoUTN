<?php
    namespace DAO;

    use DAO\I_DogDAO as I_DogDAO;
    use Models\Pet as Pet;
    use Models\Dog as Dog;

    class DogDAO implements I_DogDAO
    {
        private $dogList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/Dogs.json";
        }

        // -> PUBLIC FUNCTIONS

        function Add(Dog $dog)
        {
            $this->RetrieveData();
    
            $dog->setId_dog($this->GetNextId());
    
            array_push($this->dogList, $dog);
    
            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();
    
            return $this->dogList;
        }
        
        function GetById($id)
        {
            $this->RetrieveData();
    
            $Dogs = array_filter($this->dogList, function($dog) use ($id){
                return $dog->getId_dog() == $id;
            });
    
            $Dogs = array_values($Dogs); //Reorderding array
    
            return (count($Dogs) > 0) ? $Dogs[0] : null;
        }

        function GetByOwner($id_owner)
        {
            $this->RetrieveData();
                
            $dogList = array_filter($this->dogList, function ($dog) use ($id_owner) 
            {
                return $dog->getId_owner() == $id_owner;
            });

            return $dogList;
        }

        function Remove($id)
        {
            $this->RetrieveData();
    
            $this->dogList = array_filter($this->dogList, function($dog) use($id){
                return $dog->getId_dog() != $id;
            });
    
            $this->SaveData();
        }

        // <- PUBLIC FUNCTIONS

        // -> PRIVATE FUNCTIONS
        
        private function RetrieveData()
        {
             $this->dogList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                    $dog = new Dog();
                    $dog->setId_dog($content["id_dog"]);
                    $dog->setId_owner($content["id_owner"]);
                    $dog->setImg($content["img"]);
                    $dog->setName($content["name"]);
                    $dog->setBreed($content['breed']);
                    $dog->setSize($content["size"]);
                    $dog->setPlanVacunacion($content["pv"]);
                    $dog->setVideo($content["video"]);
                    $dog->setInfo($content["info"]);
                    array_push($this->dogList, $dog);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->dogList as $dog)
            {
                $valuesArray = array();
                $valuesArray["id_dog"] = $dog->getId_dog();
                $valuesArray["id_owner"] = $dog->getId_owner();
                $valuesArray["img"] = $dog->getImg();
                $valuesArray["name"] = $dog->getName();
                $valuesArray["breed"] = $dog->getBreed();
                $valuesArray["size"] = $dog->getSize();
                $valuesArray["pv"] = $dog->getPlanVacunacion();
                $valuesArray["video"] = $dog->getVideo();
                $valuesArray["info"] = $dog->getInfo();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->dogList as $dog)
            {
                $id = ($dog->getId_dog() > $id) ? $dog->getId_dog() : $id;
            }

            return $id + 1;
        }

        // <- PRIVATE FUNCTIONS
    }

?>