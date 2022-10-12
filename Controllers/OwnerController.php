<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;

    class OwnerController 
    {

        private $ownerDAO;

        public function __contruct()
        {
            $this->ownerDAO = new OwnerDAO();
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."Register.php");
        }

        public function ShowListView()
        {
            $ownerList = $this->ownerDAO->getAll();
            
            require_once(VIEWS_PATH."GuardianHome.php");
        }

        public function Add($name, $last_name, $dni, $tel, $email, $pass)
        {
            $owner = new Owner();

            $owner->setId_owner(OwnerDAO->GetNextId());
            $owner->setName($name);
            $owner->setLast_name($last_name);
            $owner->setDni($dni);
            $owner->setTelephone($tel);
            $owner->setEmail($email);
            $owner->setPassword($pass);

            $this->ownerDAO->Add($owner);

            require_once(VIEWS_PATH."Home.php");
        }
    }
?>