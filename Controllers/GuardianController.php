<?php
    namespace Controllers;

    use Controllers\ReviewController as ReviewController;

    use DAO_SQL\GuardianDAO as GuardianDAO;
    use DAO_SQL\AvStayDAO as AvStayDAO;
    use DAO_SQL\ReviewDAO as ReviewDAO;
    use DAO_SQL\ReservationDAO as ReservationDAO;

    use Models\Guardian as Guardian;
    use Models\AvStay as AvStay;
    use Models\Review as Review;
    use Models\Reservation as Reservation;

    use Exception;

    class GuardianController 
    {
        public function __contruct() 
        {
            
        } 

        public function ShowHome_Guardian()
        {
            if (isset($_SESSION['idGuardian']))
            {  
                try
                {
                    $guardian_DAO = new GuardianDAO();
                    $avStayDAO = new AvStayDAO();
                    $reservationDAO = new ReservationDAO();
    
                    $avStayList = array();
                    $reservList = array(); // todas las reservas
    
                    $dailyReservs = array(); // mostrar las reservas al día (confirmadas o no)
                    $pastReservs = array(); // mostrar las reservas pasadas
    
                    $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                    $avStayList = $avStayDAO->GetByKeeper($_SESSION["idGuardian"]);
                    $reservList = $reservationDAO->GetByGuardian($_SESSION["idGuardian"]);
    
                    $dailyReservs = $this->putDaily_Reservs($reservList);
                    $pastReserv = $this->putLast_Reservs($reservList);
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

                require_once(VIEWS_PATH . "GuardianHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }
        
        public function ShowProfile_Guardian()
        {   
            if (isset($_SESSION['idGuardian']))
            {         
                try
                {
                    $guardian_DAO = new GuardianDAO();
                    $reviewDAO = new ReviewDAO();

                    $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                    $user_review = $reviewDAO->GetByIdGuardian($user->getId_guardian());
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

                require_once(VIEWS_PATH . "GuardianProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  

        }

        public function ShowModifyProfile_Guardian()
        {
            if (isset($_SESSION['idGuardian']))
            {         
                try
                {
                    $guardian_DAO = new GuardianDAO();
                    $reviewDAO = new ReviewDAO();
    
                    $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                    $user_review = $reviewDAO->GetByIdGuardian($user->getId_guardian());
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

                require_once(VIEWS_PATH . "ModifyGuardianProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        function Register_Guardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost)
        {
            try
            {
                $guardianDAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();
                $guardian = new Guardian();
                $reviewController = new ReviewController();
    
                $last_guardian = new Guardian;
    
                $address = $street . " " . $nro;
                
                // -> SETs GUARDIAN
                $guardian->setName($name);
                $guardian->setLast_name($last_name);
                $guardian->setDni($dni);
                $guardian->setTelephone($tel);
                $guardian->setEmail($email);
                $guardian->setPassword($password);
                $guardian->setAddress($address);
                $guardian->setSizeCare($typeSize);
                $guardian->setCost($cost);
                // <- SETs GUARDIAN 
    
                // -> ADD GUARDIAN
                $guardianDAO->Add($guardian);
                // <- ADD GUARDIAN
    
                // → GET LAST_GUARDIAN CON EL EMAIL
                $last_guardian = $guardianDAO->GetByEmail($email);
                $last_idGuardian = $last_guardian->getId_guardian();
                // ← GET LAST_GUARDIAN CON EL EMAIL
                
                // → GET LAST_GUARDIAN CON EL EMAIL
                $last_guardian = $guardianDAO->GetByEmail($email);
                $last_idGuardian = $last_guardian->getId_guardian();
                // ← GET LAST_GUARDIAN CON EL EMAIL
    
                $reviewController->CreateNewReview($last_idGuardian); 
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }
        }

        public function UpdateProfile_Guardian($id, $name, $last_name, $tel, $password, $address, $typeSize, $cost)
        {
            try
            {
                $guardianDAO = new GuardianDAO();
                $guardian = new Guardian();
                
                // -> SETs GUARDIAN
                $guardian->setName($name);
                $guardian->setLast_name($last_name);
                $guardian->setTelephone($tel);
                $guardian->setPassword($password);
                $guardian->setAddress($address);
    
                if(($typeSize != 1) && ($typeSize != 2) && ($typeSize != 3))
                {
                    $id_size = $guardianDAO->GetIdSize($typeSize);
                    $guardian->setSizeCare($id_size);
                }
                else
                {
                    $guardian->setSizeCare($typeSize);
                }
    
                $guardian->setCost($cost);
                // <- SETs GUARDIAN 
    
                // -> UPDATE GUARDIAN
                $guardianDAO->Update($id, $guardian);
                // <- UPDATE GUARDIAN
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }

            $this->ShowProfile_Guardian();
        }

        /**
        *	@param Array -> listado de reservas
        */
        function putLast_Reservs($totalReservs)
        {
            $newArray = array();
            $reserv = new Reservation();

            foreach($totalReservs as $reserv)
            {
                if($reserv->getLast_day() <= date('Y-m-d'))
                {
                    array_push($newArray, $reserv);
                }
            }

            return $newArray;
        }

        /**
        *	@param Array -> listado de reservas
        */
        function putDaily_Reservs($totalReservs)
        {
            $newArray = array();
            $reserv = new Reservation();

            foreach($totalReservs as $reserv)
            {
                if($reserv->getLast_day() >= date('Y-m-d'))
                {
                    array_push($newArray, $reserv);
                }
            }

            return $newArray;
        }
    }
?>