<?php
    namespace Controllers;

    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;
    use Models\Dog as Dog;
    use Models\Cat as Cat;
    use Controllers\CatController as CatController;
    use Controllers\DogController as DogController;

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
            if (isset($_SESSION['idOwner']))
                {
                $catDAO = new CatDAO();
                $dogDAO = new DogDAO();
                $catList = array();
                $dogList = array();
                $petsList = array();

                $catList = $catDAO->GetByOwner($_SESSION["idOwner"]);
                $dogList = $dogDAO->GetByOwner($_SESSION["idOwner"]);

                $petsList = array_merge($catList, $dogList);

                require_once(VIEWS_PATH . "PetsProfiles.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }   
        }

        public function CreatePet ($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info) // X
        {
            if (isset($_SESSION['idOwner']))
            {   
                if ($radio_option == "Gato")
                {
                    // CREA EL CAT CON LA FUNCION DEL CATCONTROLLER
                    $catController = new CatController;
                    $catController->AddNewCat($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info);
                }
                else
                {
                    // CREA EL DOG CON LA FUNCION DEL DOGCONTROLLER
                    $dogController = new DogController;
                    $dogController->AddNewDog($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info);
                }
                
                // -> REDIRECTION TO PET/SHOWLIT
                header("location: " . FRONT_ROOT . "Pet/ShowList");
                // <- REDIRECTION TO PET/SHOWLIT
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }


        public function ShowViewModal_Perro($id)
        {
            $dogDAO = new DogDAO();
            $dog = new Dog();

            $pet = $dogDAO->GetById($id);

            // abrir el modal o (ultima opcion) crear pagina solo para la mascota
        }

        public function ShowViewModal_Gato($id)
        {
            $catDAO = new CatDAO();
            $cat = new Cat();

            $pet = $catDAO->GetById($id);
            
            // abrir el modal o (ultima opcion) crear pagina solo para la mascota
        }

        public function RemovePerro($id)
        {
            $dogDAO = new DogDAO();
            $dogDAO->Remove($id);

            // -> REDIRECTION TO PET/SHOWLIT
            header("location: " . FRONT_ROOT . "Pet/ShowList");
            // <- REDIRECTION TO PET/SHOWLIT
        }

        public function RemoveGato($id)
        {
            $catDAO = new CatDAO();
            $catDAO->Remove($id);

            // -> REDIRECTION TO PET/SHOWLIT
            header("location: " . FRONT_ROOT . "Pet/ShowList");
            // <- REDIRECTION TO PET/SHOWLIT
        }
        
    }

?>