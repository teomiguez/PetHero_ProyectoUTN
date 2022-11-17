<?php
    namespace Controllers;

    use DAO_SQL\ReservationDAO as ReservationDAO;
    use DAO_SQL\PetDAO as PetDAO;
    use DAO_SQL\PaymentCouponDAO as PaymentCouponDAO;

    use Models\Reservation as Reservation;
    use Models\Pet as Pet;
    use Models\PaymentCoupon as PaymentCoupon;
    use Models\ReservationForPet as ReservationForPet;

    class ReservationForPetController
    {
        public function __contruct()
        {

        }

        public function ChangeIdsToObjects($reservIds)
        {
            $reservationDAO = new ReservationDAO();
            $petDAO = new PetDAO();
            $paymentCouponDAO = new PaymentCouponDAO();

            $reserv = new Reservation();
            $pet = new Pet();
            $coupon = new PaymentCoupon();

            $reserv = $reservationDAO->GetById($reservIds->getReservation());
            $pet = $petDAO->GetById($reservIds->getPet());
            $coupon = $paymentCouponDAO->GetById($reservIds->getCoupon());
            
            $reservIds->setReservation($reserv);
            $reservIds->setPet($pet);
            $reservIds->setCoupon($coupon);

            return $reservIds;
        }
    }
?>