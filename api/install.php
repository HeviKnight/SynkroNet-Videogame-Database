<?php
/**
 * Script de instalación para generar config.php si no existe
 * Accede a: https://synkronet.vilimalab.es/api/install.php
 */

header('Content-Type: text/html; charset=utf-8');

$configPath = __DIR__ . '/config.php';
$examplePath = __DIR__ . '/config.php.example';

// Si config.php ya existe, no hacer nada
if (file_exists($configPath)) {
    echo "<h2>✅ config.php ya existe</h2>";
    echo "<p>El archivo de configuración está correctamente instalado.</p>";
    exit;
}

// Si config.php.example no existe, error
if (!file_exists($examplePath)) {
    echo "<h2>❌ Error: config.php.example no encontrado</h2>";
    echo "<p>Por favor, sube config.php.example al servidor.</p>";
    exit;
}

// Copiar config.php.example a config.php
if (copy($examplePath, $configPath)) {
    echo "<h2>✅ Instalación exitosa</h2>";
    echo "<p>Se ha creado config.php basado en config.php.example</p>";
    echo "<p><strong>⚠️ IMPORTANTE:</strong> Edita config.php con tus credenciales reales:</p>";
    echo "<ul>";
    echo "<li>DB_HOST, DB_NAME, DB_USER, DB_PASS</li>";
    echo "<li>RAWG_API_KEY</li>";
    echo "</ul>";
    echo "<p><a href='/'>Volver al inicio</a></p>";
} else {
    echo "<h2>❌ Error al crear config.php</h2>";
    echo "<p>Verifica permisos de escritura en la carpeta /api</p>";
}
