<?php

    namespace Models;

    class AvStay // AviableStay 
    {
        private $id_stay;
        private $id_keeper;
        private $first_day;
        private $last_day;

        // -> SETTERS Y GETTERS

        public function getId_stay()
        {
            return $this->id_stay;
        }

        public function setId_stay($id_stay)
        {
            $this->id_stay = $id_stay;
        }

        public function getId_keeper()
        {
            return $this->id_keeper;
        }

        public function setId_keeper($id_keeper)
        {
            $this->id_keeper = $id_keeper;
        }

        public function getFirst_day()
        {
            return $this->first_day;
        }

        public function setFirst_day($first_day)
        {
            $this->first_day = $first_day;
        }

        public function getLast_day()
        {
            return $this->last_day;
        }

        public function setLast_day($last_day)
        {
            $this->last_day = $last_day;
        }

        // -> SETTERS Y GETTERS

    }

?>