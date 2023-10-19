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

$titulo = "Todos los juegos";

$juegos = $cv->listar();

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Juegos</title>
    </head>
    <body>
        <h1><?php echo $titulo; ?></h1>
        
        <ul>
            <?php
                foreach ($juegos as $j) {
                    echo "<li>" . $j . "</li>";
                }
            ?>
            
        </ul>