<?php
    namespace Controllers;

    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;
    use Models\Dog as Dog;
    use Models\Cat as Cat;

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
            if ((isset($_SESSION['idOwner'])))
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


      /* ---------------------------------------------
        Esta funcion no tiene uso por ahora, porque usamos la funcion 
        de CreatePet que esta en AuthController, que crea una mascota*/

        public function AddNewPet($id_owner, $name, $img, $size, $video, $info)
        {
            
        }

    //----------------------------------------------------
        
    }

?>