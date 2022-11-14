<?php
    namespace Controllers;

    use DAO\ReservationDAO as ReservationDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\PaymentCouponDAO as PaymentCouponDAO;

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
            // completar, cambiar todas las ids (reserva, mascota, cupon) por los objetos objetos
        }
    }
?>