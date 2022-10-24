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
            $catDAO = new CatDAO();
            $dogDAO = new DogDAO();
            $catList = array();
            $dogList = array();
            $petsList = array();

            $catList = $catDAO->GetByOwner($_SESSION["id"]);
            $dogList = $dogDAO->GetByOwner($_SESSION["id"]);

            $petsList = array_merge($catList, $dogList);

            require_once(VIEWS_PATH . "PetsProfiles.php");
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