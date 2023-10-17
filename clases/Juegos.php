<?php

class Juegos
{
    public $nombre;
    public $descripcion;
    public $portada;
    public $ficha;
}

public function __construct($nombre, $descripcion, $portada, $ficha)
{
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->portada = $portada;
    $this->ficha = $ficha;
}