<?php
include("conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre_usuario = $_POST["usuario"]; 
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<script>alert('⚠️ El usuario ya existe.'); window.history.back();</script>";
    } else {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, email, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre_usuario, $email, $hash);

        if ($stmt->execute()) {
            echo "<script>
                    alert('✅ Usuario creado correctamente.');
                    window.location.href='login.html';
                  </script>";
            exit();
        } else {
            echo "<script>alert('❌ Error al registrar usuario.'); window.history.back();</script>";
        }
    }
}
?>