<?php
include 'conexion.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $tipo_mascota = isset($_GET['tipo_mascota']) ? $_GET['tipo_mascota'] : '';
    
    $query = "SELECT * FROM productos WHERE 1=1";
    $params = [];
    
    if ($categoria && $categoria !== 'todos') {
        $query .= " AND categoria = :categoria";
        $params[':categoria'] = $categoria;
    }
    
    if ($tipo_mascota && $tipo_mascota !== 'todos') {
        $query .= " AND tipo_mascota = :tipo_mascota";
        $params[':tipo_mascota'] = $tipo_mascota;
    }
    
    $query .= " ORDER BY creado_en DESC";
    
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'productos' => $productos
    ]);
    
} catch(PDOException $exception) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener productos: ' . $exception->getMessage()
    ]);
}
?>