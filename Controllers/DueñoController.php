<?php
    namespace Controllers;

    use DAO\DueñoDAO as DueñoDAO;
    use Models\Dueño as Dueño;

    class DueñoController 
    {

        private $dueñoDAO;

        public function __contruct()
        {
            $this->dueñoDAO = new DueñoDAO();
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."Register.php");
        }

        public function ShowListView()
        {
            $dueñoList = $this->dueñoDAO->getAll();
            
            require_once(VIEWS_PATH."GuardianHome.php");
        }

        public function Add($name, $last_name, $dni, $tel, $email, $pass)
        {
            $dueño = new Dueño();

            $dueño->setId_dueño(DueñoDAO->GetNextId());
            $dueño->setNombre($name);
            $dueño->setApellido($last_name);
            $dueño->setDni($dni);
            $dueño->setTelefono($tel);
            $dueño->setEmail($email);
            $dueño->setContraseña($pass);

            $this->dueñoDAO->Add($dueño);

            require_once(VIEWS_PATH."Home.php");
        }
    }
?>