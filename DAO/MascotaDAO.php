<?php
    namespace DAO;

    use DAO\IDAO as IDAO;
    use Models\Mascota as Mascota;

    class MascotaDao implements IDAO
    {
        private $mascotaList = array();
        private $fileName;

            public function __construct() 
            {
                $this->fileName = dirname(__DIR__)."/Data/Mascotas.json";
            }
    
            function Add(Mascota $mascota)
            {
                $this->RetrieveData();
    
                $mascota->setId_mascota($this->GetNextId());
    
                array_push($this->mascotaList, $mascota);
    
                $this->SaveData();
            }
    
            function GetAll()
            {
                $this->RetrieveData();
    
                return $this->mascotaList;
            }
    
            function GetById($id)
            {
                $this->RetrieveData();
    
                $Mascotas = array_filter($this->mascotaList, function($mascota) use($id){
                    return $mascota->getId_mascota() == $id;
                });
    
                $Mascotas = array_values($Mascotas); //Reorderding array
    
                return (count($Mascotas) > 0) ? $Mascotas[0] : null;
            }
        }
    
        function Remove($id)
            {
                $this->RetrieveData();
    
                $this->mascotaList = array_filter($this->mascotaList, function($mascota) use($id){
                    return $mascota->getId_mascota() != $id;
                });
    
                $this->SaveData();
            }
    
            private function RetrieveData()
            {
                 $this->mascotaList = array();
    
                 if(file_exists($this->fileName))
                 {
                     $jsonToDecode = file_get_contents($this->fileName);
    
                     $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                     
                     foreach($contentArray as $content)
                     {
                         $mascota = new Mascota();
                         $mascota->setId_mascota($content["id"]);
                         $mascota->setId_dueño($content["id_dueño"]);
                         $mascota->setId_guardian($content["id_guardian"]);
                         $mascota->setImg($content["img"]);
                         $mascota->setNombre($content["name"]);
                         $mascota->setAnimal($content["animal"]);
                         $mascota->setTamaño($content["tamaño"]);
                         $mascota->setVideo($content["video"]);
                         $mascota->setObservaciones($content["obs"]);
                         array_push($this->mascotaList, $mascota);
                     }
                 }
            }
    
            private function SaveData()
            {
                $arrayToEncode = array();
    
                foreach($this->mascotaList as $mascota)
                {
                    $valuesArray = array();
                    $valuesArray["id"] = $mascota->getId_mascota();
                    $valuesArray["id_dueño"] = $mascota->getId_dueño();
                    $valuesArray["id_guardian"] = $mascota->getId_guardian();
                    $valuesArray["img"] = $mascota->getImg();
                    $valuesArray["name"] = $mascota->getNombre();
                    $valuesArray["animal"] = $mascota->getAnimal();
                    $valuesArray["tamaño"] = $mascota->getTamaño();
                    $valuesArray["video"] = $mascota->getVideo();
                    $valuesArray["obs"] = $mascota->getObservaciones();
                    array_push($arrayToEncode, $valuesArray);
                }
    
                $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
    
                file_put_contents($this->fileName, $fileContent);
            }
    
            private function GetNextId()
            {
                $id = 0;
    
                foreach($this->mascotaList as $mascota)
                {
                    $id = ($mascota->getId_mascota() > $id) ? $mascota->getId_mascota() : $id;
                }
    
                return $id + 1;
            }
    
    ?>