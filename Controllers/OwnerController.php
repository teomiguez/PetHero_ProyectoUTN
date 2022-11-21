<?php
    namespace Controllers;
    
    use Controllers\ReservationController as ReservationController;
    use Controllers\PaymentCouponController as PaymentCouponController;
    use Controllers\ReviewController as ReviewController;
    
    use DAO_SQL\OwnerDAO as OwnerDAO;
    use DAO_SQL\GuardianDAO as GuardianDAO;
    use DAO_SQL\ReviewDAO as ReviewDAO;
    use DAO_SQL\AvStayDAO as AvStayDAO;
    use DAO_SQL\ReservationDAO as ReservationDAO;
    use DAO_SQL\PetDAO as PetDAO;
    use DAO_SQL\PaymentCouponDAO as PaymentCouponDAO;

    use Models\Owner as Owner;
    use Models\Guardian as Guardian;
    use Models\Review as Review;
    use Models\AvStay as AvStay;
    use Models\Reservation as Reservation;
    use Models\ReservationForPet as ReservationForPet;
    use Models\Pet as Pet;
    use Models\PaymentCoupon as PaymentCoupon;

    use Exception;

    class OwnerController 
    {
        public function __contruct() 
        {
            
        }

        public function ShowHome_Owner($alert = '')
        {    
            if (isset($_SESSION['idOwner']))
            {
                try
                {                
                    $ownerDAO = new OwnerDAO();
                    $guardianDAO = new GuardianDAO();
                    $reservationDAO = new ReservationDAO();
                    $petDAO = new PetDAO();

                    $dailyReservs = array();
                    $pastReserv = array();
                    
                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                    $guardians = $guardianDAO->GetAll();
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);
                    
                    $reservList = $reservationDAO->GetByOwner($_SESSION['idOwner']); // obtengo todas las reservas de pet_x_reservation
                    $diffReservs = $this->diffReservs_and_putObjects($reservList); // diferencio las reservas y cambio las ids por los objetos
                
                    if (!empty($diffReservs))
                    {
                        $dailyReservs = $diffReservs['daily'];
                        $pastReserv = $diffReservs['last'];
                    }
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
            
            require_once(VIEWS_PATH . "OwnerHome.php");
        }

        public function ShowHome_FilterGuardians($first_day, $last_day, $alert = '') 
        { 
            if (isset($_SESSION['idOwner']))
            {  
                try
                {
                    $guardianDAO = new GuardianDAO();
                    $ownerDAO = new OwnerDAO();
                    $avStayDAO = new AvStayDAO();
                    $reservationDAO = new ReservationDAO();
                    $petDAO = new PetDAO();
    
                    $guardian = new Guardian();

                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);

                    $reservList = $reservationDAO->GetByOwner($_SESSION['idOwner']); // obtengo todas las reservas de pet_x_reservation
                    $diffReservs = $this->diffReservs_and_putObjects($reservList); // diferencio las reservas y cambio las ids por los objetos
                
                    if (!empty($diffReservs))
                    {
                        $dailyReservs = $diffReservs['daily'];
                        $pastReserv = $diffReservs['last'];
                    }
    
                    $guardians = array();
                    $guardiansAviable = array();
                    $petsList = array();
    
                    $datesSelect = [
                        "first_day" => $first_day,
                        "last_day" => $last_day
                    ];
                     
                    $guardians = $guardianDAO->GetAll();
                    $idsGuardiansAvailable = $avStayDAO->GetIdGuardian_ByDates($first_day, $last_day);
                    $petsList = $petDAO->GetByOwner($_SESSION['idOwner']);
    
                    if(empty($idsGuardiansAvailable))
                    {
                        $alert = [
                            "type" => "danger",
                            "text" => "No hay guardianes disponibles en esas fechas"
                        ];
    
                        $this->ShowHome_Owner($alert);
                    }
                    else
                    {
                        foreach($idsGuardiansAvailable as $id)
                        {
                            $guardian = $guardianDAO->GetById($id);
                            array_push($guardiansAviable, $guardian);
                        }
                    }
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "OwnerHome.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function ShowProfile_Owner($alert = '')
        {    
            if (isset($_SESSION['idOwner']))
            {        
                try
                {
                    $ownerDAO = new OwnerDAO();

                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "OwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }  
        }

        public function ShowModifyProfile_Owner($alert = '')
        {
            if (isset($_SESSION['idOwner']))
            {        
                try
                {
                    $ownerDAO = new OwnerDAO();

                    $user = $ownerDAO->GetById($_SESSION["idOwner"]);
                }
                catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "ModifyOwnerProfile.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function ShowReservation($id_coupon, $alert = '')
        {
            if (isset($_SESSION['idOwner']))
            {
                try
                {
                    $paymentCouponDAO = new PaymentCouponDAO();
                    $reservationDAO = new ReservationDAO();
                    $petDAO = new PetDAO();
                    $guardianDAO = new GuardianDAO();
                    $reviewDAO = new ReviewDAO();

                    $coupon = new PaymentCoupon();
                    $reserv = new Reservation();
                    $pet = new Pet();
                    $guardian = new Guardian();
                    $review = new Review();
        
                    $coupon = $paymentCouponDAO->GetById($id_coupon); // el cupon de pago
                    $reserv = $reservationDAO->GetById($coupon->getId_reservation()); // la reserva
                    $pet = $petDAO->GetById($coupon->getId_pet()); // la mascota
                    $guardian = $guardianDAO->GetById($reserv->getId_guardian()); // el guardian
                    $review = $reviewDAO->GetByIdGuardian($reserv->getId_guardian()); // la review del guardian
                }
                catch(Exception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "Reservation_ViewOwner.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function Show_PaymentCoupon ($id, $alert = '')
        {
            if (isset($_SESSION['idOwner']))
            {
                try
                {
                    $paymentCouponDAO = new PaymentCouponDAO();
                    $reservationDAO = new ReservationDAO();
                    $petDAO = new PetDAO();
                    $guardianDAO = new GuardianDAO();

                    $coupon = new PaymentCoupon();
                    $reserv = new Reservation();
                    $pet = new Pet();
                    $guardian = new Guardian();
                    $review = new Review();
        
                    $coupon = $paymentCouponDAO->GetById($id); // el cupon de pago
                    $reserv = $reservationDAO->GetById($coupon->getId_reservation()); // la reserva
                    $pet = $petDAO->GetById($coupon->getId_pet()); // la mascota
                    $guardian = $guardianDAO->GetById($reserv->getId_guardian()); // el guardian
                }
                catch(Exception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "PaymentCoupon_ViewOwner.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            }
        }

        public function ShowViewGuardian($id, $alert = '')
        {
            if (isset($_SESSION['idOwner']))
            {         
                try
                {
                    $guardianDAO = new GuardianDAO();
                    $reviewDAO = new ReviewDAO();

                    $guardian = $guardianDAO->GetById($id);
                    $guardian_review = $reviewDAO->GetByIdGuardian($id);
                }
                    catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                require_once(VIEWS_PATH . "GuardianProfile_ViewOwner.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function PaymentCoupon($nro, $first_month, $last_month, $name, $cod_seg, $id)
        {
            if (isset($_SESSION['idOwner']))
            {         
                try
                {
                    $reservationController = new ReservationController();
                    $paymentCouponController = new PaymentCouponController();

                    $paymentCouponDAO = new PaymentCouponDAO();
                    $reservationDAO = new ReservationDAO();

                    $coupon = new PaymentCoupon();
                    $reserv = new Reservation();

                    $coupon = $paymentCouponDAO->GetById($id);
                    $reserv = $reservationDAO->GetById($coupon->getId_reservation());
                    
                    $paymentCouponController->Payment($id);
                    $reservationController->ConfirmReserv($reserv->getId_reservation());

                    $alert = [
                        "type" => "success",
                        "text" => "Pago realizado"
                    ];
                }
                    catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                $this->ShowHome_Owner($alert);
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        /**
        *	@param Array -> reserva, cupon y mascota
        */
        public function ShowReviewed_Guardian($id_guardian, $alert = '')
        {
            if (isset($_SESSION['idOwner']))
            {         
                try
                {
                    $guardianDAO = new GuardianDAO();
                    $guardian = $guardianDAO->GetById($id_guardian);
                }
                    catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];

                    $this->ShowHome_Owner($alert);
                }

                require_once(VIEWS_PATH . "ReviewedGuardian.php");
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        /**
        *	@param Array -> reserva, cupon y mascota
        */
        public function ReviewedGuardian($rating, $id_guardian)
        {
            if (isset($_SESSION['idOwner']))
            {         
                try
                {
                    $reservationController = new ReservationController();
                    $reviewController = new ReviewController();

                    $reviewController->UpdateReview($id_guardian, $rating);
                    
                    // cambiar el is_reviewd a 1 (en pets_x_reservation)

                    $alert = [
                        "type" => "success",
                        "text" => "Calificación enviada"
                    ];
                }
                    catch(Eception $ex)
                {
                    $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
                }

                $this->ShowHome_Owner($alert);
            }
            else
            {
                header("location: " . FRONT_ROOT . "Auth/ShowLogin");
            } 
        }

        public function Register_Owner($name, $last_name, $dni, $tel, $email, $password)
        {
            try
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
    
                // -> ADD OWNER
                $ownerDAO->Add($owner);
                // <- ADD OWNER
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }

        public function UpdateProfile_Owner($id, $name, $last_name, $tel, $password)
        {
            try
            {
                $ownerDAO = new OwnerDAO();
                $owner = new Owner();
    
                // -> SETs OWNER
                $owner->setName($name);
                $owner->setLast_name($last_name);
                $owner->setTelephone($tel);
                $owner->setPassword($password);
                // <- SETs OWNER
    
                // -> UPDATE OWNER
                $ownerDAO->Update($id, $owner);
                // <- UPDATE OWNER
            }
            catch(Exception $ex)
            {
                $alert = [
                        "type" => "danger",
                        "text" => $ex->getMessage()
                    ];
            }

            $this->ShowProfile_Owner();
        }

        /**
        *	@param Array -> listado de reservas
        */
        function diffReservs_and_putObjects($totalReservs)
        {
            $reservationDAO = new ReservationDAO();
            $petDAO = new PetDAO();
            $paymentCouponDAO = new PaymentCouponDAO();
            
            $dailyReservs = array();
            $pastReserv = array();

            $reserForPet = new ReservationForPet();
            $reserv = new Reservation();
            $pet = new Pet();
            $coupon = new PaymentCoupon();

            foreach($totalReservs as $reserForPet)
            {
                $reserv = $reservationDAO->GetById($reserForPet->getId_reservation());
                $pet = $petDAO->GetById($reserForPet->getId_Pet());
                $coupon = $paymentCouponDAO->GetById($reserForPet->getId_coupon());
                
                if($reserv->getLast_day() <= date('Y-m-d')) // si el ultimo dia es menor al dia actual
                {
                    $reserForPet_Objs = [
                        "reserv" => $reserv, // el obj reserva
                        "pet" => $pet->getName(),
                        "coupon" => $coupon, // el objeto cupon de pago
                        "is_reviewed" => $reserForPet->getIs_reviewed() // si ya califico (1) o no califico (0) al guardian
                    ];
                    
                    array_push($pastReserv, $reserForPet_Objs);
                }
                else if ($reserv->getIs_accepted() == 1) // else -> el ultimo dia es mayor al dia actual && si fue aceptada
                {
                    $reserForPet_Objs = [
                        "reserv" => $reserv, // el obj reserva
                        "pet" => $pet->getName(),
                        "coupon" => $coupon // el objeto cupon de pago
                    ];
                    
                    array_push($dailyReservs, $reserForPet_Objs);
                }
            }

            $diffReservs = [
                "daily" => $dailyReservs,
                "last" => $pastReserv
            ];

            return $diffReservs;
        }
    }
?>