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
                            <div style="padding: 5px 10px;">
                                <label style="font-size: 12px; color: white; font-weight: bold; display: block; margin-bottom: 8px;">Rango de precio</label>
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="position: relative; height: 30px; display: flex; align-items: center;">
                                        <input type="range" id="priceMax" min="0" max="100" value="100" style="width: 100%; position: absolute; height: 6px; accent-color: var(--base-sky-main); -webkit-appearance: none;">
                                        <input type="range" id="priceMin" min="0" max="100" value="0" style="width: 100%; position: absolute; height: 6px; accent-color: var(--base-sky-main); -webkit-appearance: none; z-index: 10;">
                                    </div>
                                    <div style="display: flex; gap: 2.5px; align-items: center; justify-content: center;">
                                        <div style="background-color: white; border-radius: 6px; padding: 5px; text-align: center; font-size: 12px; color: var(--base-gray-400); flex: 1;"><span id="minPrice">0</span>€</div>
                                        <span style="width: 4px; height: 4px; background-color: white; border-radius: 1px;"></span>
                                        <div style="background-color: white; border-radius: 6px; padding: 5px; text-align: center; font-size: 12px; color: var(--base-gray-400); flex: 1;"><span id="maxPrice">100</span>€</div>
                                    </div>
                                </div>
                            </div>

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
                    </div>
                </div>
            </section>

    </main>
</section>

<?php
include_once("../componentes/footer.php");
?>