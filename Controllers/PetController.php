<?php
    namespace Controllers;
    
    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;

    use Models\pet as pet;
    use Models\Cat as Cat;
    
    use Controllers\CatController as CatController;
    use Controllers\petController as petController;
    
    // use to bdd
    use DAO\PetDAO as PetDAO;

    class PetController 
    {
        public function __contruct()
        {
            
        }

        // DATABASE CLASSES ↓

        public function ShowList()
        {
            if (isset($_SESSION['idOwner']))
            {
                $petDAO = new PetDAO();
                $petsList = array();

                $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);

                require_once(VIEWS_PATH . "PetsProfiles.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function CreatePet ($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info)
        {
            if (isset($_SESSION['idOwner']))
            {
                $petDAO = new PetDAO();
                $pet = new Pet();

                // VER - CARGA ARCHIVOS!
                
                // -> SETs PET
                $pet->setId_owner($_SESSION['idOwner']);
                $pet->setImg($imgFile);
                $pet->setName($name);
                $pet->setType($radio_option);
                $pet->setBreed($breed);
                $pet->setSize($size);
                $pet->setPlanVacunacion($pvFile);
                $pet->setVideo($video);
                $pet->setInfo($info);
                // <- SETs PET

                // -> ADD PET
                $pet_id = $petDAO->Add($pet);
                // <- ADD PET
                
                // -> REDIRECTION TO PET/SHOWLIT
                header("location: " . FRONT_ROOT . "Pet/ShowList");
                // <- REDIRECTION TO PET/SHOWLIT
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function Remove ($id)
        {
            $petDAO = new PetDAO();
            $petDAO->Remove($id);

            // -> REDIRECTION TO PET/SHOWLIT
            header("location: " . FRONT_ROOT . "Pet/ShowList");
            // <- REDIRECTION TO PET/SHOWLIT
        }

        // DATABASE CLASSES ↑

        // JSON CLASSES ↓

        // public function ShowList()
        // {
        //     if (isset($_SESSION['idOwner']))
        //         {
        //         $catDAO = new CatDAO();
        //         $petDAO = new petDAO();
        //         $catList = array();
        //         $petList = array();
        //         $petsList = array();

        //         $catList = $catDAO->GetByOwner($_SESSION["idOwner"]);
        //         $petList = $petDAO->GetByOwner($_SESSION["idOwner"]);

        //         $petsList = array_merge($catList, $petList);

        //         require_once(VIEWS_PATH . "PetsProfiles.php");
        //     }
        //     else
        //     {
        //         header("location: " . FRONT_ROOT . "Auth/ShowLogin");
        //     }   
        // }

        // public function CreatePet ($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info)
        // {
        //     if (isset($_SESSION['idOwner']))
        //     {   
        //         if ($radio_option == "Gato")
        //         {
        //             // CREA EL CAT CON LA FUNCION DEL CATCONTROLLER
        //             $catController = new CatController;
        //             $catController->AddNewCat($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info);
        //         }
        //         else
        //         {
        //             // CREA EL pet CON LA FUNCION DEL petCONTROLLER
        //             $petController = new petController;
        //             $petController->AddNewpet($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info);
        //         }
                
        //         // -> REDIRECTION TO PET/SHOWLIT
        //         header("location: " . FRONT_ROOT . "Pet/ShowList");
        //         // <- REDIRECTION TO PET/SHOWLIT
        //     }
        //     else
        //     {
        //         header("location: " . FRONT_ROOT . "Auth/ShowLogin");
        //     }  
        // }

        // public function ShowViewModal_Perro($id)
        // {
        //    $petController = new petController();
           
        //     $petController->ShowpetProfile($id);
        // }

        // public function ShowViewModal_Gato($id)
        // {
        //     $catController = new CatController();
            
        //     $catController->ShowCatProfile($id);    
        // }

        // public function RemovePerro($id)
        // {
        //     $petDAO = new petDAO();
        //     $petDAO->Remove($id);

        //     // -> REDIRECTION TO PET/SHOWLIT
        //     header("location: " . FRONT_ROOT . "Pet/ShowList");
        //     // <- REDIRECTION TO PET/SHOWLIT
        // }

        // public function RemoveGato($id)
        // {
        //     $catDAO = new CatDAO();
        //     $catDAO->Remove($id);

        //     // -> REDIRECTION TO PET/SHOWLIT
        //     header("location: " . FRONT_ROOT . "Pet/ShowList");
        //     // <- REDIRECTION TO PET/SHOWLIT
        // }

        // JSON CLASSES ↑
        
    }

?>