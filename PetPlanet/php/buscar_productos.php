<?php
// Ajusta la ruta para subir un nivel y encontrar conectar.php
include '../conectar.php'; 

header('Content-Type: application/json');

// 1. Obtener el término de búsqueda y limpiar espacios
$termino = isset($_GET['q']) ? trim($_GET['q']) : '';

// 2. Validación: Si es muy corto, devolvemos lista vacía para no saturar
if (strlen($termino) < 2) {
    echo json_encode([
        'success' => true, 
        'productos' => []
    ]);
    exit;
}

try {
    // 3. Consulta SQL: Busca coincidencias en el nombre O en la descripción
    // LIMIT 6 asegura que la lista desplegable no sea infinita
    $sql = "SELECT * FROM productos WHERE nombre LIKE ? OR descripcion LIKE ? LIMIT 6";
    
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
    }

    $terminoBusqueda = "%" . $termino . "%";
    $stmt->bind_param("ss", $terminoBusqueda, $terminoBusqueda);
    $stmt->execute();
    
    $resultado = $stmt->get_result();
    $productos = [];

    while ($fila = $resultado->fetch_assoc()) {
        // Aseguramos tipos de datos correctos para JS
        $fila['precio'] = floatval($fila['precio']);
        // Si usas precio_original en la DB, asegúrate de enviarlo, si no, usa 0
        $fila['precio_original'] = isset($fila['precio_original']) ? floatval($fila['precio_original']) : 0;
        
        $productos[] = $fila;
    }

    // 4. Devolver respuesta JSON
    echo json_encode([
        'success' => true, 
        'productos' => $productos
    ]);

    $stmt->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
}

$conexion->close();
?>