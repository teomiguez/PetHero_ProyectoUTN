<?php

    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\AvStay as AvStay;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException; 

    class AvStayDAO implements I_DAO
    {
        private $stayList = array();
        private $fileName = ROOT . "Data/AviableStays.json";

        private $connection;

        // DATABASE CLASSES ↓

        public function Add(AvStay $avstay)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO avstay (id_guardian, fist_day, last_day) VALUES (:id_guardian, :fist_day, :last_day)";

                $parameters['id_guardian'] = $avstay->getId_keeper();
                $parameters['fist_day'] = $avstay->getFirst_day();
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
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM avstay";
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

        public function GetByKeeper($id_guardian){
            
            $avstayList = array();
            
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM avstay WHERE id_guardian = '$id_guardian' ";
                $rta = $this->connection->Execute($query);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
 
            if(!empty($rta))
            {
                $avstayList = $this->map($rta);
            }

            return $avstayList;

        }

        public function GetById($id){
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM avstay WHERE id_stay = '$id' ";
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

        public function GetIdGuardian_ByDates($first_day, $last_day){
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT id_guardian FROM avstay WHERE fist_day <= '$first_day' AND last_day >= '$last_day' ";
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

        public function Update($id, AvStay $avstay)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE avstay SET id_guardian=:id_guardian, fist_day=:fist_day, last_day=:last_day                
                            WHERE id_stay = '$id'";

                $parameters['id_guardian'] = $avstay->getId_keeper();
                $parameters['fist_day'] = $avstay->getFirst_day();
                $parameters['last_day'] = $avstay->getLast_day();

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
                $query = "DELETE FROM avstay WHERE id_stay = '$id' ";
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

                $avstay = new AvStay;

                $avstay->setId_stay($p['id_stay']);
                $avstay->setId_keeper($p['id_guardian']);
                $avstay->setFirst_day($p['fist_day']);
                $avstay->setLast_day($p['last_day']);

                return $avstay;

            }, $values);

            return count($rta) > 1 ? $rta : $rta['0'];
        }

        // DATABASE CLASSES ↑


        // JSON CLASSES ↓

        // function Add(AvStay $stay)
        // {
        //     $this->RetrieveData();

        //     $stay->setId_stay($this->GetNextId());

        //     array_push($this->stayList, $stay);

        //     $this->SaveData();
        // }
        
        // function GetAll()
        // {
        //     $this->RetrieveData();

        //     return $this->stayList;
        // }
        
        // function GetByKeeper($id_keeper)
        // {
        //     $this->RetrieveData();
            
        //     $AvStays = array_filter($this->stayList, function ($stay) use ($id_keeper) 
        //     {
        //         return $stay->getId_keeper() == $id_keeper;
        //     });

        //     return $AvStays;
        // }

        // function GetById($id)
        // {
        //     $this->RetrieveData();

        //     $AvStays = array_filter($this->stayList, function($stay) use ($id) {
        //         return $stay->getId_stay() == $id;
        //     });

        //     $AvStays = array_values($AvStays); //Reorderding array

        //     return (count($AvStays) > 0) ? $AvStays[0] : null;
        // }

        // function GetIdGuardian_ByDates($first_day, $last_day)
        // {
        //     $this->RetrieveData();

        //     $AvStays = array_filter($this->stayList, function($stay) use ($first_day, $last_day)
        //     {
        //         if (($stay->getFirst_day() <= $first_day) && ($stay->getLast_day() >= $last_day))
        //         {
        //             return $stay->getId_keeper();
        //         }    
        //     });
            
        //     $AvStays = array_values($AvStays); //Reorderding array

        //     return (count($AvStays) > 0) ? $AvStays[0] : null;
        // }

        // //function Update($id); -> (ver)
        
        // function Remove($id)
        // {
        //     $this->RetrieveData();

        //     $this->stayList = array_filter($this->stayList, function($stay) use($id){
        //         return $stay->getId_stay() != $id;
        //     });

        //     $this->SaveData();
        // }

        // private function RetrieveData()
        // {
        //      $this->stayList = array();

        //      if(file_exists($this->fileName))
        //      {
        //          $jsonToDecode = file_get_contents($this->fileName);

        //          $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
        //          foreach($contentArray as $content)
        //          {
        //              $stay = new AvStay();
        //              $stay->setId_stay($content["id_stay"]);
        //              $stay->setId_keeper($content["id_keeper"]);
        //              $stay->setFirst_day($content["first_day"]);
        //              $stay->setLast_day($content["last_day"]);

        //              array_push($this->stayList, $stay);
        //          }
        //      }
        // }

        // private function SaveData()
        // {
        //     $arrayToEncode = array();

        //     foreach($this->stayList as $stay)
        //     {
        //         $valuesArray = array();
        //         $valuesArray["id_stay"] = $stay->getId_stay();
        //         $valuesArray["id_keeper"] = $stay->getId_keeper();
        //         $valuesArray["first_day"] = $stay->getFirst_day();
        //         $valuesArray["last_day"] = $stay->getLast_day();

        //         array_push($arrayToEncode, $valuesArray);
        //     }

        //     $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        //     file_put_contents($this->fileName, $fileContent);
        // }

        // private function GetNextId()
        // {
        //     $id = 0;

        //     foreach($this->stayList as $stay)
        //     {
        //         $id = ($stay->getId_stay() > $id) ? $stay->getId_stay() : $id;
        //     }

        //     return $id + 1;
        // }

          // JSON CLASSES ↑
    }

?>