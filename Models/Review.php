<?php

namespace Models;

class Review
{
    private $id_review;
    private $id_guardian;
    private $quantity_reviews;
    private $sum_reviews;
    private $review; // review = (sum_reviews / quantity_reviews)

    // -> SETTERS Y GETTERS

    public function getId_review()
    {
        return $this->id_review;
    }

    public function setId_review($id_review)
    {
        $this->id_review = $id_review;
    }


    public function getId_guardian()
    {
        return $this->id_guardian;
    }

    public function setId_guardian($id_guardian)
    {
        $this->id_guardian = $id_guardian;
    }


    public function getQuantity_reviews()
    {
        return $this->quantity_reviews;
    }

    public function setQuantity_reviews($quantity_reviews)
    {
        $this->quantity_reviews = $quantity_reviews;
    }


    public function getSum_reviews()
    {
        return $this->sum_reviews;
    }
 
    public function setSum_reviews($sum_reviews)
    {
        $this->sum_reviews = $sum_reviews;
    }


    public function getReview()
    {
        return $this->review;
    }

    public function setReview($review)
    {
        $this->review = $review;
    }

    // <- SETTERS Y GETTERS
}

?>