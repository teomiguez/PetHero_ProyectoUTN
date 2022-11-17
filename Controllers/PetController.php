<?php
    namespace Controllers;
    
    //use DAO_Json\CatDAO as CatDAO; // -> SOLO SE USA CON JSON POR TEMAS DE DISEÑO DE LA BDD
    //use DAO_Json\DogDAO as DogDAO; // -> SOLO SE USA CON JSON POR TEMAS DE DISEÑO DE LA BDD
    //use Models\Cat as Cat; // -> SOLO SE USA CON JSON POR TEMAS DE DISEÑO DE LA BDD
    //use Models\Dog as Dog; // -> SOLO SE USA CON JSON POR TEMAS DE DISEÑO DE LA BDD

    use Models\pet as pet;

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
                try
                {
                    $petDAO = new PetDAO();
                    $petsList = array();
    
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

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
                try
                {
                    $petDAO = new PetDAO();
                    $pet = new Pet();
    
                    $pet = $petDAO->GetById($id);
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

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
                try
                {
                    $petDAO = new PetDAO();
                    $pet = new Pet();
    
                    $pet = $petDAO->GetById($id);
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
                }

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
                try
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
                }
                catch(Exception $ex)
                {
                    $alert = [
                            "type" => "danger",
                            "text" => $ex->getMessage()
                        ];
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

        /**
         *  FALTAN AGREGAR LOS PARAMETROS -> $imgFile - $pvFile - $video
         *  AGREGAR A LA VISTA (CUANDO SE LOGRE GUARDAR Y MOSTRAR ARCHIVOS)
         *  PARA LUEGO DAR OPCION A MODIFICARLOS
         */
        public function UpdateProfile_Pet($id, $name, $breed, $size, $info)
        {
            try
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
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }
            
            $this->ShowView_Profile($id);
        }

        public function Remove ($id)
        {
            try
            {
                $petDAO = new PetDAO();
                $petDAO->Remove($id);
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }

            // -> REDIRECTION TO PET/SHOWLIT
            header("location: " . FRONT_ROOT . "Pet/ShowList");
            // <- REDIRECTION TO PET/SHOWLIT
        }

        // DATABASE CLASSES ↑
        

        // JSON CLASSES ↓   

        // ---  ESTAS FUNCIONES ERAN USADAS PARA PERSISTIR DATOS EN JSON ANTES DE IMPLEMENTAR PDO EN EL PROYECTO, 
        //      LUEGO FUERON REEMPLAZADAS POR LAS QUE FUNCIONAN PARA PERSISTIR EN BDD  ---

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