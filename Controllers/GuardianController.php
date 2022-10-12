<?php
    namespace Controllers;

    use DAO\GuiardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;

    class DueñoController 
    {

        private $guardianDAO;

        public function __contruct()
        {
            $this->guardianDAO = new GuardianDAO();
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."Register.php");
        }

        public function ShowListView()
        {
            $dueñoList = $this->dueñoDAO->getAll();
            
            require_once(VIEWS_PATH."DueñoHome.php");
        }

        public function Add($name, $last_name, $dni, $tel, $dir, $email, $pass, $dias, $tipoMascota, $precio)
        {
            $guardian = new Guardian();

            $guardian->setId_guardian(GuardianDAO->GetNextId());
            $guardian->setNombre($name);
            $guardian->setApellido($last_name);
            $guardian->setDni($dni);
            $guardian->setTelefono($tel);
            $guardian->setDireccion($dir);
            $guardian->setEmail($email);
            $guardian->setContraseña($pass);
            $guardian->setFechasDisponibles($dias);
            $guardian->setTamañoMascotaPref($tipoMascota);
            $guardian->setPrecio($precio);

            $this->guardianDAO->Add($guardian);

            require_once(VIEWS_PATH."Home.php");
        }
    }
?>