<?php

require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';

session_start();

if(isset($_SESSION['usuario']))
{
    $usuario = unserialize($_SESSION['usuario']);
}   else {
    header('Location: index.php');
}

if ( empty($_POST['nombre_usuario']) || empty($_POST['nombre']) || empty($_POST['apellido'])) {
    $mensaje = "Debe rellenar todos los campos para la actualizacion de datos.";
    header("Location:home.php?mensaje=$mensaje");
    die();
}

$cs = new ControladorSesion();

$resultado = $cs->modificar($_POST['nombre_usuario'], $_POST['nombre'], $_POST['apellido'], $usuario);

if ($resultado) {
    $redirigir = "home.php?mensaje=Datos modificados exitosamente";
}   else {
    $redirigir = "home.php?mensaje=Error al modificar datos";
}
header("Location: $redirigir");