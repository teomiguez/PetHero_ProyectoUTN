<?php
    namespace Controllers;

    use DAO\AvStayDAO as AvStayDAO;
    use Models\AvStay as AvStay;

    class AvStayController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "owner") 
            {
                header("location: " . FRONT_ROOT . "Owner/HomeOwner");
            }
        } 

        public function ShowList()
        {
            $avStayDAO = new AvStayDAO();
            $avStayList = array();

            $avStayList = $avStayDAO->GetByKeeper($_SESSION["id"]);

            require_once(VIEWS_PATH . "GuardianHome.php");
        }

        public function RemoveStay($id)
        {
            $avStayDAO = new AvStayDAO();
            $avStayDAO->Remove($id);

            require_once(VIEWS_PATH . "GuardianHome.php");
        }

    }

?>