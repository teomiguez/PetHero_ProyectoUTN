<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;

    use Models\Guardian as Guardian;
    use Models\Review as Review;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\AvStay as AvStay;
    use Models\Cat as Cat;
    use Models\Dog as Dog;


    class AuthController
    {
        public function Index($message = "")
        {
            if ((isset($_SESSION['idOwner'])) || (isset($_SESSION['idOwner'])))
            {
                session_destroy();
            }

            require_once(VIEWS_PATH."Home.php");
        }
        
        // -> PUBLIC FUNCTIONs
        
        public function ShowRegist()
        {
            require_once(VIEWS_PATH . "Register.php");
        }

        public function ShowLogin()
        {
            require_once(VIEWS_PATH . "Home.php");
        }

        public function Login($email = null, $password = null)
        {

            // Validacion por si se quiere acceder a la funcion Login desde la URL, sin pasar los parametros $email y $password
            if ($email == null || $password == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
            }
            else
            {   // Login de owner o guardian

                session_destroy();

                $ownerDAO = new OwnerDAO;
                $guardianDAO = new GuardianDAO;
    
                $user1 = $ownerDAO->GetByEmail($email);
                $user2 = $guardianDAO->GetByEmail($email);
    
                if ($user1 != null)
                {
                    if ($user1->getPassword() == $password)
                    {
                        // NEW SESSION
                        session_start();
    
                        $_SESSION['idOwner'] = $user1->getId_owner();
    
                        // -> REDIRECTION TO HOME_OWNER
                        header("location: " . FRONT_ROOT . "Owner/HomeOwner");
                        // <- REDIRECTION TO HOME_OWNER
                    }
                    else
                    {
                        $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");

                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                    }
                }
                else if ($user2 != null)
                {
                    if ($user2->getPassword() == $password)
                    {
                        // NEW SESSION
                        session_start();
        
                        $_SESSION['idGuardian'] = $user2->getId_guardian();
    
                        // -> REDIRECTION TO HOME_GUARDIAN
                        header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
                        // <- REDIRECTION TO HOME_GUARDIAN
                    }
                    else
                    {
                        $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");
                        
                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                    }
    
                }
                else
                {
                    $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");

                    // -> REDIRECTION TO 'Home.php'
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO 'Home.php'
                }
            }
        }

        public function Logout()
        {
            session_destroy();

            header ("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
        }

        
        public function Register($name = null, $last_name = null, $dni = null, $tel = null, $email = null, $password = null, $radio_option = null, $street = '', $nro = '', $typeSize = '', $cost = '')
        {

           // Validacion por si se quiere acceder a la funcion Register desde la URL, sin pasar los parametros del registro
            if ($name == null || $last_name == null || $dni == null || $tel == null || $email == null || $password == null || $radio_option == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowRegist"); 
            }
            else
            {   // Register de un owner o guardian
                
                if (($this->checkExistenceEmail($email) == false) && ($this->checkExistenceDni($dni) == false))
                {
                    if ($radio_option == 'dueño')
                    {
                        $this->RegisterOwner($name, $last_name, $dni, $tel, $email, $password);
                    } 
                    else if ($radio_option == 'guardian')
                    {
                        $this->RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost);
                    }
                    
                    $alert_succes = array("type" => "success", "text" => "Registro exitoso");
                    
                    // -> REDIRECTION TO 'Home.php'
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO 'Home.php'
                }
                else
                {
                    $alert = array("type" => "danger", "text" => "El Email o DNI ya estan registrados");
                    
                    require_once(VIEWS_PATH . "Register.php");
                }
            }
            
        }

        // -> HAY QUE VER CAMBIAR DE LUGAR Y MODIFICAR ALGUNAS FUNCIONES (X) NO RELACIONADAS AL AUTH 
        //    ORDENARLAS EN LOS CONTROLLERS ADECUADOS



        // public function FilterDates ($first_day, $last_day) // VER COMO PASAR LAS FECHAS POR QUERYPARAMS (X)
        // {
        //     if ((isset($_SESSION['idOwner'])))
        //     {  
        //         if ($this->checkDiffDays($first_day, $last_day) == true)
        //         {
        //             // -> REDIRECTION TO HOME_FILTER_OWNER
        //             header("location: " . FRONT_ROOT . "Owner/HomeFilterOwner"); // X
        //             // <- REDIRECTION TO HOME_FILTER_OWNER
        //         }
        //         else
        //         {
        //             // -> REDIRECTION TO HOME_OWNER
        //             header("location: " . FRONT_ROOT . "Owner/HomeOwner");
        //             // <- REDIRECTION TO HOME_OWNER
        //         }
        //     }
        //     else
        //     {
        //          header("location: " . FRONT_ROOT . "Auth/ShowLogin");
        //     }  
        //}
        
        // <- PUBLIC FUNCTIONs
        
        // -> THIS FUNCTIONs
        
        function checkExistenceEmail($email)
        {
            $ownerDAO = new OwnerDAO;
            $guardianDAO = new GuardianDAO;

            if ($ownerDAO->getByEmail($email) || $guardianDAO->getByEmail($email))
            {
                return true; // EXISTE
            }
            else
            {
                return false; // NO EXISTE
            }
        }

        function checkExistenceDni($dni)
        {
            $ownerDAO = new OwnerDAO;
            $guardianDAO = new GuardianDAO;

            if ($ownerDAO->getByDni($dni) || $guardianDAO->getByDni($dni))
            {
                return true; // EXISTE
            }
            else
            {
                return false; // NO EXISTE
            }
        }

        function RegisterOwner($name, $last_name, $dni, $tel, $email, $password)
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

            // -> ADD OWNER TO JSON
            $ownerDAO->Add($owner);
            // <- ADD OWNER TO JSON
        }

        function RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost)
        {
            $guardianDAO = new GuardianDAO();
            $reviewDAO = new ReviewDAO();
            $guardian = new Guardian();
            $review = new Review();

            $address = $street . " " . $nro;

            // -> SETs GUARDIAN
            $guardian->setId_guardian($guardianDAO->GetNextId_guardian());
            $guardian->setName($name);
            $guardian->setLast_name($last_name);
            $guardian->setDni($dni);
            $guardian->setTelephone($tel);
            $guardian->setEmail($email);
            $guardian->setPassword($password);
            $guardian->setAddress($address);
            $guardian->setSizeCare($typeSize);
            $guardian->setCost($cost);
            $guardian->setId_review($reviewDAO->GetNextId_review());
            // <- SETs GUARDIAN 

            // -> SETs REVIEW
            $review->setId_review($reviewDAO->GetNextId_review());
            $review->setId_guardian($guardianDAO->GetNextId_guardian());
            $review->setQuantity_reviews(0);
            $review->setSum_reviews(0);
            $review->setReview(0);
            // <- SETs REVIEW
            
            // -> ADD REVIEW TO JSON
            $reviewDAO->Add($review);
            // <- ADD REVIEW TO JSON

            // -> ADD GUARDIAN TO JSON
            $guardianDAO->Add($guardian);
            // <- ADD GUARDIAN TO JSON
        }

        // <- THIS  FUNCTIONs

    }

?>