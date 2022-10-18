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

        public function ShowList()
        {
            $petDAO = new PetDAO();
            $petList = array();

            $petList = $petDAO->GetByOwner($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function Add($id_owner, $name, $img, $size, $video, $info)
        {
            $petDAO = new PetDAO();
            $pet = new Pet();

            $pet->setId_pet($petDAO->GetNextId());
            $pet->setId_owner($id_owner);
            $pet->setName($name);
            $pet->setImg($img);
            $pet->setSize($tamaño);
            $pet->setInfo($info);

            if ($video != null)
                $pet->setVideo($video);
            else {
                $video = " ";
                $pet->setVideo($video);
            }

            $petDAO->Add($pet);
        }
    }

?>