<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\ReservationDAO as ReservationDAO;

    use Models\Guardian as Guardian;
    use Models\AvStay as AvStay;
    use Models\Review as Review;
    use Models\Reservation as Reservation;

    use Controllers\ReviewController as ReviewController;

    class GuardianController 
    {
        public function __contruct() // no funciona ni le damos uso
        {
            
        } 

        public function ShowProfile()
        {   
            if (isset($_SESSION['idGuardian']))
            {         
                $guardian_DAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                $user_review = $reviewDAO->GetByIdGuardian($user->getId_guardian());

                require_once(VIEWS_PATH . "GuardianProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  

        }
        
        public function HomeGuardian()
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $guardian_DAO = new GuardianDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);

                $this->ShowAvStays();
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        public function RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost)
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $guardianDAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();
                $reviewController = new ReviewController();
                $guardian = new Guardian();
                $review = new Review();

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

                $reviewController->CreateNewReview($last_idGuardian);
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        public function UpdateProfile($id, $name, $last_name, $tel, $password, $address, $typeSize, $cost)
        {
            $guardianDAO = new GuardianDAO();
            $guardian = new Guardian();
            
            // -> SETs GUARDIAN
            $guardian->setName($name);
            $guardian->setLast_name($last_name);
            $guardian->setTelephone($tel);
            $guardian->setPassword($password);
            $guardian->setAddress($address);
            $guardian->setSizeCare($typeSize);
            $guardian->setCost($cost);
            // <- SETs GUARDIAN 

            // -> UPDATE GUARDIAN
            $guardianDAO->Update($id, $guardian);
            // <- UPDATE GUARDIAN

            $this->ShowProfile();
        }


        public function ModifyProfile_Guardian()
        {
            if (isset($_SESSION['idGuardian']))
            {         
                $guardian_DAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                $user_review = $reviewDAO->GetByIdGuardian($user->getId_guardian());

                require_once(VIEWS_PATH . "ModifyGuardianProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }
    
        public function ShowAvStays()
        {
            if (isset($_SESSION['idGuardian']))
            { 
                $avStayDAO = new AvStayDAO();
                $reservationDAO = new ReservationDAO();
                $avStayList = array();
                $reservList = array();

                $avStayList = $avStayDAO->GetByKeeper($_SESSION["idGuardian"]);
                $reservList = $reservationDAO->GetByGuardian($_SESSION["idGuardian"]);

                var_dump($reservList);
                require_once(VIEWS_PATH . "GuardianHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

    }
?>