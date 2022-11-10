<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use DAO\GuardianDAO as GuardianDAO;
    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\Reservation as Reservation;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException;

    class ReservationDAO implements I_DAO
    {
        private $connection;

        // DATABASE CLASSES ↓

        public function AddReservation(Reservation $reserv)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO reservation (id_guardian, pet_size, pet_breed, is_accepted, first_day, last_day, total_days)
                      VALUES (:id_guardian, :pet_size, :pet_breed, :is_accepted, :first_day, :last_day, :total_days)";

                $parameters['id_guardian'] = $reserv->getId_guardian();
                $parameters['pet_size'] = $reserv->getPet_size();
                $parameters['pet_breed'] = $reserv->getPet_breed();
                $parameters['is_accepted'] = 0;
                $parameters['first_day'] = $reserv->getFirst_day();
                $parameters['last_day'] = $reserv->getLast_day();
                $parameters['total_days'] = $reserv->getTotal_days();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function AddPet_ToReservation($id_reserv, $id_payment, $pet) // en controller se crea el cupon
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO pets_x_reservation (id_reservation, id_pet, id_payment_coupon)
                      VALUES (:id_reservation, :id_pet, :id_payment_coupon)";

                $parameters['id_reservation'] = $id_reserv;
                $parameters['id_pet'] = $pet->getId_pet();
                $parameters['id_payment_coupon'] = $id_payment;

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM reservation";
                $rta = $this->connection->Execute($query);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $reserv = $this->map($row);
                    array_push($reservList, $reserv);
                }
            }

            return $reservList;
        }

        public function GetById($id){
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM reservation WHERE id_guardian = '$id' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $reserv = $this->map($row);
                    array_push($reservList, $reserv);
                }
            }

            return $reservList;
        }

        public function GetIdByDates($first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_reservation FROM reservation WHERE first_day <= '$first_day' AND last_day >= '$last_day' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            return $rta[0][0];
        }

        public function GetByGuardian($id_guardian)
        {
            $reservList = array();
            
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM reservation WHERE id_guardian = '$id_guardian' ";
                $rta = $this->connection->Execute($query);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $reserv = $this->map($row);
                    array_push($reservList, $reserv);
                }
            }

            return $reservList;
        }
        
        public function GetByGuardian_ToAccepted($id_guardian)
        {
            $reservList = array();
            
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM reservation WHERE id_guardian = '$id_guardian' AND is_accepted = 0";
                $rta = $this->connection->Execute($query);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $reserv = $this->map($row);
                    array_push($reservList, $reserv);
                }
            }

            return $reservList;
        }

        public function IsExist_Reserv($first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM reservation WHERE first_day <= '$first_day' AND last_day >= '$last_day' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return true; // EXISTE 
            }
            else
            {
                return false; // NO EXISTE
            }
        }

        public function ChangeToAccepted($id)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE reservation SET is_accepted = '1'
                            WHERE id_reservation = '$id'";


                $this->connection->ExecuteNonQuery($query);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetSize_Condition($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT pet_size FROM reservation WHERE id_reservation = '$id' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $rta[0][0];
            }
        }

        public function GetBreed_Condition($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT pet_breed FROM reservation WHERE id_reservation = '$id' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $rta[0][0];
            }
        }
        
        public function Update($id, Reservation $reserv)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE reservation SET pet_size:pet_size, pet_breed:pet_breed, is_accepted:is_accepted, first_day:first_day, last_day:last_day, total_days:total_days
                            WHERE id_reservation = '$id'";

                $parameters['pet_size'] = $reserv->getPet_size();
                $parameters['pet_breed'] = $reserv->getPet_breed();
                $parameters['is_accepted'] = $reserv->getIs_accepted();
                $parameters['first_day'] = $reserv->getFirs_day();
                $parameters['last_day'] = $reserv->getLast_day();
                $parameters['total_days'] = $reserv->getTotal_days();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function Remove($id)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM reservation WHERE id_reservation = '$id' ";
                $rta = $this->connection->ExecuteNonQuery($query);
                
                return $rta;
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
        }

        /**
        *	@param Array -> listado que se transforma en objeto
        */

        protected function map ($p)
        {
            $reserv = new Reservation();

            $reserv->setId_reservation($p['id_reservation']);
            $reserv->setId_guardian($p['id_guardian']);
            $reserv->setPet_size($p['pet_size']);
            $reserv->setPet_breed($p['pet_breed']);
            $reserv->setIs_accepted($p['is_accepted']);
            $reserv->setFirst_day($p['first_day']);
            $reserv->setLast_day($p['last_day']);
            $reserv->setTotal_days($p['total_days']);
            
            return $reserv;
        }
        
        // DATABASE CLASSES ↑
    
    }
?>