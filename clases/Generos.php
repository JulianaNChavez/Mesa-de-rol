<?php

class Generos
{
    public $id;
    public $nombre;

    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}