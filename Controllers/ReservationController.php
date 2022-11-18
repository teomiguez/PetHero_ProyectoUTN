<?php
    namespace Controllers;

    use Controllers\OwnerController as OwnerController;
    use Controllers\GuardianController as GuardianController;
    use Controllers\PaymentCouponController as PaymentCouponController;

    use DAO_SQL\GuardianDAO as GuardianDAO;
    use DAO_SQL\AvStayDAO as AvStayDAO;
    use DAO_SQL\ReservationDAO as ReservationDAO;
    use DAO_SQL\PaymentCouponDAO as PaymentCouponDAO;

    use DAO_SQL\PetDAO as PetDAO;

    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\Reservation as Reservation;
    use Models\AvStay as AvStay;
    use Models\PaymentCoupon as PaymentCoupon;

    use Exception;

    class ReservationController 
    {
        public function __contruct()
        {
            
        }

        public function Create_Reserv($id_guardian, $pet_size, $pet_breed, $first_day, $last_day, $diff_days)
        {
            try
            {
                $reservationDAO = new ReservationDAO();
                $reserv = new Reservation();
                
                $reserv->setId_guardian($id_guardian);
                $reserv->setPet_size($pet_size);
                $reserv->setPet_breed($pet_breed);
                $reserv->setFirst_day($first_day);
                $reserv->setLast_day($last_day);
                $reserv->setTotal_days($diff_days);
    
                $reservationDAO->AddReservation($reserv);
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }
        }
        
        public function RequestReservation($first_day, $last_day, $id_guardian, $id_pet)
        {
            try
            {
                $ownerController = new OwnerController();
                $paymentCouponController = new PaymentCouponController();
                
                $reservationDAO = new ReservationDAO();
                $guardianDAO = new GuardianDAO();
                $avstayDAO = new AvStayDAO();
                $paymentCouponDAO = new PaymentCouponDAO();
                $petDAO = new PetDAO();
    
                $reservForGuardian = $reservationDAO->GetByGuardian($id_guardian);
                $staysForGuardian = $avstayDAO->GetByKeeper($id_guardian);
                $reservExist = new Reservation();
                $pet = new Pet();
                $pet = $petDAO->GetById($id_pet);
                $guardian = new Guardian();
                $guardian = $guardianDAO->GetById($id_guardian);
                $coupon = new PaymentCoupon();
    
                try 
                {
                    if (($this->IsExist_Reserv($reservForGuardian, $first_day, $last_day)) || ($this->IsPart_Reserv($reservForGuardian, $first_day, $last_day))) // si existe o no la reserva
                    {
                        $id_exist = $this->GetIdReserv($reservForGuardian, $first_day, $last_day); // obtengo id por las fechas
                        $reservExist = $reservationDAO->GetById($id_exist); // obtengo la reserva existente

                        if ($reservExist->getIs_accepted() == 0) // si esa reserva o parte de la reserva no esta aceptada
                        {
                            if (($reservationDAO->GetSize_Condition($id_exist) == $pet->getSize()) && ($reservationDAO->GetBreed_Condition($id_exist) == $pet->getBreed())) // si la mascota cumple las condiciones de la reserva
                            {
                                $paymentCouponController->Create_PaymentCoupon($id_exist, $pet->getId_pet() ,$pet->getId_owner()); // creo el cupon
                                
                                $coupon = $paymentCouponDAO->GetByReservation($id_exist, $pet->getId_pet()); // obtengo el id del cupon
                                
                                $reservationDAO->AddPet_ToReservation($id_exist,$pet->getId_pet() ,$pet->getId_owner(), $coupon->getId_paymentCoupon()); // agrego la mascota a la reserva
            
                                $alert = array("type" => "success", "text" => "Se agregó la mascota a una reserva previa");
                            }
                            else
                            {
                                throw new Exception("Hay una reserva existente y la mascota seleccionada no cumple con las condiciones de tamaño/raza"); // si no cumple las condiciones -> alert
                            }
                        }
                    }
                    else if ($this->IsExist_Stay($staysForGuardian, $first_day, $last_day)) // si el guardian tiene libre esos dias
                    {
                        if ($guardian->getSizeCare() == $pet->getSize())
                        {
                            $diff = 0; // ver de hacer la diferencia (tiro error con las lineas que estan en GuardianHome)
    
                            $this->Create_Reserv($id_guardian, $pet->getSize(), $pet->getBreed(), $first_day, $last_day, $diff); // creo la reserva
                            
                            $reservForGuardian2 = $reservationDAO->GetByGuardian($id_guardian);
    
                            $id_reserv = $this->GetIdReserv($reservForGuardian2, $first_day, $last_day); // obtengo el id de la reserva
                            
                            $paymentCouponController->Create_PaymentCoupon($id_reserv, $pet->getId_pet(), $pet->getId_owner()); // creo el cupon
                            
                            $coupon = $paymentCouponDAO->GetByReservation($id_reserv, $pet->getId_pet()); // obtengo el id del cupon
                            
                            $reservationDAO->AddPet_ToReservation($id_reserv, $id_pet, $pet->getId_owner(), $coupon->getId_paymentCoupon()); // agrego la mascota a la reserva
            
                            $alert = array("type" => "success", "text" => "Se envió la solicitud al guardian");
                        }
                        else
                        {
                            throw new Exception("El guardian no cuida el tamaño de su mascota"); // si no cumple las condiciones -> alert
                        }
                    }
                    else
                    {
                        throw new Exception("El guardian no tiene esas fechas disponibles"); // si no tiene libre -> alert
                    }
        
                    $ownerController->ShowHome_Owner($alert);
                }
                catch (Exception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
    
                    $ownerController->ShowHome_Owner($alert);
                }
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }

        public function AcceptedReserv($id)
        {
            try
            {
                $guardianController = new GuardianController();
                $reservationDAO = new ReservationDAO();

                // agregar validaciones para verificar que no halla otra reserva aceptada en esas fechas (por si se envian dos o + solicitudes)

                $reservationDAO->ChangeToAccepted($id);
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }

            $guardianController->ShowHome_Guardian();
        }

        public function DenyReserv($id)
        {
            try
            {
                $guardianController = new GuardianController();
                $reservationDAO = new ReservationDAO();
                $reservationDAO->Remove($id);
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                    ];
            }

            $guardianController->ShowHome_Guardian();
        }

        /**
        *	@param Array -> listado de reservas
        */
        function IsExist_Reserv($reservsForGuardian, $first_day, $last_day)
        {
            $reserv = new Reservation();
            
            foreach($reservsForGuardian as $reserv)
            {
                if(($reserv->getFirst_day() <= $first_day) && ($reserv->getLast_day() >= $last_day))
                {
                    return true;
                }
            }
            return false;
        }

        /**
        *	@param Array -> listado de reservas
        */
        function IsPart_Reserv($reservsForGuardian, $first_day, $last_day)
        {
            $reserv = new Reservation();
            
            foreach($reservsForGuardian as $reserv)
            {
                if(((($reserv->getFirst_day() <= $first_day) && ($reserv->getLast_day() >= $first_day)) || 
                    (($reserv->getFirst_day() <= $last_day) && ($reserv->getLast_day() >= $last_day))))
                {
                    return true;
                }
            }
            return false;
        }

        /**
        *	@param Array -> listado de estadias
        */
        function IsExist_Stay($staysForGuardian, $first_day, $last_day)
        {
            $avstay = new AvStay();

            foreach($staysForGuardian as $avstay)
            {
                if(($avstay->getFirst_day() <= $first_day) && ($avstay->getLast_day() >= $last_day))
                {
                    return true;
                }
            }
            return false;
        }

        /**
        *	@param Array -> listado de reservas
        */
        function GetIdReserv($reservsForGuardian, $first_day, $last_day)
        {
            $reserv = new Reservation();
            
            foreach($reservsForGuardian as $reserv)
            {
                if(($reserv->getFirst_day() == $first_day) && ($reserv->getLast_day() == $last_day))
                {
                    return $reserv->getId_reservation();
                }
                else if(((($reserv->getFirst_day() <= $first_day) && ($reserv->getLast_day() >= $first_day)) || 
                        (($reserv->getFirst_day() <= $last_day) && ($reserv->getLast_day() >= $last_day))))
                {
                    return $reserv->getId_reservation();
                }
            }
            return false;
        }
    }
?>