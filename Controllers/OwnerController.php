<?php
    namespace Controllers;
    
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;
    use Models\Owner as Owner;

    class OwnerController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "guardian") 
            {
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
            }
        } 

        public function HomeOwner()
        {            
            $owner_DAO = new OwnerDAO();

            $user = $owner_DAO->GetById($_SESSION["id"]);

            $this->ShowGuardians();
        }

        public function ShowPets()
        {            
            $owner_DAO = new OwnerDAO();
            $pet_DAO = new PetDAO();

            $user = $owner_DAO->GetById($_SESSION['id']);
            $pets = $pet_DAO->GetByOwner($_SESSION['id']);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function ShowProfile()
        {            
            $owner_DAO = new OwnerDAO();

            $user = $owner_DAO->GetById($_SESSION["id"]);

            require_once(VIEWS_PATH . "OwnerProfile.php");
        }

        public function ShowGuardians()
        {
            $guardian_DAO = new GuardianDAO();

            $guardians = $guardian_DAO->GetAll();

            require_once(VIEWS_PATH . "OwnerHome.php");
        }
    }
?>