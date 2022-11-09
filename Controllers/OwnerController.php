<?php
    namespace Controllers;
    
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\PetDAO as PetDAO;

    use Models\Guardian as Guardian;
    use Models\Owner as Owner;
    use Models\AvStay as AvStay;

    class OwnerController 
    {
        public function __contruct() // no funciona ni le damos uso
        {
            require_once(FRONT_ROOT . "Utils/ValidateSession.php");

            if ($_SESSION["type"] == "guardian") 
            {
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
            }
        }  

        public function HomeOwner()
        {    
            if (isset($_SESSION['idOwner']))
            {
                $owner_DAO = new OwnerDAO();

                $user = $owner_DAO->GetById($_SESSION["idOwner"]);

                $this->ShowGuardians();
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }                
        }


        public function ShowProfile()
        {    
            if (isset($_SESSION['idOwner']))
            {        
                $owner_DAO = new OwnerDAO();

                $user = $owner_DAO->GetById($_SESSION["idOwner"]);

                require_once(VIEWS_PATH . "OwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        public function RegisterOwner($name, $last_name, $dni, $tel, $email, $password)
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

        public function ModifyProfile_Owner()
        {
            if (isset($_SESSION['idOwner']))
            {        
                $owner_DAO = new OwnerDAO();

                $user = $owner_DAO->GetById($_SESSION["idOwner"]);

                require_once(VIEWS_PATH . "ModifyOwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function UpdateProfile($id, $name, $last_name, $tel, $password)
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

            $this->ShowProfile();
        }

        public function ShowGuardians()
        {
            if (isset($_SESSION['idOwner']))
            {  
                $guardian_DAO = new GuardianDAO();
                $petDAO = new PetDAO();

                $guardians = $guardian_DAO->GetAll();

                $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }      
        }

        public function ShowFilterGuardians($first_day, $last_day) // funciona para mostrar el primer guardian disponible 
                                                                  //que encuentra con las fechas solicitadas
        { 
            if (isset($_SESSION['idOwner']))
            {  
                $guardian_DAO = new GuardianDAO();
                $avStayDAO = new AvStayDAO();
                $guardian = new Guardian();
                $guardiansAviable = array();
                 
                $idsGuardiansAvailable = $avStayDAO->GetIdGuardian_ByDates($first_day, $last_day);

                foreach($idsGuardiansAvailable as $id)
                {
                    $guardian = $guardian_DAO->GetById($id);
                    array_push($guardiansAviable, $guardian);
                }
                
                /**
                *$guardiansAviable = array_filter($idsGuardiansAvailable, function ($guardian) use ($id_keeper) 
                *{
                *    return $guardian->getId_guardian() == $id_keeper;
                *});
                */

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }
    }
?>