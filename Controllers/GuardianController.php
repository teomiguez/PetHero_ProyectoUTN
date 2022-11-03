<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use Models\AvStay as AvStay;

    class GuardianController 
    {
        public function __contruct() // no funciona ni le damos uso
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "owner") 
            {
                header("location: " . FRONT_ROOT . "Owner/HomeOwner");
            }
        } 

        public function ShowProfile()
        {   
            if (isset($_SESSION['idGuardian']))
            {         
                $guardian_DAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                $user_review = $reviewDAO->GetById($user->getId_review());

                require_once(VIEWS_PATH . "GuardianProfile.php");
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  

        }

        public function ModifyProfile_Guardian()
        {
            if (isset($_SESSION['idGuardian']))
            {         
                $guardian_DAO = new GuardianDAO();
                $reviewDAO = new ReviewDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);
                $user_review = $reviewDAO->GetById($user->getId_review());

                require_once(VIEWS_PATH . "ModifyGuardianProfile.php");
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        
        public function HomeGuardian()
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $guardian_DAO = new GuardianDAO();

                $user = $guardian_DAO->GetById($_SESSION["idGuardian"]);

                $this->ShowAvStays();
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

    
        public function ShowAvStays()
        {
            if (isset($_SESSION['idGuardian']))
            { 
                $avStayDAO = new AvStayDAO();
                $avStayList = array();

                $avStayList = $avStayDAO->GetByKeeper($_SESSION["idGuardian"]);

                require_once(VIEWS_PATH . "GuardianHome.php");
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

    }
?>