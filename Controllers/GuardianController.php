<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use Models\AvStay as AvStay;

    class GuardianController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "owner") 
            {
                header("location: " . FRONT_ROOT . "Owner/HomeOwner");
            }
        } 

        public function ShowProfile()
        {            
            $guardian_DAO = new GuardianDAO();

            $user = $guardian_DAO->GetById($_SESSION["id"]);

            require_once(VIEWS_PATH . "GuardianProfile.php");
        }

        
        public function HomeGuardian()
        {
            $guardian_DAO = new GuardianDAO();

            $user = $guardian_DAO->GetById($_SESSION["id"]);

            $this->ShowAvStays();
        }

    
        public function ShowAvStays()
        {
            $avStayDAO = new AvStayDAO();
            $avStayList = array();

            $avStayList = $avStayDAO->GetByKeeper($_SESSION["id"]);

            require_once(VIEWS_PATH . "GuardianHome.php");
        }

    }
?>