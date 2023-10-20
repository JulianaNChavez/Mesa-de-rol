<?php

require_once 'Usuario.php';
require_once 'Generos.php';
require_once 'Ambientaciones.php';

class Juegos
{
    public $id;
    public $nombre;
    public $descripcion;
    public $id_usuario;
    public $genero;
    public $ambientacion;

    public function __construct($id=null, $nombre, $descripcion, $id_usuario = null, Generos $genero, Ambientaciones $ambientacion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_usuario = $id_usuario;
        $this->genero = $genero;
        $this->ambientacion = $ambientacion;
    }

    public function es_propio($id_usuario_logueado)
    {
        return $this->id_usuario == $id_usuario_logueado;
    }

    public function __toString()
    {
        $texto = "Juego: $this->nombre - Descripcion: $this->descripcion <br> ";
        $texto.= "Su genero es: $this->genero - Cuya ambientacion principal se basa en: $this->ambientacion";
        return $texto;
    }
}