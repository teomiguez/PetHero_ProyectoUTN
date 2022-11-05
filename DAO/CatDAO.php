<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\Pet as Pet;
    use Models\Cat as Cat;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException;

    class CatDAO implements I_DAO
    {
        private $catList = array();
        private $fileName = ROOT . "Data/Cats.json";

        private $connection;

        // -> PUBLIC FUNCTIONS

        function Add(Cat $cat)
        {
            $this->RetrieveData();
    
            $cat->setId($this->GetNextId());
    
            array_push($this->catList, $cat);
    
            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();
    
            return $this->catList;
        }
        
        function GetById($id)
        {
            $this->RetrieveData();
    
            $Cats = array_filter($this->catList, function($cat) use ($id){
                return $cat->getId() == $id;
            });
    
            $Cats = array_values($Cats); //Reorderding array
    
            return (count($Cats) > 0) ? $Cats[0] : null;
        }

        function GetByOwner($id_owner)
        {
            $this->RetrieveData();
                
            $catList = array_filter($this->catList, function ($cat) use ($id_owner) 
            {
                return $cat->getId_owner() == $id_owner;
            });

            return $catList;
        }

        function Remove($id)
        {
            $this->RetrieveData();
    
            $this->catList = array_filter($this->catList, function($cat) use($id){
                return $cat->getId() != $id;
            });
    
            $this->SaveData();
        }

        // <- PUBLIC FUNCTIONS

        // -> PRIVATE FUNCTIONS
        
        private function RetrieveData()
        {
             $this->catList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                    $cat = new Cat();
                    $cat->setId($content["id_cat"]);
                    $cat->setId_owner($content["id_owner"]);
                    $cat->setImg($content["img"]);
                    $cat->setName($content["name"]);
                    $cat->setType($content["type"]);
                    $cat->setBreed($content['breed']);
                    $cat->setSize($content["size"]);
                    $cat->setPlanVacunacion($content["pv"]);
                    $cat->setVideo($content["video"]);
                    $cat->setInfo($content["info"]);
                    array_push($this->catList, $cat);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->catList as $cat)
            {
                $valuesArray = array();
                $valuesArray["id_cat"] = $cat->getId();
                $valuesArray["id_owner"] = $cat->getId_owner();
                $valuesArray["img"] = $cat->getImg();
                $valuesArray["name"] = $cat->getName();
                $valuesArray["type"] = $cat->getType();
                $valuesArray["breed"] = $cat->getBreed();
                $valuesArray["size"] = $cat->getSize();
                $valuesArray["pv"] = $cat->getPlanVacunacion();
                $valuesArray["video"] = $cat->getVideo();
                $valuesArray["info"] = $cat->getInfo();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->catList as $cat)
            {
                $id = ($cat->getId() > $id) ? $cat->getId() : $id;
            }

            return $id + 1;
        }

        // <- PRIVATE FUNCTIONS
    }

?>