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
        public function __contruct() 
        {
            
        }  

        public function ShowHome_Owner()
        {    
            if (isset($_SESSION['idOwner']))
            {
                $ownerDAO = new OwnerDAO();
                $guardianDAO = new GuardianDAO();
                $petDAO = new PetDAO();
                
                $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                $guardians = $guardianDAO->GetAll();
                $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }                
        }

        public function ShowHome_FilterGuardians($first_day, $last_day) 
        { 
            if (isset($_SESSION['idOwner']))
            {  
                $guardianDAO = new GuardianDAO();
                $avStayDAO = new AvStayDAO();
                $petDAO = new PetDAO();

                $guardian = new Guardian();
                $guardiansAviable = array();
                 
                $guardiansSelect = $guardianDAO->GetAll();
                $idsGuardiansAvailable = $avStayDAO->GetIdGuardian_ByDates($first_day, $last_day);

                foreach($idsGuardiansAvailable as $id)
                {
                    $guardian = $guardianDAO->GetById($id);
                    array_push($guardiansAviable, $guardian);
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
                $owner_DAO = new OwnerDAO();

                $user = $owner_DAO->GetById($_SESSION["idOwner"]);

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
                $owner_DAO = new OwnerDAO();

                $user = $owner_DAO->GetById($_SESSION["idOwner"]);

                require_once(VIEWS_PATH . "ModifyOwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function Register_Owner($name, $last_name, $dni, $tel, $email, $password)
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

        public function UpdateProfile_Owner($id, $name, $last_name, $tel, $password)
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

            $this->ShowProfile_Owner();
        }
    }
?>