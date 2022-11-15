<?php
    namespace Controllers;
    
    use DAO\PaymentCouponDAO as PaymentCouponDAO;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReservationDAO as ReservationDAO;

    use Models\PaymentCoupon as PaymentCoupon;
    use Models\Guardian as Guardian;
    use Models\Owner as Owner; // si pasamos la id en el create no es necesario, sino si para usar el get
    use Models\Reservation as Reservation;

    use Exception;

    class PaymentCouponController 
    {
        public function __contruct()
        {
            
        }
        
        public function Create_PaymentCoupon($id_reservation, $id_pet ,$id_owner)
        {
            $paymentCouponDAO = new PaymentCouponDAO();
            $guardianDAO = new GuardianDAO();
            $reservationDAO = new ReservationDAO();

            $paymentCoupon = new PaymentCoupon();
            $reserv = new Reservation();
            $guardian = new Guardian();

            $reserv = $reservationDAO->GetById($id_reservation);
            $id_guardian = $reserv->getId_guardian();
            $guardian = $guardianDAO->GetById($id_guardian);

            $guardianCost = $guardian->getCost();
            $total_days = $reserv->getTotal_days();

            $cost = ($guardianCost * $total_days)/2;

            $paymentCoupon->setId_reservation($id_reservation);
            $paymentCoupon->setId_pet($id_pet);
            $paymentCoupon->setId_owner($id_owner);
            $paymentCoupon->setIs_payment(0);
            $paymentCoupon->setCoupon_cost($cost);

            $paymentCouponDAO->Add($paymentCoupon);
        }
    }
?>