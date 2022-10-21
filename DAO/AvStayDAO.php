<?php

    namespace DAO;

    use DAO\I_AvStayDAO as I_AvStayDAO;
    use Models\AvStay as AvStay;

    class AvStayDAO implements I_AvStayDAO
    {
        private $stayList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/AviableStays.json";
        }

        function Add(AvStay $stay)
        {
            $this->RetrieveData();

            $stay->setId_stay($this->GetNextId());

            array_push($this->stayList, $stay);

            $this->SaveData();
        }
        
        function GetAll()
        {
            $this->RetrieveData();

            return $this->stayList;
        }
        
        function GetByKeeper($id_keeper)
        {
            $this->RetrieveData();
            
            $AvStays = array_filter($this->stayList, function ($stay) use ($id_keeper) 
            {
                return $stay->getId_keeper() == $id_keeper;
            });

            return $AvStays;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $AvStays = array_filter($this->stayList, function($stay) use ($id) {
                return $stay->getId_stay() == $id;
            });

            $AvStays = array_values($AvStays); //Reorderding array

            return (count($AvStays) > 0) ? $AvStays[0] : null;
        }

        //function Update($id); -> (ver)
        
        function Remove($id)
        {
            $this->RetrieveData();

            $this->stayList = array_filter($this->stayList, function($stay) use($id){
                return $stay->getId_stay() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->stayList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $stay = new AvStay();
                     $stay->setId_stay($content["id_stay"]);
                     $stay->setId_keeper($content["id_keeper"]);
                     $stay->setFirst_day($content["first_day"]);
                     $stay->setLast_day($content["last_day"]);

                     array_push($this->stayList, $stay);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->stayList as $stay)
            {
                $valuesArray = array();
                $valuesArray["id_stay"] = $stay->getId_stay();
                $valuesArray["id_keeper"] = $stay->getId_keeper();
                $valuesArray["first_day"] = $stay->getFirst_day();
                $valuesArray["last_day"] = $stay->getLast_day();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->stayList as $stay)
            {
                $id = ($stay->getId_stay() > $id) ? $stay->getId_stay() : $id;
            }

            return $id + 1;
        }
    }

?>