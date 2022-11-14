<?php
    namespace Models;

    class PaymentCoupon
    {
        private $id_paymentCoupon;
        private $id_reservation;
        private $id_owner;
        private $is_payment;
        private $coupon_cost;

        // -> SETTERS Y GETTERS
        
        public function getId_paymentCoupon()
        {
            return $this->id_paymentCoupon;
        }

        public function setId_paymentCoupon($id_paymentCoupon)
        {
            return $this;
        }

        public function getId_reservation()
        {
            return $this->id_reservation;
        }

        public function setId_reservation($id_reservation)
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
 
        public function getIs_payment()
        {
            return $this->is_payment;
        }

        public function setIs_payment($is_payment)
        {
            return $this;
        }

        public function getCoupon_cost()
        {
            return $this->coupon_cost;
        }

        public function setCoupon_cost($coupon_cost)
        {
            return $this;
        }

        // <- SETTERS Y GETTERS
    }
?>