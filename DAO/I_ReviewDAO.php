<?php
    namespace DAO;

    use Models\Review as Review;

    interface I_ReviewDAO
    {
        function Add(Review $review);
        function GetAll();
        function GetById($id);
        function Remove($id);
    }

?>