<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
include_once('../componentes/filter-component.php');
?>

<!-- HEADER WITH GRADIENT TITLE -->
<header class="header-games">
    <h1 class="header-games-title">GAMES</h1>
</header>

<section id="main-content" class="main-content">
    <main id="home">
        <?php include_once('../componentes/games-section.php'); ?>

        <!-- SEARCH SECTION -->
        <section class="section-B" id="search-section">
            <div class="section-buttons">
                <h2 class="section-title">Búsqueda avanzada</h2>
            </div>
            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-12">
                        <input type="text" class="form-control" placeholder="Nombre del juego, etiqueta, desarrollador, etc" aria-label="Buscar juego">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="Categoría" aria-label="Buscar categoría">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="Plataforma" aria-label="Buscar plataforma">
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <button class="btn btn-dark w-100" style="padding: 12px 16px; height: auto;">Buscar</button>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-12">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="flex: 1; height: 1px; background-color: var(--border-sky);"></div>
                            <span style="white-space: nowrap; color: var(--text-main);">Ordenar por</span>
                            <select class="form-control select-dark">
                                <option value="relevancia-desc">Relevancia ▼</option>
                                <option value="relevancia-asc">Relevancia ▲</option>
                                <option value="fecha-asc">Fecha ▲</option>
                                <option value="fecha-desc">Fecha ▼</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GAMES GRID AND FILTERS -->
        <section class="search-grid">
            <div class="search-grid-games">
                <div class="games-grid row g-3" id="games-grid">
                </div>
            </div>

            <div class="search-grid-filters">
                            <!-- Price Slider -->
                            <?php renderRangeSlider('Rango de precio', 'price', 0, 60, 0, 60, '€'); ?>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Filter Options -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Ocultar mi biblioteca', [], 'hideLibrary', false, true); ?>
                                <?php renderFilterGroup('Progreso personal', [], 'personalProgress', false, true); ?>
                                <?php renderFilterGroup('Reseñados', [], 'reviewed', false, false); ?>
                            </div>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Category Filters -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Categorías', ['Acción', 'RPG', 'Aventura', 'Puzzle', 'Estrategia', 'Simulación'], 'categoriesFilter', true); ?>
                                <?php renderFilterGroup('Géneros', ['Arcade', 'Indie', 'Casual', 'Racing', 'Deporte', 'Horror'], 'genresFilter', true); ?>
                                <?php renderFilterGroup('Plataformas', ['PC', 'PlayStation', 'Xbox', 'Nintendo', 'Mobile'], 'platformsFilter', true); ?>
                            </div>
                        </div>
            </section>
<?php
include_once("../componentes/footer.php");
?>