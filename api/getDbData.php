<?php
require_once 'conection.php';

$stmt = $gbd->prepare("SELECT * FROM videojuegos ORDER BY rating_avg DESC LIMIT 20");
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($games);
?>