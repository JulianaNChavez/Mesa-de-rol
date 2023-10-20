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

    function crear($nombre_usuario, $nombre, $apellido, $clave)
    {
        $repo = new RepositorioJuegos();
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
            // Si los datos se actualizaron correctamente en la BD, actualizo
            // el usuario que tengo en memoria...

            return true;
        } else {
            return false;
        }
    }
}