<?php
    namespace Models;

    class File
    {
        private $fileName;
        private $tempName;
        private $size;
        private $type; // png, jpg, jpeg, gif, mp4


        public function getFileName()
        {
            return $this->fileName;
        }

        public function setFileName($fileName)
        {
            $this->fileName = $fileName;
        }
        
        public function getTempName()
        {
            return $this->tempName;
        }

        public function setTempName($tempName)
        {
            $this->tempName = $tempName;
        }
 
        public function getSize()
        {
            return $this->size;
        }

        public function setSize($size)
        {
            $this->size = $size;
        }

        public function getType()
        {
            return $this->type;
        }

        public function setType($type)
        {
            $this->type = $type;
        }
    }
?>