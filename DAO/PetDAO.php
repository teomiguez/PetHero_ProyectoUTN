<?php
    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\Pet as Pet;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException;

    class PetDAO implements I_DAO
    {
        private $connection;
        
        public function Add(Pet $pet)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO pets (id_owner, img, name, id_type, breed, id_size, plan_vacunacion, video, info)
                      VALUES (:id_owner, :img, :name, :id_type, :breed, :id_size, :plan_vacunacion, :video, :info)";

                $parameters['id_owner'] = $pet->getId_owner();
                $parameters['img'] = $pet->getImg();
                $parameters['name'] = $pet->getName();
                $parameters['id_type'] = $pet->getType();
                $parameters['breed'] = $pet->getBreed();
                $parameters['id_size'] = $pet->getSize();
                $parameters['plan_vacunacion'] = $pet->getPlanVacunacion();
                $parameters['video'] = $pet->getVideo();
                $parameters['info'] = $pet->getInfo();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            $petList = array();

            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets";
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
                    $pet = $this->map($row);
                    array_push($petList, $pet);
                }
            }

            return $petList;
        }

        public function GetByOwner($id)
        {
            $petList = array();
            
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets p WHERE p.id_owner = '$id' ";
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
                    $pet = $this->map($row);
                    array_push($petList, $pet);
                }
            }

            return $petList;

        }

        public function GetById($id){
           
            $petList = array();

            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets WHERE id_pet = '$id' ";
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
                    $pet = $this->map($row);
                    array_push($petList, $pet);
                }

                return $petList[0];
            }
            else
            {
                return null;
            }

        }

        public function Update($id, Pet $pet)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE pets SET img:img, name:name, type:type, breed:breed, size:size, planVacunacion:planVacunacion, video:video, info:info
                            WHERE id_pet = '$id'";

                $parameters['img'] = $pet->getImg();
                $parameters['name'] = $pet->getName();
                $parameters['id_type'] = $pet->getType();
                $parameters['breed'] = $pet->getBreed();
                $parameters['id_size'] = $pet->getSize();
                $parameters['plan_vacunacion'] = $pet->getPlanVacunacion();
                $parameters['video'] = $pet->getVideo();
                $parameters['info'] = $pet->getInfo();

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
                $query = "DELETE FROM pets WHERE id_pet = '$id' ";
                $rta = $this->connection->ExecuteNonQuery($query);
                
                return $rta;
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
        }

        public function GetType($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT type FROM types WHERE id_type = '$id' ";
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


         /**
        *	@param Array -> listado que se transforma en objeto
        */

        protected function map ($rta)
        {
            $pet = new Pet();

            $pet->setId_pet($rta['id_pet']);
            $pet->setId_owner($rta['id_owner']);
            $pet->setImg($rta['img']);
            $pet->setName($rta['name']);
            $pet->setType($this->GetType($rta['id_type'])); // ver esto
            $pet->setBreed($rta['breed']);
            $pet->setSize($this->GetSize($rta['id_size'])); // ver esto
            $pet->setPlanVacunacion($rta['plan_vacunacion']);
            $pet->setVideo($rta['video']);
            $pet->setInfo($rta['info']);
            
            return $pet;

            // funcion anterior ->  codigo original que transforma un arraglo de arreglos, en un arreglo de objetos

            // $values = is_array($values) ? $values : [];

            // $rta = array_map(function($p){
                // aca iba todos los set
            // }, $values);

            // return count($rta) > 1 ? $rta : $rta['0'];
        }
    }
?>