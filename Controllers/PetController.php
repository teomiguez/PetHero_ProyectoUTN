<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use Models\Pet as Pet;

    class PetController 
    {
        private $petDAO;
        
        public function __contruct()
        {
            $this->petDAO = new PetDAO();
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."PetsPerfiles.php");
        }

        public function ShowListView()
        {
            $petList = $this->petDAO->getAll();
            
            require_once(VIEWS_PATH."PetsPerfiles.php");
        }

        public function Add($id_owner, $name, $img, $size, $video = "", $info)
        {
            $pet = new Pet();

            $pet->setId_pet(MascotaDAO->GetNextId());
            $pet->setId_owner($id_wner);
            $pet->setName($name);
            $pet->setImg($img);
            $pet->setSize($tamaño);
            $pet->setVideo($video);
            $pet->setInfo($info);

            $this->petDAO->Add($pet);

            this->ShowListView();
        }
    }

?>