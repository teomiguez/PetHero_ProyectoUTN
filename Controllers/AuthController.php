<?php
    namespace Controllers;

    use Controllers\OwnerController as OwnerController;
    use Controllers\GuardianController as GuardianController;

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

        // FUNCION -> INICIAR SESION

        public function Login($email = null, $password = null)
        {
            if ($email == null || $password == null) // VALIDACION X SEGURIDAD
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

                if ($user1 != null) // LOGIN -> OWNER
                {
                    if ($user1->getPassword() == $password)
                    {
                        session_start(); // NEW SESSION
    
                        $_SESSION['idOwner'] = $user1->getId_owner(); // SET ID_OWNER IN $_SESSION
    
                        // -> REDIRECTION TO HOME_OWNER
                        header("location: " . FRONT_ROOT . "Owner/ShowHome_Owner");
                        // <- REDIRECTION TO HOME_OWNER
                    }
                    else
                    {
                        $alert = [
                            "type" => "danger",
                            "text" => "Usuario y/o Contraseña incorrectos"
                        ];

                        // -> REDIRECTION TO LOGIN_VIEW
                        require_once(VIEWS_PATH . "Home.php");
                        // <- REDIRECTION TO LOGIN_VIEW
                    }
                }
                else if ($user2 != null) // LOGIN -> GUARDIAN
                {
                    if ($user2->getPassword() == $password)
                    {
                        session_start(); // NEW SESSION
        
                        $_SESSION['idGuardian'] = $user2->getId_guardian(); // SET ID_GUARDIAN IN $_SESSION
    
                        // -> REDIRECTION TO HOME_GUARDIAN
                        header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian");
                        // <- REDIRECTION TO HOME_GUARDIAN
                    }
                    else
                    {
                        $alert = [
                            "type" => "danger",
                            "text" => "Usuario y/o Contraseña incorrectos"
                        ];
                        
                        // -> REDIRECTION TO LOGIN_VIEW
                        require_once(VIEWS_PATH . "Home.php");
                        // <- REDIRECTION TO LOGIN_VIEW
                    }
    
                }
                else
                {
                    $alert = [
                            "type" => "danger",
                            "text" => "Usuario y/o Contraseña incorrectos"
                        ];

                    // -> REDIRECTION TO LOGIN_VIEW
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO LOGIN_VIEW
                }
            }
        }

        // FUNCION -> CERRAR SESION

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
                        $ownerController = new OwnerController();
                        $ownerController->Register_Owner($name, $last_name, $dni, $tel, $email, $password);
                    } 
                    else if ($radio_option == 'guardian')
                    {
                        $guardianController = new GuardianController();
                        $guardianController->Register_Guardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost);
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

        // <- THIS  FUNCTIONs

    }

?>