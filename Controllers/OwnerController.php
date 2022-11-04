<?php
    namespace Controllers;
    
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
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

                //var_dump($_SESSION);

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

        public function ShowGuardians()
        {
            if (isset($_SESSION['idOwner']))
            {  
                $guardian_DAO = new GuardianDAO();

                $guardians = $guardian_DAO->GetAll();

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }      
        }

        public function ShowFilterGuardians($first_day, $last_day)
        {
            if (isset($_SESSION['idOwner']))
            {  
                $guardian_DAO = new GuardianDAO();
                $avStayDAO = new AvStayDAO();
                
                $idsGuardiansAvailable = $avStayDAO->GetIdGuardian_ByDates($first_day, $last_day);

                $guardiansAviable = $guardian_DAO->GetById($idsGuardiansAvailable);
                
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