<?php
    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use DAO_SQL\ReviewDAO as ReviewDAO;
    use Models\Guardian as Guardian;
    use Models\Review as Review;

    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException;

    class GuardianDao implements I_DAO
    {

        private $connection;
        private $tableName =  "guardians";

        public function Add(Guardian $guardian)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (first_name, last_name, dni, telephone, address, email, pass, id_size_care, cost)
                      VALUES (:first_name, :last_name, :dni, :telephone, :address, :email, :pass, :id_size_care, :cost)";

                $parameters['first_name'] = $guardian->getName();
                $parameters['last_name'] = $guardian->getLast_name();
                $parameters['dni'] = $guardian->getDni();
                $parameters['telephone'] = $guardian->getTelephone();
                $parameters['address'] = $guardian->getAddress();
                $parameters['email'] = $guardian->getEmail();
                $parameters['pass'] = $guardian->getPassword();
                $parameters['id_size_care'] = $guardian->getSizeCare();
                $parameters['cost'] = $guardian->getCost();

            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            $guardList = array();

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
                    $guardian = $this->map($row);
                    array_push($guardList, $guardian);
                }
            }

            return $guardList;
        }

        public function GetById($id)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id ";
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
            else
            {
                return null;
            }
        }

        public function GetByDni($dni){

            $guardList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE dni = :dni ";
                $parameters['dni'] = $dni;

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
            else
            {
                return null;
            }
        }

        public function GetByEmail($email){
            
            $guardList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE email = :email ";
                $parameters['email'] = $email;

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
                    $guardian = $this->map($row);
                    array_push($guardList, $guardian);
                }

                return $guardList[0];  
            }
            else
            {
                return null;
            }
        }

        public function GetIdSize($size)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_size FROM sizes WHERE size = :size ";
                $parameters['size'] = $size;

                $rta = $this->connection->Execute($query, $parameters);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if (!empty($rta))
            {
                return $rta[0][0];
            }
        }

        public function GetSize($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT size FROM sizes WHERE id_size = :id ";
                $parameters['id'] = $id;

                $rta = $this->connection->Execute($query, $parameters);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if (!empty($rta))
            {
                return $rta[0][0];
            }
        }

        public function Update($id, Guardian $guardian)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE $this->tableName SET first_name=:first_name, last_name=:last_name, telephone=:telephone, address=:address, pass=:pass, id_size_care=:id_size_care, cost=:cost
                            WHERE id_guardian = :id_guardian";

                $parameters['first_name'] = $guardian->getName();
                $parameters['last_name'] = $guardian->getLast_name();
                $parameters['telephone'] = $guardian->getTelephone();
                $parameters['address'] = $guardian->getAddress();
                $parameters['pass'] = $guardian->getPassword();
                $parameters['id_guardian'] = $id;
                $parameters['id_size_care'] = $guardian->getSizeCare();
                $parameters['cost'] = $guardian->getCost();

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
                $query = "DELETE FROM $this->tableName WHERE id_guardian = :$id ";
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
            $guardian = new Guardian;

            $guardian->setId_guardian($rta['id_guardian']);
            $guardian->setName($rta['first_name']);
            $guardian->setLast_name($rta['last_name']);
            $guardian->setDni($rta['dni']);
            $guardian->setTelephone($rta['telephone']);
            $guardian->setAddress($rta['address']);
            $guardian->setEmail($rta['email']);
            $guardian->setPassword($rta['pass']);
            $guardian->setSizeCare($this->GetSize($rta['id_size_care']));
            $guardian->setCost($rta['cost']);
            
            return $guardian;
        }
    }
?>