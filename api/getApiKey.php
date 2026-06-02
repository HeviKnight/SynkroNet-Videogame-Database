<?php
/**
 * Endpoint seguro para obtener la API KEY de RAWG
 * Solo devuelve la clave, sin exponerla en el código JS
 */

require_once 'config.php';

header('Content-Type: application/json');

if (!defined('RAWG_API_KEY') || empty(RAWG_API_KEY)) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'RAWG_API_KEY no configurada'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'apiKey' => RAWG_API_KEY
]);
