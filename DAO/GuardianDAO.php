<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Guardian as Guardian;

    class GuardianDao implements IDAO
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

            $Guardianes = array_filter($this->guardianList, function($guardian) use($id){
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
                     $guardian->setId_guardian($content["id"]);
                     $guardian->setNombre($content["name"]);
                     $guardian->setApellido($content["last_name"]);
                     $guardian->setDni($content["dni"]);
                     $guardian->setTelefono($content["tel"]);
                     $guardian->setDireccion($content["direc"]);
                     $guardian->setEmail($content["email"]);
                     $guardian->setContraseña($content["password"]);
                     $guardian->setReputacion($content["reputacion"]);
                     $guardian->setTamañoMascotaPref($content["tamañoMascotaPref"]);
                     $guardian->setPrecio($content["precio"]);
                     $guardian->setFechasDisponibles($content["fechasDisponibles"]);
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
                $valuesArray["id"] = $guardian->getId_guardian();
                $valuesArray["name"] = $guardian->getNombre();
                $valuesArray["last_name"] = $guardian->getApellido();
                $valuesArray["dni"] = $guardian->getDni();
                $valuesArray["tel"] = $guardian->getTelefono();
                $valuesArray["direc"] = $guardian->getDireccion();
                $valuesArray["email"] = $guardian->getEmail();
                $valuesArray["password"] = $guardian->getContraseña();
                $valuesArray["reputacion"] = $guardian->getReputacion();
                $valuesArray["tamañoMascotaPref"] = $guardian->getTamañoMascotaPref();
                $valuesArray["precio"] = $guardian->getPrecio();
                $valuesArray["fechasDisponibles"] = $guardian->getFechasDisponibles();
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