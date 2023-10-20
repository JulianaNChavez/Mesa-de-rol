<?php
require_once 'RepositorioJuegos.php';
require_once 'Juegos.php';
require_once 'Generos.php';
require_once 'Ambientaciones.php';

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

    public function lista_secundarios($tipo)
    {
        return $this->rj->get_secundarios($tipo);
    }

    public function mostrar_enlaces(Juegos $juegos)
    {
        if ($juegos->es_propio($this->id_usuario)) {
            $modificar = "<a href='juego_modificar.php?id=$juegos->id'>Modificar datos</a>";
            $eliminar = "<a href='confirmar_borrado_de_juego.php?id=$juegos->id'>Eliminar juego</a>";
            return "$modificar - $eliminar";
        } else {
            return '';
        }
    }

    function crear($nombre, $descripcion, $id_genero, $id_ambientacion)
    {
        $repo = new RepositorioJuegos();
        $genero = new Genero($id_genero);
        $ambientacion = new Ambientacion($id_ambientacion);
        $juego = new Juegos($nombre, $descripcion, $genero, $ambientacion);
    }

    public function eliminar($juego)
    {
        $repo = new RepositorioJuegos();
        return $repo->eliminar($juego);
    }

    function modificar(string $nombre, string $descripcion, $genero, $ambientacion, $nombre_original)
    {
        $repo = new RepositorioJuegos();

        if ($repo->actualizar($nombre, $descripcion, $genero, $ambientacion, $nombre_original)) {
            return true;
        } else {
            return false;
        }
    }
}