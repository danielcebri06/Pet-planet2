<?php
session_start();
include("conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_form = $_POST["nombre_usuario"]; 
    $contrasena = $_POST["contrasena"];

    $stmt = $conexion->prepare("SELECT id, usuario, contrasena FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario_form);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        
        if (password_verify($contrasena, $fila['contrasena'])) {
            $_SESSION['usuario'] = $fila['usuario']; 
            
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='login.html';</script>";
    }
}
?>