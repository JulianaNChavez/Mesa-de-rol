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

    public function listar($filtro = null)
    {
        return $this->rj->get_all($filtro);
    }

    public function mostrar_enlaces(Juegos $juegos)
    {
        if ($juegos->es_propio($this->id_usuario)) {
            $modificar = "<a href='modificar_juego.php?id=$juegos->id'>Modificar datos</a>";
            $eliminar = "<a href='confirmar_borrado_de_juego.php?id=$juegos->id'>Eliminar juego</a>";
            return "$modificar - $eliminar";
        } else {
            return '';
        }
    }

    public function eliminar($juego)
    {
        $repo = new RepositorioJuegos();
        return $repo->eliminar($juego);
    }
}