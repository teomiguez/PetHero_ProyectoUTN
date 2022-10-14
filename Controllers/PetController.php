<?php
    namespace Controllers;

    use DAO\PetDAO as PetDAO;
    use Models\Pet as Pet;

    class PetController 
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "guardian") 
            {
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
            }
        } 

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."PetsPerfiles.php");
        }

        public function ShowListView()
        {
            echo "<script>console.log('Debug Objects: " . var_dump($_SESSION) . "' );</script>";
            
            $pet_DAO = new PetDAO();
            $petList = $this->petDAO->GetByOwner($_SESSION['id']);
            
            require_once(VIEWS_PATH."PetsPerfiles.php");
        }

        public function Add($id_owner, $name, $img, $size, $video = "", $info)
        {
            $pet = new Pet();

            $pet->setId_pet(PetDAO->GetNextId());
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