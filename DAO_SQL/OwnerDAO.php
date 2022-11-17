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
        private $ownerList = array();
        private $fileName = ROOT . "Data/Owners.json";

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

        // JSON CLASSES ↓
        
        // function Add(Owner $owner)
        // {
        //     $this->RetrieveData();

        //     $owner->setId_owner($this->GetNextId());

        //     array_push($this->ownerList, $owner);

        //     $this->SaveData();
        // }

        // function GetAll()
        // {
        //     $this->RetrieveData();

        //     return $this->ownerList;
        // }

        // function GetById($id)
        // {
        //     $this->RetrieveData();

        //     $Owners = array_filter($this->ownerList, function($owner) use($id){
        //         return $owner->getId_owner() == $id;
        //     });

        //     $Owners = array_values($Owners); //Reorderding array

        //     return (count($Owners) > 0) ? $Owners[0] : null;
        // }

        // function GetByEmail($email)
        // {
        //     $this->RetrieveData();

        //     $Owners = array_filter($this->ownerList, function($owner) use($email){
        //         return $owner->getEmail() == $email;
        //     });

        //     $Owners = array_values($Owners); //Reorderding array

        //     return (count($Owners) > 0) ? $Owners[0] : null;
        // }

        // function GetByDni($dni)
        // {
        //     $this->RetrieveData();

        //     $Owners = array_filter($this->ownerList, function($owner) use($dni){
        //         return $owner->getDni() == $dni;
        //     });

        //     $Owners = array_values($Owners); //Reorderding array

        //     return (count($Owners) > 0) ? $Owners[0] : null;
        // }
    
        // function Remove($id)
        // {
        //     $this->RetrieveData();

        //     $this->ownerList = array_filter($this->ownerList, function($owner) use($id){
        //         return $ownerList->getId_owner() != $id;
        //     });

        //     $this->SaveData();
        // }

        // private function RetrieveData()
        // {
        //      $this->ownerList = array();

        //      if(file_exists($this->fileName))
        //      {
        //         $jsonToDecode = file_get_contents($this->fileName);

        //         $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
        //         foreach($contentArray as $content)
        //         {
        //            $owner = new Owner();
        //            $owner->setId_owner($content["id"]);
        //            $owner->setName($content["name"]);
        //            $owner->setLast_name($content["last_name"]);
        //            $owner->setDni($content["dni"]);
        //            $owner->setTelephone($content["telephone"]);
        //            $owner->setEmail($content["email"]);
        //            $owner->setPassword($content["password"]);

        //            array_push($this->ownerList, $owner);
        //         }
        //     }
        // }
 
        // private function SaveData()
        // {
        //     $arrayToEncode = array();

        //     foreach($this->ownerList as $owner)
        //     {
        //         $valuesArray = array();
        //         $valuesArray["id"] = $owner->getId_owner();
        //         $valuesArray["name"] = $owner->getName();
        //         $valuesArray["last_name"] = $owner->getLast_name();
        //         $valuesArray["dni"] = $owner->getDni();
        //         $valuesArray["telephone"] = $owner->getTelephone();
        //         $valuesArray["email"] = $owner->getEmail();
        //         $valuesArray["password"] = $owner->getPassword();
                
        //         array_push($arrayToEncode, $valuesArray);
        //     }

        //     $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        //     file_put_contents($this->fileName, $fileContent);
        // }

        // private function GetNextId()
        // {
        //     $id = 0;

        //     foreach($this->ownerList as $owner)
        //     {
        //         $id = ($owner->getId_owner() > $id) ? $owner->getId_owner() : $id;
        //     }

        //     return $id + 1;
        // }

        // JSON CLASSES ↑

    }
?>