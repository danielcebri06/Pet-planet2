<?php
include 'conexion.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM productos WHERE precio_original > precio ORDER BY (precio_original - precio) DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'ofertas' => $ofertas
    ]);
    
} catch(PDOException $exception) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener ofertas: ' . $exception->getMessage()
    ]);
}
?>