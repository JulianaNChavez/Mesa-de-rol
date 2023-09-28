<?php
//Retomamos la sesion y la destruimos
session_start();
session_destroy();
header('Location: index.php?mensaje=Sesión cerrada con éxito');