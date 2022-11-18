<?php
    namespace Controllers;
    
    use Controllers\ReservationForPetController as ReservationForPetController;
    use Controllers\ReservationController as ReservationController;
    
    use DAO_SQL\OwnerDAO as OwnerDAO;
    use DAO_SQL\GuardianDAO as GuardianDAO;
    use DAO_SQL\ReviewDAO as ReviewDAO;
    use DAO_SQL\AvStayDAO as AvStayDAO;
    use DAO_SQL\ReservationDAO as ReservationDAO;
    use DAO_SQL\PetDAO as PetDAO;

    use Models\Owner as Owner;
    use Models\Guardian as Guardian;
    use Models\Review as Review;
    use Models\AvStay as AvStay;
    use Models\Reservation as Reservation;
    use Models\ReservationForPet as ReservationForPet;
    use Models\Pet as Pet;

    use Exception;

    class OwnerController 
    {
        public function __contruct() 
        {
            
        }

        public function ShowHome_Owner($alert = '')
        {    
            if (isset($_SESSION['idOwner']))
            {
                try
                {
                    $reservationForPet = new ReservationForPetController();
                
                    $ownerDAO = new OwnerDAO();
                    $guardianDAO = new GuardianDAO();
                    $reservationDAO = new ReservationDAO();
                    $petDAO = new PetDAO();
                    
                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                    $guardians = $guardianDAO->GetAll();
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);
                    
                    //$reservList = $reservationDAO->GetByOwner($_SESSION['idOwner']); // obtengo las reservas de pet_x_reservation
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
            
            require_once(VIEWS_PATH . "OwnerHome.php");
        }

        public function ShowHome_FilterGuardians($first_day, $last_day, $alert = '') 
        { 
            if (isset($_SESSION['idOwner']))
            {  
                try
                {
                    $guardianDAO = new GuardianDAO();
                    $avStayDAO = new AvStayDAO();
                    $petDAO = new PetDAO();
    
                    $guardian = new Guardian();
    
                    $guardians = array();
                    $guardiansAviable = array();
                    $petsList = array();
    
                    $datesSelect = [
                        "first_day" => $first_day,
                        "last_day" => $last_day
                    ];
                     
                    $guardians = $guardianDAO->GetAll();
                    $idsGuardiansAvailable = $avStayDAO->GetIdGuardian_ByDates($first_day, $last_day);
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);
    
                    if(empty($idsGuardiansAvailable))
                    {
                        $alert = [
                            "type" => "danger",
                            "text" => "No hay guardianes disponibles en esas fechas"
                        ];
    
                        $this->ShowHome_Owner($alert);
                    }
                    else
                    {
                        foreach($idsGuardiansAvailable as $id)
                        {
                            $guardian = $guardianDAO->GetById($id);
                            array_push($guardiansAviable, $guardian);
                        }
                    }
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function ShowProfile_Owner()
        {    
            if (isset($_SESSION['idOwner']))
            {        
                try
                {
                    $ownerDAO = new OwnerDAO();

                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "OwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        public function ShowModifyProfile_Owner()
        {
            if (isset($_SESSION['idOwner']))
            {        
                try
                {
                    $ownerDAO = new OwnerDAO();

                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "ModifyOwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function ShowViewGuardian($id)
        {
            if (isset($_SESSION['idOwner']))
            {         
                try
                {
                    $guardianDAO = new GuardianDAO();
                    $reviewDAO = new ReviewDAO();

                    $guardian = $guardianDAO->GetById($id);
                    $guardian_review = $reviewDAO->GetByIdGuardian($id);
                }
                    catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "GuardianProfile_ViewOwner.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function Register_Owner($name, $last_name, $dni, $tel, $email, $password)
        {
            try
            {
                $ownerDAO = new OwnerDAO();
                $owner = new Owner();
    
                // -> SETs OWNER
                $owner->setName($name);
                $owner->setLast_name($last_name);
                $owner->setDni($dni);
                $owner->setTelephone($tel);
                $owner->setEmail($email);
                $owner->setPassword($password);
                // <- SETs OWNER
    
                // -> ADD OWNER
                $ownerDAO->Add($owner);
                // <- ADD OWNER
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }

        public function UpdateProfile_Owner($id, $name, $last_name, $tel, $password)
        {
            try
            {
                $ownerDAO = new OwnerDAO();
                $owner = new Owner();
    
                // -> SETs OWNER
                $owner->setName($name);
                $owner->setLast_name($last_name);
                $owner->setTelephone($tel);
                $owner->setPassword($password);
                // <- SETs OWNER
    
                // -> UPDATE OWNER
                $ownerDAO->Update($id, $owner);
                // <- UPDATE OWNER
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }

            $this->ShowProfile_Owner();
        }
    }
?>