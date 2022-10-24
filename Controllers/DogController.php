<?php
    namespace Controllers;

    use DAO\DogDAO as DogDAO;
    use Models\Pet as Pet;
    use Models\Dog as Dog;
    
    class DogController
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
            $dogDAO = new DogDAO();
            $dogList = array();

            $dogList = $dogDAO->GetByOwner($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function AddNewdog($id_owner, $name, $img, $size, $video, $info)
        {
            $dogDAO = new DogDAO();
            $dog = new Dog();

            // -> SETs DOG
            $dog->setId_owner($_SESSION['id']);
            $dog->setImg($imgFile);
            $dog->setName($name);
            $dog->setBreed($breed);
            $dog->setSize($size);
            $dog->setPlanVacunacion($pvFile);
            $dog->setType('Perro');
            $dog->setVideo($video);
            $dog->setInfo($remarks);
            // <- SETs DOG

            // -> ADD DOG TO JSON
            $dogDAO->Add($dog);
            // <- ADD DOG TO JSON

            // -> REDIRECTION TO DOG/SHOWLIT
            header("location: " . FRONT_ROOT . "Dog/ShowList");
            // <- REDIRECTION TO DOG/SHOWLIT
        }
    }
    
?>