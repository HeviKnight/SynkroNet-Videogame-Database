<?php
session_start();

// Destruir la sesión
session_destroy();

// Eliminar cookie de recuérdame
if (isset($_COOKIE['SYNKRO_ID'])) {
    setcookie('SYNKRO_ID', '', time() - 3600, "/");
}

// Redirigir al login
header('Location: login.php?logout=1');
exit;
?>
