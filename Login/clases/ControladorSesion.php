<?php

require_once 'clases/RepositorioUsuario.php';
class ControladorSesion
{
    public function login(string $nombre_usuario, string $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);

        if ($usuario === false) {
            //Fallo de login
            return [ false, "Error de credenciales"];
        } else {
            //Exito en login
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario correctamente autenticado"];
        }
    }

    function create($nombre_usuario, $nombre, $apellido, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($nombre_usuario, $nombre, $apellido);
        $id = $repo->save($usuario, $clave);
        if ($id === false) {
            //Falla al crear usuario
            return [ false, "Error al crear el usuario"];
        } else {
            $usuario->setId($id);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario creado correctamente"];
        }
    }

    function eliminar(Usuario $usuario)
    {
        $repo = new RepositorioUsuario();
        return $repo->eliminar($usuario);
        /** if($repo->eliminar($usuario)){
        *    return true;
        *} else {
        *    return false;
        *}
        **/
    }

    function modificar(string $nombre_usuario, string $nombre, string $apellido, Usuario $usuario)
    {
        $repo = new RepositorioUsuario();

        if ($repo->actualizar($nombre_usuario, $nombre, $apellido, $usuario)) {
            // Si los datos se actualizaron correctamente en la BD, actualizo
            // el usuario que tengo en memoria...
            $usuario->setDatos($nombre_usuario, $nombre, $apellido);
            // ... y lo guardo como variable de sesion para que se actualice y no se quede con el anterior.
            $_SESSION['usuario'] = serialize($usuario);

            return true;
        } else {
            return false;
        }
    }
}