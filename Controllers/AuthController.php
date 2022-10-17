<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use Models\Guardian as Guardian;
    use Models\Owner as Owner;

    class AuthController
    {
        // -> PUBLIC FUNCTIONs
        
        public function ShowRegist()
        {
            require_once(VIEWS_PATH . "Register.php");
        }

        public function ShowLogin()
        {
            require_once(VIEWS_PATH . "Home.php");
        }

        public function Login($email, $password)
        {
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

                    $_SESSION['id'] = $user1->getId_owner();
                    $_SESSION['type'] = "owner";

                    // -> REDIRECTION TO HOME_OWNER
                    header("location: " . FRONT_ROOT . "Owner/HomeOwner");
                    // <- REDIRECTION TO HOME_OWNER
                }
                else
                {
                    // AGREGAR EXCEPTION/ALERT 'USUARIO O CONTRASEÑA INCORRECTOS'
                }
            }
            else if ($user2 != null)
            {
                // NEW SESSION
                session_start();

                $_SESSION['id'] = $user2->getId_guardian();
                $_SESSION['type'] = "guardian";

                // -> REDIRECTION TO HOME_GUARDIAN
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
                // <- REDIRECTION TO HOME_OWNER
            }
            else
            {
                // AGREGAR EXCEPTION/ALERT 'USUARIO Y/O CONSTRASEÑA INCORRECTOS'

                // -> REDIRECTION TO 'Register.php'
                require_once(VIEWS_PATH . "Register.php");
                // <- REDIRECTION TO 'Register.php'
            }
        }

        public function Logout()
        {
            session_start();

            if ($_SESSION["id"])
            {
                session_destroy();

                header ("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }
        
        public function Register($name, $last_name, $dni, $tel, $email, $password, $radio_option, $street, $nro, $days, $typeSize, $cost)
        {
            if (($this->checkExistenceEmail($email) == false) && ($this->checkExistenceDni($dni) == false))
            {
                if ($radio_option == 'option1')
                {
                    $this->RegisterOwner($name, $last_name, $dni, $tel, $email, $password);
                } 
                else 
                {
                    $this->RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $radio_option, $street, $nro, $days, $typeSize, $cost);
                }
                
                // -> REDIRECTION TO 'Home.php'
                require_once(VIEWS_PATH . "Home.php");
                // <- REDIRECTION TO 'Home.php'
            }
            else
            {
                // AGREGAR EXCEPTION/ALERT!!
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

            // -> ADD OWNER TO JSON
            $ownerDAO->Add($owner);
            // <- ADD OWNER TO JSON
        }

        function RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $days, $typeSize, $cost)
        {
            $guardianDAO = new GuardianDAO();
            $guardian = new Guardian();

            // -> SETs GUARDIAN
            $guardian->setName($name);
            $guardian->setLast_name($last_name);
            $guardian->setDni($dni);
            $guardian->setTelephone($tel);
            $guardian->setEmail($email);
            $guardian->setPassword($password);
            $guardian->setAddress($street . $nro);
            $guardian->setRating('');
            $guardian->setSizeCare($typeSize);
            $guardian->setCost($cost);
            $guardian->setDays($days);
            // <- SETs GUARDIAN

            // -> ADD GUARDIAN TO JSON
            $guardianDAO->Add($guardian);
            // <- ADD GUARDIAN TO JSON
        }

        // <- THIS  FUNCTIONs

    }

?>