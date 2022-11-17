<?php
    namespace Controllers;

    use DAO_SQL\ReviewDAO as ReviewDAO;
    use Models\Review as Review;

    class ReviewController
    {
        public function __contruct()
        {
            
        }
        
        function CreateNewReview($last_idGuardian)
        {
            try
            {
                $reviewDAO = new ReviewDAO();
                $review = new Review();
                
                // -> SETs REVIEW
                $review->setId_guardian($last_idGuardian);
                $review->setQuantity_reviews(0);
                $review->setSum_reviews(0);
                $review->setReview(0);
                // <- SETs REVIEW
                    
                // -> ADD REVIEW
                $reviewDAO->Add($review);
                // <- ADD REVIEW
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }

        public function UpdateReview($id_guardian, $rating)
        {
            try
            {
                $reviewDAO = new ReviewDAO();
                $review = new Review();
    
                $review = $reviewDAO->GetByIdGuardian($id_guardian);
    
                $newQuantity = $review->getQuantity_reviews() + 1;
                $newSum_reviews = $review->getSum_reviews() + $rating;
                $newReview = $newQuantity/$newSum_reviews;
                
                $review->setQuantity_reviews($newQuantity);
                $review->setSum_reviews($newSum_reviews);
                $review->setReview($newReview);
    
                $reviewDAO->Update($id_guardian, $review);
            }
            catch(Exception $ex)
            {
                $alert = [
                    "type" => "danger",
                    "text" => $ex->getMessage()
                ];
            }
        }
    }

?>