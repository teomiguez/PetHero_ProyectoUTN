<?php
    namespace Models;

    class ReservationForPet
    {
        private $id_reservation;
        private $id_owner;
        private $id_pet;
        private $is_reviewed; //si hizo la review
        private $id_coupon;

        // -> SETTERS Y GETTERS

        public function getId_reservation()
        {
            return $this->id_reservation;
        }

        public function setId_reservation($id_reservation)
        {
            $this->id_reservation = $id_reservation;
        }

        public function getId_owner()
        {
            return $this->id_owner;
        }

        public function setId_owner($id_owner)
        {
            $this->id_owner = $id_owner;
        }

        public function getId_pet()
        {
            return $this->id_pet;
        }

        public function setId_pet($id_pet)
        {
            $this->id_pet = $id_pet;
        }

        public function getIs_reviewed()
        {
            return $this->is_reviewed;
        }

        public function setIs_reviewed($is_reviewed)
        {
            $this->is_reviewed = $is_reviewed;
        }

        public function getId_coupon()
        {
            return $this->id_coupon;
        }

        public function setId_coupon($id_coupon)
        {
            $this->id_coupon = $id_coupon;
        }

        // <- SETTERS Y GETTERS
    }
?>