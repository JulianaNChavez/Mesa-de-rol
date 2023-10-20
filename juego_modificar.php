<?php

require_once 'clases/Usuario.php';
require_once 'clases/Juegos.php';
require_once 'clases/ControladorJuegos.php';

// Validamos que el usuario tenga sesión iniciada:
session_start();
if (isset($_SESSION['usuario'])) {
    // Si es así, recuperamos la variable de sesión
    $usuario = unserialize($_SESSION['usuario']);
} else {
    // Si no, redirigimos al login
    header('Location: index.php');
}

$cv = new ControladorJuegos($usuario->getId());

$generos = $cv->lista_secundarios("generos");

$ambientacion = $cv->lista_secundarios("ambientaciones");

$i = 0

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Mesa de Rol</h1>
      </div>
      <div class="text-center">
        <h3>Modificar datos del juego</h3><br>
        <form action="modificar_juego.php" method="post">
            <label for="nombre_original">Nombre actual del juego</label>
            <input name="nombre_original" class="form-control form-control-lg"><br>
            <label for="nombre_juego">Nuevo nombre del juego</label>
            <input name="nombre_juego" class="form-control form-control-lg"><br>
            <label for="descripcion">Descripcion</label>
            <input name="descripcion" class="form-control form-control-lg"><br>
            <label for="genero">Genero</label>
            <br>
            <?php foreach ($generos as $s) {
                $i+=1;
                echo '<input class="form-check-input" type="radio" name="genero" value=' . $i . '>' . $s . "<br>";
            }
            ?>
                <br>
                <label for="ambientacion">Ambientacion</label>
            <br>
            <?php $i=0;
            foreach ($ambientacion as $s) {
                $i+=1;
                echo '<input class="form-check-input" type="radio" name="ambientacion" value=' . $i . '>' . $s . "<br>";
            }
            ?>
                <br>
            <input type="submit" value="Modificar datos" class="btn btn-primary">
        </form>
      </div>
    </body>
</html>