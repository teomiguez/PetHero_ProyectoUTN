<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use DAO\ReviewDAO as ReviewDAO;
    use Models\Guardian as Guardian;
    use Models\Review as Review;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException;

    class GuardianDao implements I_DAO
    {
        private $guardianList = array();
        private $fileName = ROOT . "Data/Guardianes.json";

        private $connection;
        private $tableName =  "guardians";

        // DATABASE CLASSES ↓

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

        public function GetById($id){

            $guardList = array();

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

        // DATABASE CLASSES ↑

        // JSON CLASSES ↓

        // function Add(Guardian $guardian)
        // {
        //     $this->RetrieveData();

        //     array_push($this->guardianList, $guardian);

        //     $this->SaveData();
        // }

        // function GetAll()
        // {
        //     $this->RetrieveData();

        //     return $this->guardianList;
        // }

        // function GetById($id)
        // {
        //     $this->RetrieveData();

        //     $Guardianes = array_filter($this->guardianList, function($guardian) use ($id) {
        //         return $guardian->getId_guardian() == $id;
        //     });

        //     $Guardianes = array_values($Guardianes); //Reorderding array

        //     return (count($Guardianes) > 0) ? $Guardianes[0] : null;
        // }

        // function GetByEmail($email)
        // {
        //     $this->RetrieveData();

        //     $Guardianes = array_filter($this->guardianList, function($guardian) use ($email) {
        //         return $guardian->getEmail() == $email;
        //     });

        //     $Guardianes = array_values($Guardianes); //Reorderding array

        //     return (count($Guardianes) > 0) ? $Guardianes[0] : null;
        // }

        // function GetByDni($dni)
        // {
        //     $this->RetrieveData();

        //     $Guardianes = array_filter($this->guardianList, function($guardian) use ($dni) {
        //         return $guardian->getDni() == $dni;
        //     });

        //     $Guardianes = array_values($Guardianes); //Reorderding array

        //     return (count($Guardianes) > 0) ? $Guardianes[0] : null;
        // }
    
        // function Remove($id)
        // {
        //     $this->RetrieveData();

        //     $this->guardianList = array_filter($this->guardianList, function($guardian) use($id){
        //         return $guardian->getId_guardian() != $id;
        //     });

        //     $this->SaveData();
        // }

        // function GetNextId_guardian()
        // {
        //     $id = 0;

        //     $this->RetrieveData();

        //     foreach($this->guardianList as $guardian)
        //     {
        //         $id = ($guardian->getId_guardian() > $id) ? $guardian->getId_guardian() : $id;
        //     }

        //     return $id + 1;
        // }

        // private function RetrieveData()
        // {
        //      $this->guardianList = array();

        //      if(file_exists($this->fileName))
        //      {
        //          $jsonToDecode = file_get_contents($this->fileName);

        //          $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
        //          foreach($contentArray as $content)
        //          {
        //              $guardian = new Guardian();
        //              $guardian->setId_guardian($content["id_guardian"]);
        //              $guardian->setName($content["name"]);
        //              $guardian->setLast_name($content["last_name"]);
        //              $guardian->setDni($content["dni"]);
        //              $guardian->setTelephone($content["telephone"]);
        //              $guardian->setAddress($content["address"]);
        //              $guardian->setEmail($content["email"]);
        //              $guardian->setPassword($content["password"]);
        //              $guardian->setSizeCare($content["sizeCare"]);
        //              $guardian->setCost($content["cost"]);
        //              $guardian->setId_review($content["id_review"]);
        //              array_push($this->guardianList, $guardian);
        //          }
        //      }
        // }

        // private function SaveData()
        // {
        //     $arrayToEncode = array();

        //     foreach($this->guardianList as $guardian)
        //     {
        //         $valuesArray = array();
        //         $valuesArray["id_guardian"] = $guardian->getId_guardian();
        //         $valuesArray["name"] = $guardian->getName();
        //         $valuesArray["last_name"] = $guardian->getLast_name();
        //         $valuesArray["dni"] = $guardian->getDni();
        //         $valuesArray["telephone"] = $guardian->getTelephone();
        //         $valuesArray["address"] = $guardian->getAddress();
        //         $valuesArray["email"] = $guardian->getEmail();
        //         $valuesArray["password"] = $guardian->getPassword();
        //         $valuesArray["sizeCare"] = $guardian->getSizeCare();
        //         $valuesArray["cost"] = $guardian->getCost();
        //         $valuesArray["id_review"] = $guardian->getId_review();
        //         array_push($arrayToEncode, $valuesArray);
        //     }

        //     $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        //     file_put_contents($this->fileName, $fileContent);
        // }

        // JSON CLASSES ↑

    }
?>