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
        <meta charset="utf-8">
        <title>Juegos</title>
    </head>
    <body>
        <h1><?php echo $titulo; ?></h1>
            <a href="añadir_juego.php">¿Quieres añadir un juego? haz click aqui</a><br>
        <form action="lista_juegos.php" method="post">
            <label for="filtro">Filtrar por genero:</label>
            <input name="filtro">
            <input type="submit" value="filtrar">
        
        <ul>
            <?php
                foreach ($juegos as $j) {
                    echo "<li>" . $j . ' - ' . $cv->mostrar_enlaces($j) . "</li>";
                }
            ?>
            
        </ul>