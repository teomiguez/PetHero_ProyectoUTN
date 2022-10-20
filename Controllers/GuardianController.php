<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;

    class GuardianController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "guardian") 
            {
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
            }
        } 

        public function HomeGuardian()
        {
            $guardian_DAO = new GuardianDAO();

            $user = $guardian_DAO->GetById($_SESSION["id"]);

            require_once(VIEWS_PATH . "GuardianHome.php");
        }


    }
?>