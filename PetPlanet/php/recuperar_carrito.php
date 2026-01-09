<?php
require_once 'conexion.php';

header('Content-Type: application/json');

try {
    $pedido_id = isset($_GET['pedido_id']) ? intval($_GET['pedido_id']) : null;

    if (!$pedido_id) {
        throw new Exception('No se proporcionó ID de pedido');
    }

    // Obtener detalles del pedido
    $stmt = $conexion->prepare("SELECT pd.*, p.total_importe, p.estado, p.creado_en 
                               FROM pedidos_detalles pd
                               JOIN pedidos p ON pd.pedido_id = p.id 
                               WHERE pd.pedido_id = ?");
    $stmt->bind_param('i', $pedido_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $detalles = [];
    $total = 0;
    $estado = '';
    $fecha = '';

    while ($fila = $resultado->fetch_assoc()) {
        $detalles[] = [
            'nombre_producto' => $fila['nombre_producto'],
            'precio' => floatval($fila['precio']),
            'cantidad' => intval($fila['cantidad']),
            'subtotal' => floatval($fila['subtotal'])
        ];
        $total = floatval($fila['total_importe']);
        $estado = $fila['estado'];
        $fecha = $fila['creado_en'];
    }

    if (empty($detalles)) {
        throw new Exception('Pedido no encontrado');
    }

    echo json_encode([
        'exito' => true,
        'pedido_id' => $pedido_id,
        'detalles' => $detalles,
        'total' => $total,
        'estado' => $estado,
        'fecha' => $fecha
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
