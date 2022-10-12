<?php

namespace Models;

class Mascota
{

    private $id_mascota;
    private $id_dueño;
    private $img;
    private $nombre;
    private $tamaño;
    private $video;
    private $observaciones;


    // get y set mascota

    public function getId_mascota()
    {
        return $this->id_mascota;
    }

    public function setId_mascota($id_mascota)
    {
        $this->id_mascota = $id_mascota;
        return $this;
    }

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

    // get y set img

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
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

    // get y set video

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;
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