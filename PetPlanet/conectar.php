<?php
$conexion = new mysqli("localhost", "root", "", "pet_planet");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
