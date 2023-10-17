<?php
require_once 'RepositorioJuegos.php';
require_once 'Juegos.php';

class ControladorJuegos
{
    public $id_usuario;

    public function __construct($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        $this->rj = new RepositorioJuegos();
    }

    public function listar()
    {
        return $this->rj->get_all();
    }
}