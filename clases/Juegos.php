<?php

class Juegos
{
    public $nombre;
    public $descripcion;
    public $id_genero;
    public $id_ambientacion;
    public $id_usuario;

    public function __construct($nombre, $descripcion)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_genero = $id_genero;
        $this->id_ambientacion = $id_ambientacion;
        $this->id_usuario = $id_usuario;
    }

    function es_propio($id_usuario_logueado)
    {
        return $this->id_usuario == $id_usuario_logueado;
    }

    
}