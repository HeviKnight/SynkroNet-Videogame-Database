<?php
/**
 * Endpoint seguro para obtener la API KEY de RAWG
 * Solo devuelve la clave, sin exponerla en el código JS
 */

header('Content-Type: application/json');

try {
    // Verificar que config.php existe
    $configPath = __DIR__ . '/config.php';
    if (!file_exists($configPath)) {
        throw new Exception("Archivo config.php no encontrado en: $configPath");
    }
    
    require_once $configPath;

    if (!defined('RAWG_API_KEY') || empty(RAWG_API_KEY)) {
        throw new Exception("RAWG_API_KEY no está configurada en config.php");
    }

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'apiKey' => RAWG_API_KEY
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
