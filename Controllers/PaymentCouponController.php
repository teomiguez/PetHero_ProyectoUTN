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
        
        public function Create_PaymentCoupon($id_reservation, $id_owner) // ver cuando llamo la función si puedo pasar las ids o los objetos completos (ahorramos el buscarlos en el DAO) -> VER
        {
            $paymentCouponDAO = new PaymentCouponDAO();
            $guardianDAO = new GuardianDAO();
            $reservationDAO = new ReservationDAO();

            $paymentCoupon = new PaymentCoupon();
            $reserv = new Reservation();
            $guardian = new Guardian();

            $reserv = $reservationDAO->GetById($id_reservation);
            $guardian = $guardianDAO->GetById($reserv->getId_guardia());

            $guardianCost = $guardian->getCost();
            $total_days = $reserv->getTotal_days();

            $cost = ($guardianCost * $total_days)/2;

            $paymentCouponDAO->setId_reservation($id_reservation);
            $paymentCouponDAO->setId_owner($id_owner);
            $paymentCouponDAO->setIs_payment(0);
            $paymentCouponDAO->setCoupon_cost($cost);

            $paymentCouponDAO->Add($paymentCoupon);
        }
    }
?>