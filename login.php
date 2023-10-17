<?php

require_once 'clases/ControladorSesion.php';

if (empty($_POST['usuario']) || empty($_POST['clave'])) {
    //Volver a la pantalla de inicio con un error
    $redirigir = 'index.php?mensaje=Error, falta un campo obligatorio';

} else {
    $cs = new ControladorSesion();
    $respuesta = $cs->login($_POST['usuario'], $_POST['clave']);
    if($respuesta[0] === true) {
        //Si se logra loguear, se devuelve al home
        $redirigir = 'home.php?mensaje=' . $respuesta[1];
    } else {
        //Si falla al loguearse, se le devuelve al pincipio
        $redirigir = 'index.php?mensaje=' . $respuesta[1];
    }
}

header('Location: ' . $redirigir);