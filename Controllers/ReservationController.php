<?php
    namespace Controllers;

    use Controllers\PaymentCouponController as PaymentCouponController;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\PaymentCouponDAO as PaymentCouponDAO;

    use DAO\PetDAO as PetDAO;

    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\Reservation as Reservation;
    use Models\AvStay as AvStay;

    use Exception;

    class ReservationController 
    {
        public function __contruct()
        {
            
        }

        public function Create_Reserv($id_guardian, $pet_size, $pet_breed, $first_day, $last_day, $diff_days)
        {
            $reserv->setId_guardian($id_guardian);
            $reserv->setPet_size($pet_size);
            $reserv->setPet_breed($pet_breed);
            $reserv->setFirst_day($first_day);
            $reserv->setLast_day($last_day);
            $reserv->setTotal_days($diff_days);

            $reservationDAO->AddReservation($reserv);
        }
        
        public function RequestReservation($first_day, $last_day, $id_guardian, $id_pet)
        {
            $paymentCouponController = new PaymentCouponController();
            
            $reservationDAO = new ReservationDAO();
            $guardianDAO = new GuardianDAO();
            $avstayDAO = new AvStayDAO();
            $paymentCouponDAO = new PaymentCouponDAO();
            $petDAO = new PetDAO();

            $reserv = new Reservation();
            $pet = $petDAO->GetById($id_pet);
            $guardian = $guardianDAO->GetById($id_guardian);

            try 
            {
                if ($reservationDAO->IsExist_Reserv($first_day, $last_day)) // si existe o no la reserva
                {
                    $id_exist = $reservationDAO->GetIdByDates($first_day, $last_day); // obtengo id por las fechas
    
                    if (($reservationDAO->GetSize_Condition($id_exist) == $pet->getSize()) && ($reservationDAO->GetBreed_Condition($id_exist) == $pet->getBreed())) // si la mascota cumple las condiciones de la reserva
                    {
                        $paymentCouponController->Create_PaymentCoupon($id_exist, $pet->getId_owner()); // creo el cupon
                        
                        $id_coupon = $paymentCouponDAO->GetByReservation($id_exist); // obtengo el id del cupon
                        
                        $reservationDAO->AddPet_ToReservation($id_exist, $id_coupon, $pet); // agrego la mascota a la reserva
    
                        $alert_succes = array("type" => "succes", "text" => "Se agregó la mascota a una reserva previa"); // VER
                    }
                    else
                    {
                        throw new Exception("La reserva ya existe y la mascota seleccionada no cumple con las condiciones de tamaño/raza"); // si no cumple las condiciones -> alert
                    }
                }
                else if ($avstayDAO->IsExist_Stay($id_guardian, $first_day, $last_day)) // si el guardian tiene libre esos dias
                {
                    if ($guardian->getSizeCare() == $pet->getSize())
                    {
                        $diff = 0; // ver de hacer la diferencia (tiro error con las lineas que estan en GuardianHome)
                        
                        $this->Create_Reserv($id_guardian, $pet->getSize(), $pet->getBreed(), $first_day, $last_day, $diff); // creo la reserva
                        
                        $id_reserv = $reservationDAO->GetIdByDates($first_day, $last_day); // obtengo el id de la reserva

                        $paymentCouponController->Create_PaymentCoupon($id_reserv, $pet->getId_owner()); // creo el cupon
                        
                        $id_coupon = $paymentCouponDAO->GetByReservation($id_reserv); // obtengo el id del cupon
    
                        $reservationDAO->AddPet_ToReservation($id_reserv, $id_coupon, $pet); // agrego la mascota a la reserva
        
                        $alert_succes = array("type" => "succes", "text" => "Se envió la solicitud al guardian"); // VER
                    }
                    else
                    {
                        throw new Exception("El guardian no cuida el tamaño de su mascota"); // si no cumple las condiciones -> alert
                    }
                }
                else if (!$avstayDAO->ThisGuardianIsAviable($id_guardian, $first_day, $last_day))
                {
                    throw new Exception("El guardian no tiene esas fechas disponibles"); // si no tiene libre -> alert
                }
    
                header("location: " . FRONT_ROOT . "Owner/ShowHome_Owner");
            }
            catch (Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }

        public function AcceptedReserv($id)
        {
            $reservationDAO = new ReservationDAO();
            $reservationDAO->ChangeToAccepted($id);

            header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian");
        }
    }
?>