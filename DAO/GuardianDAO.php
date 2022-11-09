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

        // DATABASE CLASSES ↓

        public function Add(Guardian $guardian)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO guardians (first_name, last_name, dni, telephone, address, email, pass, id_size_care, cost)
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
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM guardians";
                $rta = $this->connection->Execute($query);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetById($id){
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM guardians WHERE id_guardian = '$id' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetByDni($dni)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM guardians WHERE dni = '$dni' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetByEmail($email)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM guardians WHERE email = '$email' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetIdSize($size)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_size FROM sizes WHERE size = '$size' ";
                $rta = $this->connection->Execute($query);
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
                $query = "SELECT size FROM sizes WHERE id_size = '$id' ";
                $rta = $this->connection->Execute($query);
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

                $query = "UPDATE guardians SET first_name=:first_name, last_name=:last_name, telephone=:telephone, address=:address, pass=:pass, id_size_care=:id_size_care, cost=:cost
                            WHERE id_guardian = '$id'";

                $parameters['first_name'] = $guardian->getName();
                $parameters['last_name'] = $guardian->getLast_name();
                $parameters['dni'] = $guardian->getDni();
                $parameters['telephone'] = $guardian->getTelephone();
                $parameters['address'] = $guardian->getAddress();
                $parameters['email'] = $guardian->getEmail();
                $parameters['pass'] = $guardian->getPassword();

                if (($guardian->getSizeCare() != 1) || ($guardian->getSizeCare() != 2) || ($guardian->getSizeCare() != 3))
                {
                    $parameters['id_size_care'] = $this->GetIdSize($guardian->getSizeCare());
                }
                else
                {
                    $parameters['id_size_care'] = $guardian->getSizeCare();
                }

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
                $query = "DELETE FROM guardians WHERE id_guardian = '$id' ";
                $rta = $this->connection->ExecuteNonQuery($query);
                
                return $rta;
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
        }

        /**
         *  Transofmra un listado (array) de X cosas
         *  en objetos de X cosa
         * 
         *  @param Array listado de X cosas a transformar en objetos
        */

        protected function map ($values)
        {
            $values = is_array($values) ? $values : [];

            $rta = array_map(function($p){

                $guardian = new Guardian;

                $guardian->setId_guardian($p['id_guardian']);
                $guardian->setName($p['first_name']);
                $guardian->setLast_name($p['last_name']);
                $guardian->setDni($p['dni']);
                $guardian->setTelephone($p['telephone']);
                $guardian->setAddress($p['address']);
                $guardian->setEmail($p['email']);
                $guardian->setPassword($p['pass']);
                $guardian->setSizeCare($this->GetSize($p['id_size_care']));
                $guardian->setCost($p['cost']);
                
                return $guardian;

            }, $values);

            return count($rta) > 1 ? $rta : $rta['0'];
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