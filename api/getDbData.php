<?php
/**
 * DEPRECATED
 * 
 * Este archivo ya no es necesario.
 * Los datos ahora vienen directamente desde JavaScript 
 * llamando a la API de RAWG con caché en localStorage.
 * 
 * Consulta: js/script.js → externalGames module
 */

header('Content-Type: application/json');
echo json_encode([
    'message' => 'Este endpoint está deprecado',
    'use_instead' => 'Los datos vienen desde RAWG API directamente en JavaScript'
]);
?>