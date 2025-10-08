<?php

$host = "localhost";
$usuario = "novelas_user";  
$clave = "1234";
$bd = "gestion_novelas";

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>

