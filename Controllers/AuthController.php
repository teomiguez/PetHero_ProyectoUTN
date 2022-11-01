<?php
    namespace Controllers;

    use DAO\GuardianDAO as GuardianDAO;
    use DAO\ReviewDAO as ReviewDAO;
    use DAO\OwnerDAO as OwnerDAO;
    use DAO\PetDAO as PetDAO;
    use DAO\AvStayDAO as AvStayDAO;
    use DAO\CatDAO as CatDAO;
    use DAO\DogDAO as DogDAO;

    use Models\Guardian as Guardian;
    use Models\Review as Review;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\AvStay as AvStay;
    use Models\Cat as Cat;
    use Models\Dog as Dog;


    class AuthController
    {
        public function Index($message = "")
        {
            if ((isset($_SESSION['idOwner'])) || (isset($_SESSION['idOwner'])))
            {
                session_destroy();
            }

            require_once(VIEWS_PATH."Home.php");
        }
        
        // -> PUBLIC FUNCTIONs
        
        public function ShowRegist()
        {
            require_once(VIEWS_PATH . "Register.php");
        }

        public function ShowLogin()
        {
            require_once(VIEWS_PATH . "Home.php");
        }

        public function Login($email = null, $password = null)
        {

            // Validacion por si se quiere acceder a la funcion Login desde la URL, sin pasar los parametros $email y $password
            if ($email == null || $password == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
            }
            else
            {   // Login de owner o guardian

                session_destroy();

                $ownerDAO = new OwnerDAO;
                $guardianDAO = new GuardianDAO;
    
                $user1 = $ownerDAO->GetByEmail($email);
                $user2 = $guardianDAO->GetByEmail($email);
    
                if ($user1 != null)
                {
                    if ($user1->getPassword() == $password)
                    {
                        // NEW SESSION
                        session_start();
    
                        $_SESSION['idOwner'] = $user1->getId_owner();
    
                        // -> REDIRECTION TO HOME_OWNER
                        header("location: " . FRONT_ROOT . "Owner/HomeOwner");
                        // <- REDIRECTION TO HOME_OWNER
                    }
                    else
                    {
                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                        // AGREGAR EXCEPTION/ALERT 'CONTRASEÑA INCORRECTA'
                    }
                }
                else if ($user2 != null)
                {
                    if ($user2->getPassword() == $password)
                    {
                        // NEW SESSION
                        session_start();
        
                        $_SESSION['idGuardian'] = $user2->getId_guardian();
    
                        // -> REDIRECTION TO HOME_GUARDIAN
                        header("location: " . FRONT_ROOT . "Guardian/HomeGuardian");
                        // <- REDIRECTION TO HOME_GUARDIAN
                    }
                    else
                    {
                        header("location: " . FRONT_ROOT . "Auth/ShowLogin");
                        // AGREGAR EXCEPTION/ALERT 'CONTRASEÑA INCORRECTA'
                    }
    
                }
                else
                {
                    // AGREGAR EXCEPTION/ALERT 'USUARIO Y/O CONSTRASEÑA INCORRECTOS'
    
                    // -> REDIRECTION TO 'Register.php'
                    require_once(VIEWS_PATH . "Register.php");
                    // <- REDIRECTION TO 'Register.php'
                }
            }
        }

        public function Logout()
        {
            session_destroy();

            header ("location: " . FRONT_ROOT . "Auth/ShowLogin"); 
        }

        public function Register($name = null, $last_name = null, $dni = null, $tel = null, $email = null, $password = null, $radio_option = null, $street = '', $nro = '', $typeSize = '', $cost = '')
        {

           // Validacion por si se quiere acceder a la funcion Register desde la URL, sin pasar los parametros del registro
            if ($name == null || $last_name == null || $dni == null || $tel == null || $email == null || $password == null || $radio_option == null)
            {
                header("location: " . FRONT_ROOT . "Auth/ShowRegist"); 
            }
            else
            {   // Register de un owner o guardian
                
                if (($this->checkExistenceEmail($email) == false) && ($this->checkExistenceDni($dni) == false))
                {
                    if ($radio_option == 'dueño')
                    {
                        $this->RegisterOwner($name, $last_name, $dni, $tel, $email, $password);
                    } 
                    else if ($radio_option == 'guardian')
                    {
                        $this->RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost);
                    }
                    
                    // -> REDIRECTION TO 'Home.php'
                    require_once(VIEWS_PATH . "Home.php");
                    // <- REDIRECTION TO 'Home.php'
                }
                else
                {
                    // AGREGAR EXCEPTION/ALERT!!
                    require_once(VIEWS_PATH . "Register.php");
                }
            }
            
        }

        // -> HAY QUE VER CAMBIAR DE LUGAR Y MODIFICAR ALGUNAS FUNCIONES (X) NO RELACIONADAS AL AUTH 
        //    ORDENARLAS EN LOS CONTROLLERS ADECUADOS

        public function CreatePet ($imgFile, $name, $radio_option, $breed, $size, $pvFile, $video, $info) // X
        {
            if (isset($_SESSION['idOwner']))
            {   
                if ($radio_option == "Gato")
                {
                    $catDAO = new CatDAO;
                    $cat = new Cat;

                    // -> SETs CAT
                    $cat->setId_owner($_SESSION['idOwner']);
                    $cat->setImg($imgFile);
                    $cat->setName($name);
                    $cat->setType($radio_option);
                    $cat->setBreed($breed);
                    $cat->setSize($size);
                    $cat->setPlanVacunacion($pvFile);
                    $cat->setVideo($video);
                    $cat->setInfo($info);
                    // <- SETs CAT

                    // -> ADD CAT TO JSON
                    $catDAO->Add($cat);
                    // <- ADD CAT TO JSON
                }
                else
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
                
                // -> REDIRECTION TO PET/SHOWLIT
                header("location: " . FRONT_ROOT . "Pet/ShowList");
                // <- REDIRECTION TO PET/SHOWLIT
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        
        public function CreateAvStay ($first_day, $last_day) // X
        {
            if (isset($_SESSION['idGuardian']))
            {  
                $avStayDAO = new AvStayDAO;
                $avStay = new AvStay;
    
                if ($this->checkDiffDays($first_day, $last_day) == true)
                {
                    // -> SETs AvStay
                    $avStay->setId_keeper($_SESSION['idGuardian']);
                    $avStay->setFirst_day($first_day);
                    $avStay->setLast_day($last_day);
                    // <- SETs AvStay
        
                    // -> ADD AvStay TO JSON
                    $avStayDAO->Add($avStay);
                    // <- ADD AvStay TO JSON
        
                    // -> REDIRECTION TO AvStay/ShowList
                    header("location: " . FRONT_ROOT . "AvStay/ShowList");
                    // <- REDIRECTION TO AvStay/ShowList
                }
                else
                {
                    header("location: " . FRONT_ROOT . "AvStay/ShowList");
                }
            }
            else
            {
                 header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        // public function FilterDates ($first_day, $last_day) // VER COMO PASAR LAS FECHAS POR QUERYPARAMS (X)
        // {
        //     if ((isset($_SESSION['idOwner'])))
        //     {  
        //         if ($this->checkDiffDays($first_day, $last_day) == true)
        //         {
        //             // -> REDIRECTION TO HOME_FILTER_OWNER
        //             header("location: " . FRONT_ROOT . "Owner/HomeFilterOwner"); // X
        //             // <- REDIRECTION TO HOME_FILTER_OWNER
        //         }
        //         else
        //         {
        //             // -> REDIRECTION TO HOME_OWNER
        //             header("location: " . FRONT_ROOT . "Owner/HomeOwner");
        //             // <- REDIRECTION TO HOME_OWNER
        //         }
        //     }
        //     else
        //     {
        //          header("location: " . FRONT_ROOT . "Auth/ShowLogin");
        //     }  
        //}
        
        // <- PUBLIC FUNCTIONs
        
        // -> THIS FUNCTIONs
        
        function checkExistenceEmail($email)
        {
            $ownerDAO = new OwnerDAO;
            $guardianDAO = new GuardianDAO;

            if ($ownerDAO->getByEmail($email) || $guardianDAO->getByEmail($email))
            {
                return true; // EXISTE
            }
            else
            {
                return false; // NO EXISTE
            }
        }

        function checkExistenceDni($dni)
        {
            $ownerDAO = new OwnerDAO;
            $guardianDAO = new GuardianDAO;

            if ($ownerDAO->getByDni($dni) || $guardianDAO->getByDni($dni))
            {
                return true; // EXISTE
            }
            else
            {
                return false; // NO EXISTE
            }
        }

        function RegisterOwner($name, $last_name, $dni, $tel, $email, $password)
        {
            $ownerDAO = new OwnerDAO();
            $owner = new Owner();

            // -> SETs OWNER
            $owner->setName($name);
            $owner->setLast_name($last_name);
            $owner->setDni($dni);
            $owner->setTelephone($tel);
            $owner->setEmail($email);
            $owner->setPassword($password);
            // <- SETs OWNER

            // -> ADD OWNER TO JSON
            $ownerDAO->Add($owner);
            // <- ADD OWNER TO JSON
        }

        function RegisterGuardian($name, $last_name, $dni, $tel, $email, $password, $street, $nro, $typeSize, $cost)
        {
            $guardianDAO = new GuardianDAO();
            $reviewDAO = new ReviewDAO();
            $guardian = new Guardian();
            $review = new Review();

            $address = $street . " " . $nro;

            // -> SETs GUARDIAN
            $guardian->setId_guardian($guardianDAO->GetNextId_guardian());
            $guardian->setName($name);
            $guardian->setLast_name($last_name);
            $guardian->setDni($dni);
            $guardian->setTelephone($tel);
            $guardian->setEmail($email);
            $guardian->setPassword($password);
            $guardian->setAddress($address);
            $guardian->setSizeCare($typeSize);
            $guardian->setCost($cost);
            $guardian->setId_review($reviewDAO->GetNextId_review());
            // <- SETs GUARDIAN 

            // -> SETs REVIEW
            $review->setId_review($reviewDAO->GetNextId_review());
            $review->setId_guardian($guardianDAO->GetNextId_guardian());
            $review->setQuantity_reviews(0);
            $review->setSum_reviews(0);
            $review->setReview(0);
            // <- SETs REVIEW
            
            // -> ADD REVIEW TO JSON
            $reviewDAO->Add($review);
            // <- ADD REVIEW TO JSON

            // -> ADD GUARDIAN TO JSON
            $guardianDAO->Add($guardian);
            // <- ADD GUARDIAN TO JSON
        }

        // <- THIS  FUNCTIONs

    }

?>