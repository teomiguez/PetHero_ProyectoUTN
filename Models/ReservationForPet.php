<?php
    namespace Models;

    class ReservationForPet
    {
        private $reservation;
        private $id_owner;
        private $pet;
        private $coupon;

        // -> SETTERS Y GETTERS

        public function getReservation()
        {
            return $this->reservation;
        }

        public function setReservation($reservation)
        {
            return $this;
        }

        public function getId_owner()
        {
            return $this->id_owner;
        }

        public function setId_owner($id_owner)
        {
            return $this;
        }

        public function getPet()
        {
            return $this->pet;
        }

        public function setPet($pet)
        {
            return $this;
        }

        public function getCoupon()
        {
            return $this->coupon;
        }

        public function setCoupon($coupon)
        {
            return $this;
        }

        // <- SETTERS Y GETTERS
    }
?>