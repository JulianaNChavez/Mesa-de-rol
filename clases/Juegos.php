<?php

class Juegos
{
    public $nombre;
    public $descripcion;
    public $portada;
    public $ficha;
    public $id_genero;
    public $id_ambientacion;
    public $id_usuario;

    public function __construct($nombre, $descripcion, $portada, $ficha)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->portada = $portada;
        $this->ficha = $ficha;
        $this->id_genero = $id_genero;
        $this->id_ambientacion = $id_ambientacion;
        $this->id_usuario = $id_usuario;
    }

    function es_propio($id_usuario_logueado)
    {
        return $this->id_usuario == $id_usuario_logueado;
    }

    
}