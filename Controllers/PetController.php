<?php
    namespace Controllers;

    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;

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

        public function RemovePet($id, $type)
        {
            $catDAO = new CatDAO();
            $dogDAO = new DogDAO();

            if ($type = 'Perro')
            {
                $dogDAO->Remove($id);
            }
            else
            {
                $catDAO->Remove($id);
            }
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