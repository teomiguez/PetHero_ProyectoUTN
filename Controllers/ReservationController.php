<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\PetDAO as PetDAO;

    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\Reservation as Reservation;
    use Models\AvStay as AvStay;

    class ReservationController 
    {
        public function __contruct()
        {
            
        }
        
        public function RequestReservation($first_day, $last_day, $id_guardian, $id_pet)
        {
            $reservationDAO = new ReservationDAO();
            $guardianDAO = new GuardianDAO();
            $avstayDAO = new AvStayDAO();
            $petDAO = new PetDAO();

            $reserv = new Reservation();
            $pet = $petDAO->GetById($id_pet);
            $guardian = $guardianDAO->GetById($id_guardian);

            try 
            {
                if ($reservationDAO->IsExist_Reserv($first_day, $last_day))
                {
                    $id_exist = $reservationDAO->GetIdByDates($first_day, $last_day);
    
                    if (($reservationDAO->GetSize_Condition($id_exist) == $pet->getSize()) && ($reservationDAO->GetBreed_Condition($id_exist) == $pet->getBreed()))
                    {
                        // CREAR EL CUPON DE PAGO
                        
                        $reservationDAO->AddPet_ToReservation($id_exist, 1 /*cambiar*/, $pet);
    
                        $alert_succes = array("type" => "succes", "text" => "Se agregó la mascota a una reserva previa");
                    }
                    else
                    {
                        $alert_danger = array("type" => "danger", "text" => "La reserva ya existe y la mascota seleccionada no cumple con las condiciones de tamaño/raza");
                    }
                }
                else if (($avstayDAO->IsExist_Stay($first_day, $last_day)) && ($avstayDAO->ThisGuardianIsAviable($id_guardian, $first_day, $last_day)))
                {
                    if ($guardian->getSizeCare() == $pet->getSize())
                    {
                        $diff = 0;
                        
                        $reserv->setId_guardian($id_guardian);
                        $reserv->setPet_size($pet->getSize());
                        $reserv->setPet_breed($pet->getBreed());
                        $reserv->setFirst_day($first_day);
                        $reserv->setLast_day($last_day);
                        $reserv->setTotal_days($diff); // ver hacer la diferencia (tira error con lo que usamos en el GuarianHome)
        
                        /* id_reserv =*/$reservationDAO->AddReservation($reserv); // ver que retorne la id (así se agrega la mascota)
    
                        // CREAR CUPON DE PAGO
    
                        //$reservationDAO->AddPet_ToReservation(/* id_reserv, id_cupon*/, $pet);
        
                        $alert_succes = array("type" => "succes", "text" => "Se envió la solicitud al guardian");
                    }
                    else
                    {
                        throw new Exception("El guardian no cuida el tamaño de su mascota");
                    }
                }
                else if (!$avstayDAO->ThisGuardianIsAviable($id_guardian, $first_day, $last_day))
                {
                    throw new Exception("El guardian no tiene esas fechas disponibles");
                }
    
                header("location: " . FRONT_ROOT . "Owner/ShowHome_Owner");
            }
            catch (Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage();
                ]
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