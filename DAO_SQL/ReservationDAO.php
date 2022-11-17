<?php
    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use DAO_SQL\GuardianDAO as GuardianDAO;
    
    use Models\Guardian as Guardian;
    use Models\Pet as Pet;
    use Models\Reservation as Reservation;
    use Models\ReservationForPet as ReservationForPet;
    
    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException;

    class ReservationDAO implements I_DAO
    {
        private $connection;
        private $tableName = "reservation";

        public function AddReservation(Reservation $reserv)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (id_guardian, pet_size, pet_breed, first_day, last_day, total_days)
                      VALUES (:id_guardian, :pet_size, :pet_breed, :first_day, :last_day, :total_days)";

                $parameters['id_guardian'] = $reserv->getId_guardian();
                $parameters['pet_size'] = $reserv->getPet_size();
                $parameters['pet_breed'] = $reserv->getPet_breed();
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

        public function AddPet_ToReservation($id_reserv, $id_pet, $id_owner, $id_payment) // en controller se crea el cupon
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO pets_x_reservation (id_reservation, id_pet, id_owner, id_payment_coupon)
                      VALUES (:id_reservation, :id_pet, :id_owner, :id_payment_coupon)";

                $parameters['id_reservation'] = $id_reserv;
                $parameters['id_pet'] = $id_pet;
                $parameters['id_owner'] = $id_owner;
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
            $reservList = array();
            
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName";
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

        public function GetById($id)
        {
            $reservList = array();
            
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_reservation = :id ";
                $parameters['id'] = $id;

                $rta = $this->connection->Execute($query, $parameters);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    return $this->map($row);
                }
            }
        }

        public function GetIdByDates($id_guardian, $first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_reservation FROM $this->tableName WHERE id_guardian = :id_guardian AND first_day <= :first_day AND last_day => :last_day ";
                $parameters['id_guardian'] = $id_guardian;
                $parameters['first_day'] = $first_day;
                $parameters['last_day'] = $last_day;

                $rta = $this->connection->Execute($query, $parameters);
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
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id_guardian ";
                $parameters['id_guardian'] = $id_guardian;
                
                $rta = $this->connection->Execute($query, $parameters);
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

        public function GetByOwner($id_owner) // esta se va a usar para listar las reservas que tiene pendientes el dueño
        {
            $reservList = array();
            
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets_x_reservation WHERE id_owner = :id_owner";
                $parameters['id_owner'] = $id_owner;

                $rta = $this->connection->Execute($query, $parameters);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $reserv = $this->map_petXreserv($row);
                    array_push($reservList, $reserv);
                }
            }

            return $reservList;
        }

        public function IsExist_Reserv($id_guardian, $first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id_guardian AND first_day <= :first_day AND last_day >= :last_day";
                $parameters['id_guardian'] = $id_guardian;
                $parameters['first_day'] = $first_day;
                $parameters['last_day'] = $last_day;

                $rta = $this->connection->Execute($query, $parameters);
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

                $query = "UPDATE $this->tableName SET is_accepted = :is_accepted
                            WHERE id_reservation = :id";
                $parameters['is_accepted'] = 1;
                $parameters['id'] = $id;

                $this->connection->ExecuteNonQuery($query, $parameters);
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
                $query = "SELECT pet_size FROM $this->tableName WHERE id_reservation = :id ";
                $parameters['id'] = $id;

                $rta = $this->connection->Execute($query, $parameters);
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
                $query = "SELECT pet_breed FROM $this->tableName WHERE id_reservation = :id ";
                $parameters['id'] = $id;

                $rta = $this->connection->Execute($query, $parameters);
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

                $query = "UPDATE $this->tableName SET pet_size:pet_size, pet_breed:pet_breed, is_accepted:is_accepted, first_day:first_day, last_day:last_day, total_days:total_days
                            WHERE id_reservation = :id";

                $parameters['pet_size'] = $reserv->getPet_size();
                $parameters['pet_breed'] = $reserv->getPet_breed();
                $parameters['is_accepted'] = $reserv->getIs_accepted();
                $parameters['first_day'] = $reserv->getFirs_day();
                $parameters['last_day'] = $reserv->getLast_day();
                $parameters['total_days'] = $reserv->getTotal_days();
                $parameters['id'] = $id;

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function Remove($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM $this->tableName WHERE id_reservation = :id";
                $parameters['id'] = $id;

                $rta = $this->connection->ExecuteNonQuery($query, $parameters);
                
                return $rta;
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
        }

        public function RemovePets($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM pets_x_reservation WHERE id_reservation = :id";
                $parameters['id'] = $id;

                $rta = $this->connection->ExecuteNonQuery($query, $parameters);
                
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

        /**
        *	@param Array -> listado que se transforma en objeto
        */
        protected function map_petXreserv ($p)
        {
            $reservForPet = new ReservationForPet();

            $reservForPet->setId_reservation($p['id_reservation']);
            $reservForPet->setId_owner($p['id_owner']);
            $reservForPet->setId_pet($p['id_pet']);
            $reservForPet->setId_coupon($p['id_payment_coupon']);

            return $reservForPet;
        }
    }
?>