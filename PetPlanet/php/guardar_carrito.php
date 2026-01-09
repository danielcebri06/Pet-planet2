<?php
require_once 'conexion.php';

header('Content-Type: application/json');

try {
    // Obtener datos JSON del carrito
    $input = file_get_contents('php://input');
    $datos = json_decode($input, true);

    if (!isset($datos['productos']) || empty($datos['productos'])) {
        throw new Exception('Carrito vacío');
    }

    $productos = $datos['productos'];

    // Crear tabla de pedidos si no existe
    $sql_pedidos = "CREATE TABLE IF NOT EXISTS pedidos (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        total_importe DECIMAL(10,2) NOT NULL,
        estado VARCHAR(50) DEFAULT 'Pendiente',
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $conexion->query($sql_pedidos);

    // Crear tabla de detalles de pedidos si no existe
    $sql_detalles = "CREATE TABLE IF NOT EXISTS pedidos_detalles (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pedido_id INT UNSIGNED NOT NULL,
        nombre_producto VARCHAR(255) NOT NULL,
        precio DECIMAL(10,2) NOT NULL,
        cantidad INT NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $conexion->query($sql_detalles);

    // Calcular total
    $total = 0;
    foreach ($productos as $producto) {
        $precio = floatval($producto['precio']);
        $cantidad = intval($producto['cantidad']);
        $total += $precio * $cantidad;
    }

    // Agregar impuestos (21%)
    $impuestos = $total * 0.21;
    $total_con_impuestos = $total + $impuestos;

    // Insertar pedido
    $stmt = $conexion->prepare("INSERT INTO pedidos (total_importe) VALUES (?)");
    $stmt->bind_param('d', $total_con_impuestos);
    
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar pedido: " . $stmt->error);
    }

    $pedido_id = $conexion->insert_id;

    // Insertar detalles del pedido
    $stmt_detalle = $conexion->prepare("INSERT INTO pedidos_detalles (pedido_id, nombre_producto, precio, cantidad, subtotal) VALUES (?, ?, ?, ?, ?)");

    foreach ($productos as $producto) {
        $nombre = $producto['nombre'];
        $precio = floatval($producto['precio']);
        $cantidad = intval($producto['cantidad']);
        $subtotal = $precio * $cantidad;

        $stmt_detalle->bind_param('issid', $pedido_id, $nombre, $precio, $cantidad, $subtotal);
        
        if (!$stmt_detalle->execute()) {
            throw new Exception("Error al insertar detalles: " . $stmt_detalle->error);
        }
    }

    echo json_encode([
        'exito' => true,
        'pedido_id' => $pedido_id,
        'mensaje' => 'Pedido guardado correctamente'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'exito' => false,
        'error' => $e->getMessage()
    ]);
}

$conexion->close();
?>
