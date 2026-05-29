<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
include_once("componentes/sidebar.php");
?>
    <script>
        window.GAME_FILE_URL = './paginas/game-file.php';
        window.DEV_FILE_URL = './paginas/dev-file.php';
    </script>

    <main id="home">
        <section id="main-content" class="main-content">

            <?php include_once("componentes/games-section.php"); ?>

            <?php include_once("componentes/developers-section.php"); ?>

            <?php include_once("componentes/news-section.php"); ?>

<?php
include_once("componentes/footer.php");
?>