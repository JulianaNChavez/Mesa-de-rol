<?php
require_once 'Juegos.php';
require_once 'Usuario.php';
require_once 'Generos.php';
require_once 'Ambientaciones.php';
require_once '.env.php';

class RepositorioJuegos
{
    private static $conexion = null;

    public function __construct()
    {
        $credenciales = credenciales();
        if (is_null(self::$conexion)) {
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos'],
            );
        }
        if (self::$conexion->connect_error) {
            $error = 'Error de conexion: ' . self::$conexion->connect_error;
            self::$conexion = null;
            die($error);
        }
        self::$conexion->set_charset('utf8mb4');
    }

    public function get_all()
    {
        $sql =  "SELECT ";
	    $sql.=  "    j.id, j.nombre, j.descripcion, j.id_usuario, ";
	    $sql.=  "    g.id, g.nombre, ";
        $sql.=  "    a.id, a.nombre ";
        $sql.=  "FROM juegos j ";
        $sql.=  "INNER JOIN generos g ON j.id_genero = g.id ";
        $sql.=  "INNER JOIN ambientaciones a ON j.id_ambientacion = a.ID ";
        $sql.=  "ORDER BY j.id;";

        $query = self::$conexion->prepare($sql);

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
            $j = new Juegos($)
        }
    }
}