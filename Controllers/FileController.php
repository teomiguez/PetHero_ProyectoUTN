<?php
    namespace Controllers;

    use Models\File as M_File;

    class FileController
    {
        private $uploadFilePath;
        private $allowedExtensions;
        private $maxSize;
    
        function __construct() 
        {
            $this->allowedExtensions = array('png', 'jpg', 'jpeg', 'gif', 'mp4');
            $this->maxSize = 5000000; // 5MB
            $this->uploadFilePath = FILE_UPLOADS; // en Config.php -> define("FILE_UPLOADS", "FRONT_ROOT . VIEWS_PATH . IMG_PATH . "uploads/");
        }
    
        /**
        *
        */
        public function getAllowedExtensions() 
        {
            return $this->allowedExtensions;
        }
    
        /**
         *
        */
        public function getMaxSize() 
        {
            return $this->maxSize;
        }
    
    
        /**
        * @method upluad
        *
        * @param File $file     
        * @param String $type - img, pv, video         
        */
        public function upload($file, $type) 
        {
            $newFile = new M_File();

            $newFile->setFileName($file['name']);
            $newFile->setTempName($file['tmp_name']);
            $newFile->setSize(getimagesize($newFile->getTempName()));
            $newFile->setType($file['type']);
        
            $filePath = $this->uploadFilePath . $type . "/";
        
            // Si no existe el directorio, lo crea.
            if(!file_exists($filePath))
            {
                mkdir($filePath);
            }
        
            $fileName = $newFile->getFileName();
        
            $fileLocation = $filePath . $fileName;	// ruta completa y file.
        
            //Obtenemos la extensión del file. Nos sirve para comprobar el verdadero type$type del file
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
            if(in_array($fileExtension, $this->allowedExtensions) ) 
            {
                if(file_exists($fileLocation)) 
                {
                    if($newFile->getSize() < $this->maxSize) //Menor a 5 MB
                    { 
                        move_uploaded_file($newFile->getTempName(), $fileLocation);

                        return true;
                    }
                }
            }

            return false;
        }
    }
?>