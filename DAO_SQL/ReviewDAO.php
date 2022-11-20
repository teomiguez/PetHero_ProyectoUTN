<?php

    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use Models\Review as Review;

    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException;

    class ReviewDAO implements I_DAO
    {

        private $connection;
        private $tableName = "review";

        public function Add(Review $review)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (id_guardian, quantity_reviews, sum_reviews, review) VALUES (:id_guardian, :quantity_reviews, :sum_reviews, :review)";

                $parameters['id_guardian'] = $review->getId_guardian();
                $parameters['quantity_reviews'] = $review->getQuantity_reviews();
                $parameters['sum_reviews'] = $review->getSum_reviews();
                $parameters['review'] = $review->getReview();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            $revList = array();

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
                    $review = $this->map($row);
                    array_push($revList, $review);
                }
            }

            return $revList;
        }

        public function GetById($id){
            
            $revList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_review = :id ";
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
                    $review = $this->map($row);
                    array_push($revList, $review);
                }

                return $revList[0];  
            }
            else
            {
                return null;
            }
        }

        public function GetByIdGuardian($id) {
            
            $revList = array();

            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_guardian = :id";
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
                    $review = $this->map($row);
                    array_push($revList, $review);
                }

                return $revList[0];  
            }
            else
            {
                return null;
            }
        }

        public function Update($id_review, Review $review)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE $this->tableName SET quantity_reviews=:quantity_reviews, sum_reviews=:sum_reviews, review=:review
                            WHERE id_review = :id_review";

                $parameters['quantity_reviews'] = $review->getQuantity_reviews();
                $parameters['sum_reviews'] = $review->getSum_reviews();
                $parameters['review'] = $review->getReview();
                $parameters['id_review'] = $id_review;

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
                $query = "DELETE FROM $this->tableName WHERE id_review = :id";
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
            $review = new Review;

            $review->setId_review($rta['id_review']);
            $review->setId_guardian($rta['id_guardian']);
            $review->setQuantity_reviews($rta['quantity_reviews']);
            $review->setSum_reviews($rta['sum_reviews']);
            $review->setReview($rta['review']);

            return $review;
        }
    }

?>