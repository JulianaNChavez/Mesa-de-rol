<?php

require_once 'Usuario.php';
require_once '.env.php';

class RepositorioUsuario
{
    public function login($nombre_usuario, $clave)
    {
        $q = "SELECT id, clave, nombre, apellido FROM usuarios WHERE nombre_usuario = ?;";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);

        if ($query->execute()) {
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
            if ($query->fetch()) {
                // Validar que la clave esté bien:
                if (password_verify($clave, $clave_encriptada)) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $id);
                }
            }

        }
        return false;
    }

    public function save(Usuario $usuario, $clave)
    {
        $q = "INSERT INTO usuarios (nombre_usuario, nombre, apellido, clave) VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $nombre_usuario = $usuario->nombre_usuario;
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;

        $query->bind_param("ssss", $nombre_usuario, $nombre, $apellido, $clave);

        if ($query->execute()) {
            return self::$conexion->insert_id;
        } else {
            return false;
        }
    }

    public function eliminar(Usuario $usuario)
    {
        $q = "DELETE FROM usuarios WHERE id = ?";
        $query = self::$conexion->prepare($q);

        $id = $usuario->getId();

        $query->bind_param("d", $id);

        return $query->execute();
    }

    public function actualizar(string $nombre_usuario, string $nombre, string $apellido, Usuario $usuario)
    {
        $q = "UPDATE usuarios SET nombre_usuario = ?, nombre = ?, apellido = ? WHERE id = ?";

        $query = self::$conexion->prepare($q);

        $id = $usuario->getId();

        $query->bind_param("sssd", $nombre_usuario, $nombre, $apellido, $id);
        
        return $query->execute();
    }
}