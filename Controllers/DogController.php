<?php
    namespace Controllers;

    use DAO_Json\DogDAO as DogDAO;
    use Models\Pet as Pet;
    use Models\Dog as Dog;
    
    class DogController
    {
        public function __contruct()
        {
            
        } 

        // JSON CLASSES ↓

        // ---  SE INVOCAN EN LAS FUNCIONES DE PETCONTROLLER CUANDO SE QUIERE PERSISTIR DATOS CON JSON ----

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

        // JSON CLASSES ↑
    }
    
?>