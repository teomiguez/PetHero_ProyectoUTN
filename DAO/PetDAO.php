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
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetByOwner($id)
        {
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
                return $this->map($rta);
            }
            else
            {
                return false;
            }
        }

        public function GetById($id){
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
                return $this->map($rta);
            }
            else
            {
                return false;
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
         *  Transofmra un listado (array) de X cosas
         *  en objetos de X cosa
         * 
         *  @param Array listado de X cosas a transformar en objetos
        */

        protected function map ($values)
        {
            $values = is_array($values) ? $values : [];

            $rta = array_map(function($p){

                $pet = new Pet();

                $pet->setId_pet($p['id_pet']);
                $pet->setId_owner($p['id_owner']);
                $pet->setImg($p['img']);
                $pet->setName($p['name']);
                $pet->setType($this->GetType($p['id_type'])); // ver esto
                $pet->setBreed($p['breed']);
                $pet->setSize($this->GetSize($p['id_size'])); // ver esto
                $pet->setPlanVacunacion($p['plan_vacunacion']);
                $pet->setVideo($p['video']);
                $pet->setInfo($p['info']);
                
                return $pet;

            }, $values);

            return count($rta) > 1 ? $rta : $rta['0'];
        }
    }
?>