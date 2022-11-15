<?php
    namespace Models;

    class ReservationForPet
    {
        private $id_reservation;
        private $id_owner;
        private $id_pet;
        private $id_coupon;

        // -> SETTERS Y GETTERS

        public function getReservation()
        {
            return $this->reservation;
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