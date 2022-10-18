<?php

namespace Models;

class Owner
{
    private $id_owner;
    private $name;
    private $last_name;
    private $dni;
    private $telephone;
    private $email;
    private $password;

    // -> SETTERS Y GETTERS

    public function getId_owner()
    {
        return $this->id_owner;
    }

    public function setId_owner($id_owner)
    {
        $this->id_owner = $id_owner;
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
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    // <- SETTERS Y GETTERS
}


?>