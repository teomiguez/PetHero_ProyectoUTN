<?php

namespace Models;

class Guardian
{

    private $id_guardian;
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $direccion;
    private $email;
    private $contraseña;
    private $reputacion;
    private $tamañoMascotaPref;
    private $precio;
    private $fechasDisponibles = array();

    // get y set id_guardian

    public function getId_guardian()
    {
        return $this->id_guardian;
    }

    public function setId_guardian($id_guardian)
    {
        $this->id_guardian = $id_guardian;
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

    // get y set la direccion

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
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

    // get y set la contraseña

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
        return $this;
    }

    // get y set la reputacion 

    public function getReputacion()
    {
        return $this->reputacion;
    }

    public function setReputacion($reputacion)
    {
        $this->reputacion = $reputacion;
        return $this;
    }

    // get y set el tamaño preferente de mascota

    public function getTamañoMascotaPref()
    {
        return $this->tamañoMascotaPref;
    }

    public function setTamañoMascotaPref($tamañoMascotaPref)
    {
        $this->tamañoMascotaPref = $tamañoMascotaPref;
        return $this;
    }

    // get y set el precio 

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
        return $this;
    }


     // get y set de fechas disponibles 

    public function getFechasDisponibles()
    {
        return $this->fechasDisponibles;
    }

    public function setFechasDisponibles($fechasDisponibles)
    {
        $this->fechasDisponibles = $fechasDisponibles;
        return $this;
    }   
    
}





?>