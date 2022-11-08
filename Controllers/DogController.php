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

         // esta funcion no tiene uso por ahora, porque usamos la funcion ShowList del PetController que muestra todas las mascotas 

        public function ShowList()
        {
            $dogDAO = new DogDAO();
            $dogList = array();

            $dogList = $dogDAO->GetByOwner($_SESSION["id"]);

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

        public function ShowDogProfile($id)
        {
            $dogDAO = new DogDAO();
            $pet = $dogDAO->GetById($id);

            $modal = 1;

            require_once(VIEWS_PATH . "PetsProfiles.php");
        }

       
        public function AddNewDog($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info)
        {
            $dogDAO = new DogDAO;
            $dog = new Dog;

            // -> SETs DOG
            $dog->setId_owner($_SESSION['idOwner']);
            $dog->setImg($imgFile);
            $dog->setName($name);
            $dog->setType($radio_option);
            $dog->setBreed($breed);
            $dog->setSize($size);
            $dog->setPlanVacunacion($pvFile);
            $dog->setVideo($video);
            $dog->setInfo($info);
            // <- SETs DOG

            // -> ADD DOG TO JSON
            $dogDAO->Add($dog);
            // <- ADD DOG TO JSON
        }
    }
    
?>