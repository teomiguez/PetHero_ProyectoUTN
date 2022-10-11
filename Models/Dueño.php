<?php

namespace Models;

class Dueño
{
    private $id_dueño;
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $email;
    private $contraseña;
    private $mascotas = array();

    // get y set id_dueño

    public function getId_dueño()
    {
        return $this->id_dueño;
    }

    public function setId_dueño($id_dueño)
    {
        $this->id_dueño = $id_dueño;
        return $this;
    }
    
    // get y set el nombre

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

     // get y set del apellido

     public function getApellido()
     {
         return $this->apelldo;
     }
 
     public function setApellido($apellido)
     {
         $this->apellido = $apellido;
         return $this;
     }


    // get y set el dni

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
        return $this;
    }

    // get y set el telefono

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }

    // get y set el email

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    // get y set la contraseña del email

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
        return $this;
    }

    // get y set de mascotas

    public function getMascotas()
    {
        return $this->mascotas;
    }

    public function setMascotas($mascotas)
    {
        $this->mascotas = $mascotas;
        return $this;
    }

    
}


?>