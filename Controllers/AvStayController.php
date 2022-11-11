<?php
    namespace Controllers;

    use DAO\AvStayDAO as AvStayDAO;
    use Models\AvStay as AvStay;

    class AvStayController 
    {
        public function __contruct()
        {
            
        } 

        public function CreateAvStay ($first_day, $last_day) 
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $avStayDAO = new AvStayDAO;
                $avStay = new AvStay;
    
                if ($this->checkDiffDays($first_day, $last_day) == true)
                {
                    if ($this->checkExistStayDays($_SESSION['idGuardian'], $first_day, $last_day) == true)
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
                        header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian");
                        // <- REDIRECTION TO AvStay/ShowList
                    }
                    else
                    {
                        header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian"); // ver pasar alert
                    }
                }
                else
                {
                    header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian"); // ver pasar alert
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

        function checkExistStayDays($id_guardian, $first_day, $last_day)
        {
            $avStayDAO = new AvStayDAO;
            $avStay = new AvStay;
            $avStayList = array();

            $flag = true;

            $avStayList = $avStayDAO->GetByKeeper($id_guardian);

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
            header("location: " . FRONT_ROOT . "Guardian/ShowHome_Guardian");
            // <- REDIRECTION TO AvStay/SHOWLIT
        }

    }

?>