<?php
header('Content-Type: application/json; charset=utf-8');

// Evitar cualquier salida que no sea JSON
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once 'conection.php';

try {
    // Seleccionar todos los campos de la tabla videojuegos
    $stmt = $gbd->prepare("SELECT * FROM videojuegos LIMIT 20");
    $stmt->execute();
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!is_array($games)) {
        $games = [];
    }
    
    echo json_encode($games);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
