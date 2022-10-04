<?php

namespace Models;

class Dueño
{

    private $nombre;
    private $animal;
    private $raza;
    private $tamaño;
    private $observaciones;

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

    // get y set tipo animal

    public function getAnimal()
    {
        return $this->animal;
    }

    public function setAnimal($animal)
    {
        $this->animal = $animal;
        return $this;
    }

    // get y set el raza

    public function getRaza()
    {
        return $this->raza;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;
        return $this;
    }

    // get y set tamaño

    public function getTamaño()
    {
        return $this->tamaño;
    }

    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;
        return $this;
    }

    // get y set de observaciones

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
        return $this;
    }



    
}


?>