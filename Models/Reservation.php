<?php

namespace Models;

class Reservation
{
    private $id_reservation;
    private $id_guardian;
    private $pet_size;
    private $pet_breed;
    private $is_accepted;
    private $is_confirm;
    private $first_day;
    private $last_day;
    private $total_days;

    // -> SETTERS Y GETTERS

    public function getId_reservation()
    {
        return $this->id_reservation;
    }

    public function setId_reservation($id_reservation)
    {
        $this->id_reservation = $id_reservation;
    }


    public function getId_guardian()
    {
        return $this->id_guardian;
    }

    public function setId_guardian($id_guardian)
    {
        $this->id_guardian = $id_guardian;
    }


    public function getPet_size()
    {
        return $this->pet_size;
    }

    public function setPet_size($pet_size)
    {
        $this->pet_size = $pet_size;
    }


    public function getPet_breed()
    {
        return $this->pet_breed;
    }

    public function setPet_breed($pet_breed)
    {
        $this->pet_breed = $pet_breed;
    }

    public function getIs_accepted()
    {
        return $this->is_accepted;
    }

    public function setIs_accepted($is_accepted)
    {
        $this->is_accepted = $is_accepted;
    }

    public function getIs_confirm()
    {
        return $this->is_confirm;
    }

    public function setIs_confirm($is_confirm)
    {
        $this->is_confirm = $is_confirm;
    }

    public function getFirst_day()
    {
        return $this->first_day;
    }

    public function setFirst_day($first_day)
    {
        $this->first_day = $first_day;
    }


    public function getLast_day()
    {
        return $this->last_day;
    }

    public function setLast_day($last_day)
    {
        $this->last_day = $last_day;
    }


    public function getTotal_days()
    {
        return $this->total_days;
    }

    public function setTotal_days($total_days)
    {
        $this->total_days = $total_days;
    }


}



?>