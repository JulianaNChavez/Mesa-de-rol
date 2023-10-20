<?php

require_once 'clases/Usuario.php';
require_once 'clases/ControladorJuegos.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}


$cv = new ControladorJuegos($usuario->getId());

$filtro = null;
$titulo = "Todos los juegos";

if(!empty($_POST['filtro'])) {
    $filtro = $_POST['filtro'];
    $titulo = "Juegos del genero $filtro";
}

$juegos = $cv->listar($filtro);

?><!DOCTYPE html>
<html>
    <head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="bootstrap.min.css">
        <title>Juegos</title>
    </head>
    <body class="container">
    <div class="jumbotron text-center">
        <h1><?php echo $titulo; ?></h1>
    </div>
    <div class="text-center">
            <h6><a href="añadir_juego.php" class="text-center">¿Quieres añadir un juego? haz click aqui</a></h6>
        <form action="lista_juegos.php" method="post" class="jumbotron">
            <label for="filtro">Filtrar por genero:</label>
            <input name="filtro">
            <input type="submit" value="filtrar">
    </div>
        
        <ul>
            <?php
                foreach ($juegos as $j) {
                    echo "<li>" . $j . ' - ' . $cv->mostrar_enlaces($j) . "</li><br>";
                }
            ?>
            
        </ul>