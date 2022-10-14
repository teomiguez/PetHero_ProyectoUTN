<?php
    namespace Controllers;

    use DAO\GuiardianDAO as GuardianDAO;

    class DueñoController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "owner") 
            {
                header("location: " . FRONT_ROOT . "Owner/HomeOwner");
            }
        } 

        public function HomeGuardian()
        {
            var_dump($_SESSION);

            $guardian_DAO = new GuardianDAO();

            $user = $guardian_DAO->GetById($_SESSION['id']);

            require_once(VIEWS_PATH . "GuardianHome.php");
        }
    }
?>