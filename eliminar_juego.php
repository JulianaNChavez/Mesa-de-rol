<?php
require_once 'clases/Juegos.php';
require_once 'clases/Usuario.php';
require_once 'clases/ControladorJuegos.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

$cv = new ControladorJuegos($usuario->getId());

$resultado = $cv->eliminar($_POST['juego']);

if ($resultado) {
    $redirigir = "home.php?mensaje=Juego eliminado";
    session_destroy();
} else {
    $redirigir = "home.php?mensaje=No se pudo eliminar el juego por un error interno";
}

header("Location: $redirigir");