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
            $newFile->setType($file['type']);
            $newFile->setSize(getimagesize($file['tmp_name']));
        
            $fileName = $newFile->getFileName();

            $filePath = $this->uploadFilePath . basename($fileName);
        
            // Si no existe el directorio, lo crea.
            if(!file_exists($filePath))
            {
                mkdir($filePath);
            }
        
        
            $fileLocation = $filePath . $fileName;	// ruta completa + file.
        
            //Obtenemos la extensión del file. Nos sirve para comprobar el verdadero $type del file
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
            if(in_array($fileExtension, $this->allowedExtensions) ) 
            {
                if(file_exists($fileLocation)) 
                {
                    if($newFile->getSize() < $this->maxSize) //Menor a 5 MB
                    { 
                        if(move_uploaded_file($newFile->getTempName(), $fileLocation))
                        {
                            return true;
                        }
                    }
                }
            }

            return false;
        }
    }
?>