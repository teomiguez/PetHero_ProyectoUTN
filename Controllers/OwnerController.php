<?php
    namespace Controllers;
    
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;
    use Models\Owner as Owner;

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


        /* ---------------------------------------------
        Esta funcion no tiene uso por ahora, porque usamos la funcion 
        de ShowList que esta en PetController, que hace lo mismo*/

        public function ShowPets()
        {            
            $owner_DAO = new OwnerDAO();
            $pet_DAO = new PetDAO();

            $user = $owner_DAO->GetById($_SESSION['id']);
            $pets = $pet_DAO->GetByOwner($_SESSION['id']);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }
        // --------------------------------------------


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

        public function ShowFilterGuardians($fist_day, $last_day)
        {
            if (isset($_SESSION['idOwner']))
            {  
                $guardian_DAO = new GuardianDAO();
                $avStayDAO = new AvStayDAO();

                $guardians = $guardian_DAO->GetById($avStayDAO->GetIdGuardian_ByDates($fist_day, $last_day));

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }
    }
?>