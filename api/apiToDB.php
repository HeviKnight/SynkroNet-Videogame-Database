<?php
// Conectamos la base de datos
require_once 'conection.php';

try {
    // 2. Definir URL de RAWG (ejemplo: 10 juegos más populares)
    $url = "https://api.rawg.io/api/games?key=" . RAWG_API_KEY . "&page_size=10";

    // 3. Petición cURL a la API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        throw new Exception("Fallo en cURL: " . curl_error($ch));
    }
    
    $data = json_decode($response, true);
    curl_close($ch);

    // Verificamos que existan resultados
    if (!isset($data['results'])) {
        throw new Exception("No se recibieron datos de RAWG. Verifica tu API Key.");
    }

    // 4. Preparar la sentencia SQL (Evita inyección SQL)
    $sql = "INSERT INTO juegos (rawg_id, titulo, imagen_url, rating) 
            VALUES (:id, :titulo, :img, :rating)
            ON DUPLICATE KEY UPDATE 
            titulo = VALUES(titulo), 
            imagen_url = VALUES(imagen_url),
            rating = VALUES(rating)";

    $stmt = $pdo->prepare($sql);

    // 5. Recorrer y guardar
    $count = 0;
    foreach ($data['results'] as $game) {
        $stmt->execute([
            ':id'     => $game['id'],
            ':titulo' => $game['name'],
            ':img'    => $game['background_image'],
            ':rating' => $game['rating']
        ]);
        $count++;
    }

    echo "Sincronización finalizada: $count juegos actualizados.";

} catch (PDOException $e) {
    echo "Error de Base de Datos: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error General: " . $e->getMessage();
}