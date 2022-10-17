<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;

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

            require_once(VIEWS_PATH . "OwnerHome.php");
        }

        public function ShowPets()
        {            
            $owner_DAO = new OwnerDAO();

            $user = $owner_DAO->GetById($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function ShowProfile()
        {            
            $owner_DAO = new OwnerDAO();

            $user = $owner_DAO->GetById($_SESSION["id"]);

            require_once(VIEWS_PATH . "OwnerProfile.php");
        }
    }
?>