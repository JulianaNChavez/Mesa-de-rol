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
        while ($query->fetch()) {
            $s = new Generos($id, $nombre);
        
            $secundarios[] = $s;
        }

        return $secundarios;
    }

    public function eliminar($juego)
    {
        $q = "DELETE FROM juegos WHERE nombre = ?";
        $query = self::$conexion->prepare($q);

        $nombre = $juego;

        $query->bind_param("s", $nombre);

        return $query->execute();
    }

    public function actualizar(string $nombre, string $descripcion, $genero, $ambientacion, $juego)
    {
        $q = "UPDATE juegos SET nombre = ?, descripcion = ?, genero = ?, ambientacion = ? WHERE nombre = ?";

        $query = self::$conexion->prepare($q);

        $id = $usuario->getId();

        $query->bind_param("ssss", $nombre_usuario, $nombre, $apellido, $id);
        
        return $query->execute();
    }
}