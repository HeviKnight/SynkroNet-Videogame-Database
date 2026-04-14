<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
?>

<!-- Menu hamburguesa movil -->
<button id="toggle-sidebar" class="btn-toggle-sidebar" title="Abrir menú">
    <i class="bi bi-list"></i>
</button>

<!-- Header móvil - Solo visible en dispositivos móviles -->
<div class="mobile-nav-header"></div>

<section id="main-content" class="main-content">
    <main id="home">
        <h1>Videojuegos</h1>
        <p>Contenido de videojuegos aquí</p>


<?php
include_once("../componentes/footer.php");
?>