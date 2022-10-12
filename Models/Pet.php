<?php

namespace Models;

class Pet
{

    private $id_pet;
    private $id_owner;
    private $img;
    private $name;
    private $size;
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

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
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