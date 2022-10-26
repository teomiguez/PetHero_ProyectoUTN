<?php

    namespace DAO;

    use DAO\I_ReviewDAO as I_ReviewDAO;
    use Models\Review as Review;

    class ReviewDAO implements I_ReviewDAO
    {
        private $reviewList = array();
        private $fileName;

        public function __construct() 
        {
            $this->fileName = dirname(__DIR__)."/Data/Reviews.json";
        }

        function Add(Review $review)
        {
            $this->RetrieveData();

            $stay->setId_stay($this->GetNextId());

            array_push($this->reviewList, $review);

            $this->SaveData();
        }
        
        function GetAll()
        {
            $this->RetrieveData();

            return $this->reviewList;
        }
        
        function GetByGuardian($id_guardian)
        {
            $this->RetrieveData();
            
            $Reviews = array_filter($this->reviewList, function ($review) use ($id_guardian) 
            {
                return $review->getId_guardian() == $id_guardian;
            });

            return $Reviews;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $Reviews = array_filter($this->reviewList, function($review) use ($id) {
                return $review->getId_review() == $id;
            });

            $Reviews = array_values($Reviews); //Reorderding array

            return (count($Reviews) > 0) ? $Reviews[0] : null;
        }
        
        function Remove($id)
        {
            $this->RetrieveData();

            $this->reviewList = array_filter($this->reviewList, function($review) use($id){
                return $review->getId_review() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->reviewList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {

                    $review = new Review();
                    $review->setId_review($content["id_review"]);
                    $review->setId_guardian($content["id_guardian"]);
                    $review->setQuantity_reviews($content["quantity_reviews"]);
                    $review->setSum_reviews($content["sum_reviews"]);
                    $review->setReview($content["review"]);

                    array_push($this->reviewList, $review);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->reviewList as $review)
            {
                $valuesArray = array();
                $valuesArray["id_review"] = $review->getId_review();
                $valuesArray["id_guardian"] = $review->getId_guardian();
                $valuesArray["quantity_reviews"] = $review->getQuantity_reviews();
                $valuesArray["sum_reviews"] = $review->getSum_reviews();
                $valuesArray["review"] = $review->getReview();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->reviewList as $review)
            {
                $id = ($review->getId_review() > $id) ? $review->getId_review() : $id;
            }

            return $id + 1;
        }
    }

?>