<?php
require_once 'conection.php';

try {
    $type = $_GET['type'] ?? 'juegos';
    $limit = $_GET['limit'] ?? 100;
    
    $query = match($type) {
        'juegos' => "SELECT * FROM videojuegos ORDER BY rating_avg DESC LIMIT $limit",
        'devs' => "SELECT * FROM desarrolladores LIMIT $limit",
        'noticias' => "SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT $limit",
        'comunidades' => "SELECT * FROM comunidades LIMIT $limit",
        default => "SELECT * FROM videojuegos LIMIT $limit"
    };
    
    $stmt = $gbd->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>