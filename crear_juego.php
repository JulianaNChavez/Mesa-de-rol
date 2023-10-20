<?php

require_once 'clases/Juegos.php';
require_once 'clases/Usuario.php';
require_once 'clases/ControladorJuegos.php';

session_start();

if(isset($_SESSION['usuario']))
{
    $usuario = unserialize($_SESSION['usuario']);
}   else {
    header('Location: index.php');
}

if ( empty($_POST['nombre_juego']) || empty($_POST['descripcion']) || empty($_POST['genero']) || empty($_POST['ambientacion'])) {
    $mensaje = "Debe rellenar todos los campos para poder crear el juego.";
    header("Location:home.php?mensaje=$mensaje");
    die();
}

$cv = new ControladorJuegos($usuario->getId());

$resultado = $cv->crear($_POST['nombre_juego'], $_POST['descripcion'], $_POST['genero'], $_POST['ambientacion']);

if ($resultado) {
    $redirigir = "home.php?mensaje=Juego creado exitosamente";
}   else {
    $redirigir = "home.php?mensaje=Error al crear el juego";
}
header("Location: $redirigir");