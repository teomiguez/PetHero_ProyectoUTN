<?php
    namespace Controllers;

    use DAO\ReviewDAO as ReviewDAO;
    use Models\Review as Review;

    class ReviewController
    {
        function CreateNewReview ($id_guardian)
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
    }

?>