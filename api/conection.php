<?php
// 1. Incluimos las credenciales que creamos en el otro archivo
require_once 'config.php';

// 2. Construimos el DSN (Data Source Name) uniendo las constantes
// Mantenemos el charset=utf8mb4 para evitar problemas con la letra ñ o emojis

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

// 3. Intentamos la conexión
try {
    // Instanciamos PDO
    $gbd = new PDO($dsn, DB_USER, DB_PASS);
    
    // (Opcional) Le decimos a PDO que nos devuelva los datos como Objetos por defecto
    $gbd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (PDOException $e) {
    // Si algo falla (ej: contraseña incorrecta), atrapamos el error
    echo 'Error de conexión: ' . $e->getMessage();
    exit;
}
?>