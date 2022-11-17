<?php
    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use Models\Owner as Owner;
    
    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException;

    class OwnerDao implements I_DAO
    { 

        private $connection;
        private $tableName = "owners";

        // DATABASE CLASSES ↓

        public function Add(Owner $owner)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (first_name, last_name, dni, telephone, email, pass) VALUES (:first_name, :last_name, :dni, :telephone, :email, :pass)";

                $parameters['first_name'] = $owner->getName();
                $parameters['last_name'] = $owner->getLast_name();
                $parameters['dni'] = $owner->getDni();
                $parameters['telephone'] = $owner->getTelephone();
                $parameters['email'] = $owner->getEmail();
                $parameters['pass'] = $owner->getPassword();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            $owList = array();

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
                    $owner = $this->map($row);
                    array_push($owList, $owner);
                }
            }

            return $owList;
        }

        public function GetById($id){

            $owList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_owner = :id ";
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
                    $owner = $this->map($row);
                    array_push($owList, $owner);
                }

                return $owList[0];  
            }
            else
            {
                return null;
            }
        }

        public function GetByDni($dni)
        {
            $owList = array();

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
                    $owner = $this->map($row);
                    array_push($owList, $owner);
                }

                return $owList[0];  
            }
            else
            {
                return null;
            }
        }

        public function GetByEmail($email)
        {
            $owList = array();
            
            try 
            {
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
                    $owner = $this->map($row);
                    array_push($owList, $owner);
                }

                return $owList[0];  
            }
            else
            {
                return null;
            }
        }

        public function Update($id, Owner $owner)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE $this->tableName SET first_name=:first_name, last_name=:last_name, telephone=:telephone, pass=:pass
                            WHERE id_owner = :id";

                $parameters['first_name'] = $owner->getName();
                $parameters['last_name'] = $owner->getLast_name();
                $parameters['telephone'] = $owner->getTelephone();
                $parameters['pass'] = $owner->getPassword();
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
                $query = "DELETE FROM $this->tableName WHERE id_owner = :id ";
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
            $owner = new Owner;

            $owner->setId_owner($rta['id_owner']);
            $owner->setName($rta['first_name']);
            $owner->setLast_name($rta['last_name']);
            $owner->setDni($rta['dni']);
            $owner->setTelephone($rta['telephone']);
            $owner->setEmail($rta['email']);
            $owner->setPassword($rta['pass']);

            return $owner;
        }
        
        // DATABASE CLASSES ↑

    }
?>