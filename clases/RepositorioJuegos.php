<?php
require_once 'Repositorio.php';
require_once 'Juegos.php';
require_once 'Usuario.php';
require_once 'Generos.php';
require_once 'Ambientaciones.php';

class RepositorioJuegos extends repositorio
{
    public function get_all($filtro = null)
    {
        $sql =  "SELECT ";
	    $sql.=  "    j.id, j.nombre, j.descripcion, j.id_usuario, ";
	    $sql.=  "    g.id, g.nombre, ";
        $sql.=  "    a.id, a.nombre ";
        $sql.=  "FROM juegos j ";
        $sql.=  "INNER JOIN generos g ON j.id_genero = g.id ";
        $sql.=  "INNER JOIN ambientaciones a ON j.id_ambientacion = a.ID ";
        
        if ($filtro) {
            $sql .= "WHERE g.nombre = ? ";
        }
        $sql.=  "ORDER BY j.id;";

        $query = self::$conexion->prepare($sql);

        if ($filtro) {
            $query->bind_param("s", $filtro);
        }

        if ($query->execute())
        {
            $query->bind_result($id, $nombre, $descripcion, $id_usuario, 
                $cod_g, $genero,   
                $cod_a, $ambientacion);
        };
        $juegos = [];
        while ($query->fetch()) {
            $g = new Generos($cod_g, $genero);
            $a = new Ambientaciones($cod_a, $ambientacion);
            $j = new Juegos($id, $nombre, $descripcion, $id_usuario, $g, $a);
        
            $juegos[] = $j;
        }

        return $juegos;

    }

    public function get_secundarios($tipo)
    {
        $q="SELECT id, nombre FROM $tipo";

        $query = self::$conexion->prepare($q);

        if ($query->execute())
        {
            $query->bind_result($id, $nombre);
        };
        $secundarios = [];
        $i = [];
        $h = 0;
        while ($query->fetch()) {
            $s = new Generos($id, $nombre);

            $h += 1;

            $i[] = $h;

            $secundarios[] = $s;
        }

        return $secundarios;
    }

    public function crear(Juegos $juego)
    {
        $q = "INSERT INTO usuarios (nombre, descripcion, id_genero, id_ambientacion) VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $nombre = $juego->nombre;
        $descripcion = $juego->descripcion;
        $genero = $juego->genero;
        $ambientacion = $juego->ambientacion;

        $query->bind_param("ssdd", $nombre, $descripcion, $genero, $ambientacion);

        if ($query->execute()) {
            return self::$conexion->insert_id;
        } else {
            return false;
        }
    }

    public function eliminar($juego)
    {
        $q = "DELETE FROM juegos WHERE nombre = ?";
        $query = self::$conexion->prepare($q);

        $nombre = $juego;

        $query->bind_param("s", $nombre);

        return $query->execute();
    }

    public function actualizar(string $nombre, string $descripcion, $id_genero, $id_ambientacion, $nombre_original)
    {
        $q = "UPDATE juegos SET nombre = ?, descripcion = ?, id_genero = ?, id_ambientacion = ? WHERE nombre = ?";

        $query = self::$conexion->prepare($q);

        $query->bind_param("ssdds", $nombre, $descripcion, $id_genero, $id_ambientacion, $nombre_original);
        
        return $query->execute();
    }
}