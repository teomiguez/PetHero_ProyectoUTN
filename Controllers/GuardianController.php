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
            
            require_once(VIEWS_PATH."OwnerHome.php");
        }

        public function Add($name, $last_name, $dni, $tel, $dir, $email, $pass, $days, $sizePet, $cost)
        {
            $guardian = new Guardian();

            $guardian->setId_guardian(GuardianDAO->GetNextId());
            $guardian->setName($name);
            $guardian->setLast_name($last_name);
            $guardian->setDni($dni);
            $guardian->setTelephone($tel);
            $guardian->setAddress($dir);
            $guardian->setEmail($email);
            $guardian->setPassword($pass);
            $guardian->setDays($days);
            $guardian->setSaizeCare($sizePet);
            $guardian->setCost($cost);

            $this->guardianDAO->Add($guardian);

            require_once(VIEWS_PATH."Home.php");
        }
    }
?>