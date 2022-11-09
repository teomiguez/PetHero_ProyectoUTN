<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\PetDAO as PetDAO;

    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\AvStay as AvStay;

    class OwnerController 
    {
        public function RequestReservation($first_day, $last_day, $id_guardian, $id_pet)
        {
            $reservationDAO = new ReservationDAO();
            $avstayDAO = new AvStayDAO();
            $petDAO = new PetDAO();

            $reserv = new Reserv();
            $pet = $petDAO->GetById($id_pet);

            if (($reservationDAO->IsExist_Reserv($first_day, $last_day)))
            {
                $id_exist = $reservationDAO->GetIdByDates($first_day, $last_day);

                if (($reservationDAO->GetSize_Condition($id_exist) == $pet->getSize()) && ($reservationDAO->GetBreed_Condition($id_exist) == $pet->getBreed()))
                {
                    // CREAR EL CUPON DE PAGO
                    
                    $reservationDAO->AddPet_ToReservation($id_exist, 1 /*cambiar*/, $id_pet);

                    $alert_succes = array("type" => "succes", "text" => "Se agregó la mascota a unareserva previa");
                }
                else
                {
                    $alert_danger = array("type" => "danger", "text" => "La reserva ya existe y la mascota seleccionada no cumple con las condiciones de tamaño/raza");
                }
            }
            else if (($avstayDAO->IsExist_Stay($first_day, $last_day)) && ($avstayDAO->GetIdGuardian_ByDates($first_day, $last_day) == $id_guardian))
            {
                $reserv->setId_guardian($id_guardian);
                $reserv->setPet_size($pet->getSize());
                $reserv->setPet_size($pet->getBreed());
                $reserv->setFirst_day($first_day);
                $reserv->setLast_day($last_day);
                $reserv->setTotal_days($first_day->diff($last_day));

                $reservationDAO->AddReservation($reserv);

                $alert_succes = array("type" => "succes", "text" => "Se envió la solicitud al guardian");
            }
            else if ($avstayDAO->GetIdGuardian_ByDates($first_day, $last_day) != $id_guardian)
            {
                $alert_danger = array("type" => "danger", "text" => "El guardian no tiene esas fechas disponibles");
            }
        }
    }
?>