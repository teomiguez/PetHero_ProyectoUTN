<?php

    namespace Models;

    class AvStay // AviableStay 
    {
        $id_stay;
        $id_keeper;
        $first_day;
        $last_day;

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
            return $this->firstDay;
        }

        public function setFirst_day($firstDay)
        {
            $this->firstDay = $firstDay;
        }

        public function getLast_day()
        {
            return $this->lastDay;
        }

        public function setLast_day($lastDay)
        {
            $this->lastDay = $lastDay;
        }

        // -> SETTERS Y GETTERS

    }

?>