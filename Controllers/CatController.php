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

        public function ShowList()
        {
            $catDAO = new CatDAO();
            $catList = array();

            $catList = $catDAO->GetByOwner($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function AddNewCat($id_owner, $name, $img, $size, $video, $info)
        {
            $catDAO = new CatDAO();
            $cat = new Cat();

            // -> SETs CAT
            $cat->setId_owner($_SESSION['id']);
            $cat->setImg($imgFile);
            $cat->setName($name);
            $cat->setBreed($breed);
            $cat->setSize($size);
            $cat->setPlanVacunacion($pvFile);
            $cat->setType('Gato');
            $cat->setVideo($video);
            $cat->setInfo($remarks);
            // <- SETs CAT

            // -> ADD CAT TO JSON
            $catDAO->Add($cat);
            // <- ADD CAT TO JSON

            // -> REDIRECTION TO CAT/SHOWLIT
            header("location: " . FRONT_ROOT . "Cat/ShowList");
            // <- REDIRECTION TO CAT/SHOWLIT
        }
    }

?>