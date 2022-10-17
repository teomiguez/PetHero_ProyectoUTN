<?php

namespace Models;

class Guardian
{

    private $id_guardian;
    private $name;
    private $last_name;
    private $dni;
    private $telephone;
    private $address;
    private $email;
    private $password;
    private $rating;
    private $sizeCare;
    private $cost;
    private $days = array();

    // -> SETTERS Y GETTERS

    public function getId_guardian()
    {
        return $this->id_guardian;
    }

    public function setId_guardian($id_guardian)
    {
        $this->id_guardian = $id_guardian;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }
 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
        return $this;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPasssword()
    {
        return $this->passsword;
    }

    public function setPassword($passsword)
    {
        $this->passsword = $passsword;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

     public function getSizeCare()
    {
        return $this->sizeCare;
    }

    public function setSizeCare($sizeCare)
    {
        $this->sizeCare = $sizeCare;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDays($days)
    {
        $this->days = $days;
    }
    
    // -> SETTERS Y GETTERS

    
}

?>