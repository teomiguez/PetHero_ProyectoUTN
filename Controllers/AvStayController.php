<?php
    namespace Controllers;

    use DAO\AvStayDAO as AvStayDAO;
    use Models\AvStay as AvStay;

    class AvStayController 
    {
        public function __contruct()
        {
            
        } 

        public function ShowList($flag = '')
        {
            $avStayDAO = new AvStayDAO();
            $avStayList = array();

            $avStayList = $avStayDAO->GetByKeeper($_SESSION["idGuardian"]);

            if ($flag != '')
            {
                $alert_days = array("type" => "danger", "text" => "Las fechas ingresadas no son coherentes"); //ALERT
            }

            require_once(VIEWS_PATH . "GuardianHome.php");
        }


        public function CreateAvStay ($first_day, $last_day) 
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $avStayDAO = new AvStayDAO;
                $avStay = new AvStay;
    
                if ($this->checkDiffDays($first_day, $last_day) == true)
                {
                    if ($this->checkExistStayDays($first_day, $last_day) == true)
                    {
                        // -> SETs AvStay
                        $avStay->setId_keeper($_SESSION['idGuardian']);
                        $avStay->setFirst_day($first_day);
                        $avStay->setLast_day($last_day);
                        // <- SETs AvStay
            
                        // -> ADD AvStay TO JSON
                        $avStayDAO->Add($avStay);
                        // <- ADD AvStay TO JSON
            
                        // -> REDIRECTION TO AvStay/ShowList
                        header("location: " . FRONT_ROOT . "AvStay/ShowList");
                        // <- REDIRECTION TO AvStay/ShowList
                    }
                    else
                    {
                        header("location: " . FRONT_ROOT . "AvStay/ShowList/flag=1");
                    }
                }
                else
                {
                    header("location: " . FRONT_ROOT . "AvStay/ShowList/flag=1");
                }
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        function checkDiffDays($first_day, $last_day)
        {
            $flag = false;
            
            if ($first_day >= date('Y-m-d'))
            {
                if ($last_day > $first_day)
                {
                    $flag = true;
                }
            }

            return $flag;
        }

        function checkExistStayDays($first_day, $last_day)
        {
            $avStayDAO = new AvStayDAO;
            $avStay = new AvStay;
            $avStayList = array();

            $flag = true;

            $avStayList = $avStayDAO->GetAll();

            foreach($avStayList as $avStay) 
            {
                if (($first_day >= $avStay->getFirst_day()) && ($last_day <= $avStay->getLast_day())) // si es/esta contenida en otra existente
                {
                    $flag = false; // SI EXISTE (NO SE PODRIA CREAR)
                }
                else if ((($first_day >= $avStay->getFirst_day()) && ($first_day <= $avStay->getLast_day())) && ($last_day >= $avStay->getLast_day())) // una parte contenido (Fd)
                {
                    $flag = false; // SI EXISTE (NO SE PODRIA CREAR)
                }
                else if ($first_day <= $avStay->getFirst_day() && (($last_day >= $avStay->getFirst_day()) && ($last_day <= $avStay->getLast_day()))) // una parte contenido (Ld)
                {
                    $flag = false; // SI EXISTE (NO SE PODRIA CREAR)
                }
                else if ($first_day <= $avStay->getFirst_day() && ($last_day >= $avStay->getLast_day())) // contiene a una existente
                {
                    $flag = false; // SI EXISTE (NO SE PODRIA CREAR)
                }
            }

            return $flag;
        }

        public function RemoveStay($id)
        {
            $avStayDAO = new AvStayDAO();
            $avStayDAO->Remove($id);

            // -> REDIRECTION TO AvStay/SHOWLIT
            header("location: " . FRONT_ROOT . "AvStay/ShowList");
            // <- REDIRECTION TO AvStay/SHOWLIT
        }

    }

?>