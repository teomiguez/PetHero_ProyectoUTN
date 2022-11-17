<?php
    namespace Controllers;
    
    use DAO_SQL\CatDAO as CatDAO;
    use DAO_SQL\DogDAO as DogDAO;

    use Models\pet as pet;
    use Models\Cat as Cat;

    use Exception;
    
    use Controllers\CatController as CatController;
    use Controllers\DogController as DogController;
    use Controllers\FileController as FileController;
    
    // use to bdd
    use DAO_SQL\PetDAO as PetDAO;

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

        public function ShowView_Profile($id)
        {
            if (isset($_SESSION['idOwner']))
            {
                $petDAO = new PetDAO();
                $pet = new Pet();

                $pet = $petDAO->GetById($id);

                require_once(VIEWS_PATH . "PetProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function ShowModifyProfile_Pet($id)
        {
            if (isset($_SESSION['idOwner']))
            {
                $petDAO = new PetDAO();
                $pet = new Pet();

                $pet = $petDAO->GetById($id);

                require_once(VIEWS_PATH . "ModifyPetProfile.php");
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
                // $fileController = new FileController();
                $petDAO = new PetDAO();
                $pet = new Pet();

                // $uploadImg = false;
                // $uploadPv = false;
 
                // $uploadImg = $fileController->upload($imgFile, "img");

                // $uploadPv = $fileController->upload($pvFile, "pv");
                
                //if(($uploadImg == true) && ($uploadPv == true))
                //{
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
                //}
                //else
                //{
                    // alert -> error de carga
                //}
                
                // -> REDIRECTION TO PET/SHOWLIT
                header("location: " . FRONT_ROOT . "Pet/ShowList");
                // <- REDIRECTION TO PET/SHOWLIT
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        /**
         *  FALTAN AGREGAR LOS PARAMETROS -> $imgFile - $pvFile - $video
         *  AGREGAR A LA VISTA (CUANDO SE LOGRE GUARDAR Y MOSTRAR ARCHIVOS)
         *  PARA LUEGO DAR OPCION A MODIFICARLOS
         */
        public function UpdateProfile_Pet($id, $name, $breed, $size, $info)
        {
            $petDAO = new PetDAO();
            $pet = new Pet();

            // VER - CARGA ARCHIVOS!
            
            // -> SETs PET
            //$pet->setImg(' ');
            $pet->setName($name);
            $pet->setBreed($breed);

            if(($size != 1) && ($size != 2) && ($size != 3))
            {
                $id_size = $petDAO->GetIdSize($size);
                $pet->setSize($id_size);
            }
            else
            {
                $pet->setSize($size);
            }
            
            //$pet->setPlanVacunacion(' ');
            //$pet->setVideo(' ');
            $pet->setInfo($info);
            // <- SETs PET

            // -> ADD PET
            $petDAO->Update($id, $pet);
            // <- ADD PET
            
            $this->ShowView_Profile($id);
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

        // ---  ESTAS FUNCIONES ERAN USADAS PARA PERSISTIR DATOS EN JSON ANTES DE IMPLEMENTAR PDO EN EL PROYECTO, 
        //      LUEGO FUERON REEMPLAZADAS POR LAS QUE FUNCIONAN PARA PERSISTIR EN BDD  ---
        

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