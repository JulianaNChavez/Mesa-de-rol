<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: lista_juegos.php');
}

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Bienvenido al sistema</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Mesa de rol</h1>
      </div>
      <div class="text-center">
            <div id="mensaje" class="alert alert-danger text-center">
                    <p>Advertencia. Ud va a <strong>eliminar</strong> este juego.
                        Esta acción no se puede deshacer.</p>
            </div>

            <form action="eliminar_juego.php" method="post">
            <label for="juego">Por favor, escriba el nombre del juego que va a <strong>eliminar</strong>: </label><br>
            <input name="juego" class="form-control form-control-lg" placeholder="Juego"><br>
            <input type="submit" value="Eliminar juego" class="btn btn-primary">
            </form>
      </div>
    </body>
</html>
