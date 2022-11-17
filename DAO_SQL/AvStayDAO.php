<?php

    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use Models\AvStay as AvStay;

    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException; 

    class AvStayDAO implements I_DAO
    {

        private $connection;
        private $tableName = "avstay";

        public function Add(AvStay $avstay)
        {
            try {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (id_guardian, first_day, last_day) VALUES (:id_guardian, :first_day, :last_day)";

                $parameters['id_guardian'] = $avstay->getId_keeper();
                $parameters['first_day'] = $avstay->getFirst_day();
                $parameters['last_day'] = $avstay->getLast_day();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            $avstayList = array();

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
                    $avstay = $this->map($row);
                    array_push($avstayList, $avstay);
                }
            }

            return $avstayList;
        }

        public function GetByKeeper($id_guardian)
        {    
            $avstayList = array();
            
            try {
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
                    $avstay = $this->map($row);
                    array_push($avstayList, $avstay);
                }
            }

            return $avstayList;
        }

        public function GetById($id)
        {   
            $avstayList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_stay = :id ";
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
                    $avstay = $this->map($row);
                    array_push($avstayList, $avstay);
                }

                return $avstayList[0];  
            }
            else
            {
                return null;
            }
        }

        public function IsExist_Stay($id_guardian, $first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id_guardian AND first_day <= :first_day AND last_day >= :last_day ";
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

        public function ThisGuardianIsAviable($id, $first_day, $last_day)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id AND first_day <= :first_day AND last_day >= :last_day ";
                $parameters['id'] = $id;
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

        public function GetIdGuardian_ByDates($first_day, $last_day)
        {
            $avstayList = array();
            
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_guardian FROM $this->tableName WHERE first_day <= :first_day AND last_day >= :last_day ";
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
                foreach ($rta as $row) 
                {
                    $avstay = $row[0];
                    array_push($avstayList, $avstay);
                }
            }

            return $avstayList;
        }

        public function Update($id, AvStay $avstay)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE $this->tableName SET id_guardian=:id_guardian, first_day=:first_day, last_day=:last_day                
                            WHERE id_stay = :id";

                $parameters['id_guardian'] = $avstay->getId_keeper();
                $parameters['first_day'] = $avstay->getFirst_day();
                $parameters['last_day'] = $avstay->getLast_day();
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
            try {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM $this->tableName WHERE id_stay = :id ";
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

        protected function map ($rta) 
        {
            $avstay = new AvStay();

            $avstay->setId_stay($rta['id_stay']);
            $avstay->setId_keeper($rta['id_guardian']);
            $avstay->setFirst_day($rta['first_day']);
            $avstay->setLast_day($rta['last_day']);

            return $avstay;
        }
    }

?>