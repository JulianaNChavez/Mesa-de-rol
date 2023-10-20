<?php

class Ambientaciones
{
    public $id;
    public $nombre;

    public function __construct($id, $nombre = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}