<?php

    namespace DAO;

    use DAO\I_DAO as I_DAO;
    use Models\Review as Review;
    // use to bdd
    use DAO\Connection as Connection;
    use Exception;
    use PDOException;

    class ReviewDAO implements I_DAO
    {
        private $reviewList = array();
        private $fileName = ROOT . "Data/Reviews.json";

        private $connection;

        // DATABASE CLASSES ↓

        public function Add(Review $review)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO review (id_guardian, quantity_reviews, sum_reviews, review) VALUES (:id_guardian, :quantity_reviews, :sum_reviews, :review)";

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
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM review";
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
                $query = "SELECT * FROM review WHERE id_review = '$id' ";
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

        public function GetByIdGuardian($id)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM review WHERE id_guardian = '$id' ";
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

        public function Update($id, Review $review)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE review SET quantity_reviews:quantity_reviews, sum_reviews:sum_reviews, review:review
                            WHERE id_review = '$id'";

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

        public function Remove($id)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM review WHERE id_review = '$id' ";
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

                $review = new Review;

                $review->setId_review($p['id_review']);
                $review->setId_guardian($p['id_guardian']);
                $review->setQuantity_reviews($p['quantity_reviews']);
                $review->setSum_reviewsi($p['sum_reviews']);
                $review->setReview($p['review']);

                return $review;

            }, $values);

            return count($rta) > 1 ? $rta : $rta['0'];
        }
        
        // DATABASE CLASSES ↑

        // JSON CLASSES ↓

        // function Add(Review $review)
        // {
        //     $this->RetrieveData();

        //     array_push($this->reviewList, $review);

        //     $this->SaveData();
        // }
        
        // function GetAll()
        // {
        //     $this->RetrieveData();

        //     return $this->reviewList;
        // }
        
        // function GetByGuardian($id_guardian)
        // {
        //     $this->RetrieveData();
            
        //     $Reviews = array_filter($this->reviewList, function ($review) use ($id_guardian) 
        //     {
        //         return $review->getId_guardian() == $id_guardian;
        //     });

        //     return $Reviews;
        // }

        // function GetById($id)
        // {
        //     $this->RetrieveData();

        //     $Reviews = array_filter($this->reviewList, function($review) use ($id) {
        //         return $review->getId_review() == $id;
        //     });

        //     $Reviews = array_values($Reviews); //Reorderding array

        //     return (count($Reviews) > 0) ? $Reviews[0] : null;
        // }

        // function UpdateReview($id, $review)
        // {
        //     $newReview = $this->GetById($id);
        //     $this->Remove($id);

        //     $previousQuantity = $newReview->getQuantity_reviews();
        //     $previousSum = $newReview->getSum_reviews();
        //     $previousReview = $newReview->getReview();

        //     $newTotalReview = ($previousSum + $review) / ($previousQuantity + 1);

        //     $newReview->setQuantity_reviews($previousQuantity + 1);
        //     $newReview->setSum_reviews($previousSum + $review);
        //     $newReview->setReview($newTotalReview);

        //     $this->Add($newReview);
        // }
        
        // function Remove($id)
        // {
        //     $this->RetrieveData();

        //     $this->reviewList = array_filter($this->reviewList, function($review) use($id){
        //         return $review->getId_review() != $id;
        //     });

        //     $this->SaveData();
        // }

        // function GetNextId_review()
        // {
        //     $id = 0;

        //     $this->RetrieveData();

        //     foreach($this->reviewList as $review)
        //     {
        //         $id = ($review->getId_review() > $id) ? $review->getId_review() : $id;
        //     }

        //     return $id + 1;
        // }

        // private function RetrieveData()
        // {
        //      $this->reviewList = array();

        //      if(file_exists($this->fileName))
        //      {
        //          $jsonToDecode = file_get_contents($this->fileName);

        //          $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
        //          foreach($contentArray as $content)
        //          {

        //             $review = new Review();
        //             $review->setId_review($content["id_review"]);
        //             $review->setId_guardian($content["id_guardian"]);
        //             $review->setQuantity_reviews($content["quantity_reviews"]);
        //             $review->setSum_reviews($content["sum_reviews"]);
        //             $review->setReview($content["review"]);

        //             array_push($this->reviewList, $review);
        //          }
        //      }
        // }

        // private function SaveData()
        // {
        //     $arrayToEncode = array();

        //     foreach($this->reviewList as $review)
        //     {
        //         $valuesArray = array();
        //         $valuesArray["id_review"] = $review->getId_review();
        //         $valuesArray["id_guardian"] = $review->getId_guardian();
        //         $valuesArray["quantity_reviews"] = $review->getQuantity_reviews();
        //         $valuesArray["sum_reviews"] = $review->getSum_reviews();
        //         $valuesArray["review"] = $review->getReview();

        //         array_push($arrayToEncode, $valuesArray);
        //     }

        //     $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        //     file_put_contents($this->fileName, $fileContent);
        // }

        // JSON CLASSES ↑
    
    }

?>