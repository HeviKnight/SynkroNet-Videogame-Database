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
    $sql = "INSERT INTO videojuegos (rawg_id, titulo, descripcion, imagen_url, rating_avg, fecha_lanzamiento) 
            VALUES (:rawg_id, :titulo, :descripcion, :imagen_url, :rating_avg, :fecha_lanzamiento)
            ON DUPLICATE KEY UPDATE 
            titulo = VALUES(titulo), 
            descripcion = VALUES(descripcion),
            imagen_url = VALUES(imagen_url),
            rating_avg = VALUES(rating_avg),
            fecha_lanzamiento = VALUES(fecha_lanzamiento)";

    $stmt = $gbd->prepare($sql);

    // 5. Recorrer y guardar
    $count = 0;
    foreach ($data['results'] as $game) {
        $stmt->execute([
            ':rawg_id' => $game['id'],
            ':titulo' => $game['name'],
            ':descripcion' => $game['description'] ?? null,
            ':imagen_url' => $game['background_image'] ?? null,
            ':rating_avg' => $game['rating'] ?? 0,
            ':fecha_lanzamiento' => $game['released'] ?? null
        ]);
        $count++;
    }

    echo "Sincronización finalizada: $count juegos actualizados.";

} catch (PDOException $e) {
    echo "Error de Base de Datos: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error General: " . $e->getMessage();
}