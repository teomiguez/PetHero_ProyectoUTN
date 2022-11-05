<?php

namespace Models;

abstract class Pet
{
    private $id_owner;
    private $img;
    private $name;
    private $type;
    private $breed;
    private $size;
    private $planVacunacion;
    private $video;
    private $info;

    // -> SETTERS Y GETTERS

    public function getId_pet()
    {
        return $this->id_pet;
    }

    public function setId_pet($id_pet)
    {
        $this->id_pet = $id_pet;
    }

    public function getId_owner()
    {
        return $this->id_owner;
    }

    public function setId_owner($id_owner)
    {
        $this->id_owner = $id_owner;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }
 
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getPlanVacunacion()
    {
        return $this->planVacunacion;
    }

    public function setPlanVacunacion($planVacunacion)
    {
        $this->planVacunacion = $planVacunacion;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function setInfo($info)
    {
        $this->info = $info;
    }

    // <- SETTERS Y GETTERS
}

?>