<?php
    namespace Controllers;

    use DAO\CatDAO as CatDAO;
    use Models\Pet as Pet;
    use Models\Cat as Cat;
    
    class CatController
    {
        public function __contruct()
        {
            require_once(ROOT . "/Utils/ValidateSession.php");

            if ($_SESSION["type"] == "guardian") 
            {
                header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
            }
        } 

        // esta funcion no tiene uso por ahora, porque usamos la funcion ShowList del AuthController que muestra todas las mascotas 

        public function ShowList()
        {
            $catDAO = new CatDAO();
            $catList = array();

            $catList = $catDAO->GetByOwner($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function ShowCatProfile($id)
        {
            $catDAO = new CatDAO();
            $pet = $catDAO->GetById($id);

            $("#viewPet_modal").modal("show");

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        // esta funcion no tiene uso por ahora, porque usamos la funcion CreatePet del AuthController que sirve para crear un cat o un dog 

        public function AddNewCat($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info)
        {
            $catDAO = new CatDAO;
            $cat = new Cat;

            // -> SETs CAT
            $cat->setId_owner($_SESSION['idOwner']);
            $cat->setImg($imgFile);
            $cat->setName($name);
            $cat->setType($radio_option);
            $cat->setBreed($breed);
            $cat->setSize($size);
            $cat->setPlanVacunacion($pvFile);
            $cat->setVideo($video);
            $cat->setInfo($info);
            // <- SETs CAT

            // -> ADD CAT TO JSON
            $catDAO->Add($cat);
            // <- ADD CAT TO JSON
        }
    }

?>