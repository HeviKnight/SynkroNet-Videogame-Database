<?php
/**
 * Endpoint seguro para obtener la API KEY de RAWG
 * Solo devuelve la clave, sin exponerla en el código JS
 */

require_once 'config.php';

header('Content-Type: application/json');

try {
    if (!defined('RAWG_API_KEY') || empty(RAWG_API_KEY)) {
        throw new Exception("RAWG_API_KEY no está configurada en config.php");
    }

    echo json_encode([
        'success' => true,
        'apiKey' => RAWG_API_KEY
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
