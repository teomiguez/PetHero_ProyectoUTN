<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Dueño as Dueño;

    class DueñoDao implements IDAO
    {
        private $dueñoList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/Dueños.json";
        }

        function Add(Dueño $dueño)
        {
            $this->RetrieveData();

            $dueño->setId_dueño($this->GetNextId());

            array_push($this->dueñoList, $dueño);

            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();

            return $this->dueñoList;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $Dueños = array_filter($this->dueñoList, function($dueño) use($id){
                return $dueño->getId_dueño() == $id;
            });

            $Dueños = array_values($Dueños); //Reorderding array

            return (count($Dueños) > 0) ? $Dueños[0] : null;
        }
    }

    function Remove($id)
        {
            $this->RetrieveData();

            $this->dueñoList = array_filter($this->dueñoList, function($dueño) use($id){
                return $dueño->getId_dueño() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->dueñoList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $dueño = new Dueño();
                     $dueño->setId_dueño($content["id"]);
                     $dueño->setNombre($content["name"]);
                     $dueño->setApellido($content["last_name"]);
                     $dueño->setDni($content["dni"]);
                     $dueño->setTelefono($content["tel"]);
                     $dueño->setEmail($content["email"]);
                     $dueño->setContraseña($content["password"]);
                     $dueño->setMascotas($content["mascotas"]);

                     array_push($this->dueñoList, $dueño);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->dueñoList as $dueño)
            {
                $valuesArray = array();
                $valuesArray["id"] = $dueño->getId_dueño();
                $valuesArray["name"] = $dueño->getNombre();
                $valuesArray["dni"] = $dueño->getDni();
                $valuesArray["tel"] = $dueño->getTelefono();
                $valuesArray["email"] = $dueño->getEmail();
                $valuesArray["password"] = $dueño->getContraseña();
                $valuesArray["mascotas"] = $dueño->getMascotas();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->dueñoList as $dueño)
            {
                $id = ($dueño->getId_dueño() > $id) ? $dueño->getId_dueño() : $id;
            }

            return $id + 1;
        }

?>