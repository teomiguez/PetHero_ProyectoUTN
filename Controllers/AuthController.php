<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\AvStayDAO as AvStayDAO;

    use Models\Guardian as Guardian;
    use Models\Review as Review;
    use Models\Owner as Owner;
    use Models\AvStay as AvStay;


    class AuthController
    {
        public function Index($message = "")
        {
            if ((isset($_SESSION['idOwner'])) || (isset($_SESSION['idGuardian'])))
            {
                session_destroy();
            }

            require_once(VIEWS_PATH."Home.php");
        }
        
        // -> PUBLIC FUNCTIONs

        // VISTA REGISTRO
        
        public function ShowRegist()
        {
            require_once(VIEWS_PATH . "Register.php");
        }

         // VISTA LOGIN (INICIO)

        public function ShowLogin()
        {
            require_once(VIEWS_PATH . "Home.php");
        }

        // INICIAR SESION

        public function Login($email = null, $password = null)
        {

            // VALIDACION X SEGURIDAD
            if ($email == null || $password == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
            }
            else
            {   
                session_destroy();

                $ownerDAO = new OwnerDAO;
                $guardianDAO = new GuardianDAO;
    
                $user1 = $ownerDAO->GetByEmail($email); // USER1 → OWNER
                $user2 = $guardianDAO->GetByEmail($email); // USER2 → GUARDIAN

                if ($user1 != null) // LOGIN OWNER
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
                        // ALERT DATOS ERRONEOS
                        $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");

                        // -> REDIRECTION TO LOGIN_VIEW
                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                        // <- REDIRECTION TO LOGIN_VIEW
                    }
                }
                else if ($user2 != null) // LOGIN GUARDIAN
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
                        // ALERT DATOS ERRONEOS
                        $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");
                        
                        // -> REDIRECTION TO LOGIN_VIEW
                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                        // <- REDIRECTION TO LOGIN_VIEW
                    }
    
                }
                else
                {
                    // ALERT DATOS ERRONEOS
                    $alert = array("type" => "danger", "text" => "Usuario y/o Contraseña incorrectos");

                    // -> REDIRECTION TO LOGIN_VIEW
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO LOGIN_VIEW
                }
            }
        }

        // CERRAR SESION

        public function Logout()
        {
            session_start();
            
            session_destroy();

            // -> REDIRECTION TO LOGIN_VIEW
            header ("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
            // <- REDIRECTION TO LOGIN_VIEW
        }

        // REGISTRO DE UN OWNER/GUARDIAN
        
        public function Register($name = null, $last_name = null, $dni = null, $tel = null, $email = null, $password = null, $radio_option = null, $street = '', $nro = '', $typeSize = '', $cost = '')
        {

            // VALIDACION X SEGURIDAD
            if ($name == null || $last_name == null || $dni == null || $tel == null || $email == null || $password == null || $radio_option == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowRegist"); 
            }
            else
            {   
                // VALIDACION 'SI EXISTE' UN EMAIL O DNI 
                if (($this->checkExistenceEmail($email) == false) && ($this->checkExistenceDni($dni) == false))
                {
                    if ($radio_option == 'dueño')
                    {
                        // cambiar y redireccionar al OwnerController
                        $this->RegisterOwner($name, $last_name, $dni, $tel, $email, $password);
                    } 
                    else if ($radio_option == 'guardian')
                    {
                        // cambiar y redireccionar al GuardianController y ReviewController la parte de Review
                        $this->RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost);
                    }
                    
                    $alert_succes = array("type" => "success", "text" => "Registro exitoso");
                    
                    // -> REDIRECTION TO LOGIN_VIEW
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO LOGIN_VIEW
                }
                else
                {
                    // ALERT - EXISTE EL EMAIL O DNI
                    $alert = array("type" => "danger", "text" => "El Email o DNI ya estan registrados");
                    
                    // -> REDIRECTION TO REGISTER_VIEW
                    require_once(VIEWS_PATH . "Register.php");
                    // <- REDIRECTION TO REGISTER_VIEW
                }
            }
            
        }
        
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

            // -> ADD OWNER
            $ownerDAO->Add($owner);
            // <- ADD OWNER
        }

        function RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost)
        {
            $guardianDAO = new GuardianDAO();
            $reviewDAO = new ReviewDAO();
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

            // -> SETs REVIEW
            $review->setId_guardian($last_idGuardian);
            $review->setQuantity_reviews(0);
            $review->setSum_reviews(0);
            $review->setReview(0);
            // <- SETs REVIEW
            
            // -> ADD REVIEW
            $reviewDAO->Add($review);
            // <- ADD REVIEW

        }

        // <- THIS  FUNCTIONs

    }

?>