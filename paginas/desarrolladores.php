<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
include_once('../componentes/filter-component.php');
?>

<!-- HEADER WITH GRADIENT TITLE -->
<header class="header-games">
    <h1 class="header-games-title">DESARROLLADORES</h1>
</header>

<section id="main-content" class="main-content">
    <main id="home">
        <?php include_once('../componentes/developers-section.php'); ?>

        <!-- SEARCH SECTION -->
        <section class="section-B" id="search-section">
            <div class="section-buttons">
                <h2 class="section-title">Búsqueda avanzada</h2>
            </div>
            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-12">
                        <input type="text" class="form-control" placeholder="Nombre de desarrollador, estudio, juego, etc" aria-label="Buscar desarrollador">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="País" aria-label="Buscar país">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="Especialidad" aria-label="Buscar especialidad">
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
                                <option value="nombre-asc">Nombre ▲</option>
                                <option value="nombre-desc">Nombre ▼</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DEVELOPERS GRID AND FILTERS -->
        <section class="search-grid">
            <div class="search-grid-games">
                <div class="games-grid row g-3" id="devs-grid">
                </div>
            </div>

            <div class="search-grid-filters">
                    <!-- Experience Range -->
                            <div style="padding: 5px 10px;">
                                <label style="font-size: 12px; color: white; font-weight: bold; display: block; margin-bottom: 8px;">Rango de experiencia</label>
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="position: relative; height: 30px; display: flex; align-items: center;">
                                        <input type="range" id="expMax" min="0" max="100" value="100" style="width: 100%; position: absolute; height: 6px; accent-color: var(--base-sky-main); -webkit-appearance: none;">
                                        <input type="range" id="expMin" min="0" max="100" value="0" style="width: 100%; position: absolute; height: 6px; accent-color: var(--base-sky-main); -webkit-appearance: none; z-index: 10;">
                                    </div>
                                    <div style="display: flex; gap: 2.5px; align-items: center; justify-content: center;">
                                        <div style="background-color: white; border-radius: 6px; padding: 5px; text-align: center; font-size: 12px; color: var(--base-gray-400); flex: 1;"><span id="minExp">0</span> años</div>
                                        <span style="width: 4px; height: 4px; background-color: white; border-radius: 1px;"></span>
                                        <div style="background-color: white; border-radius: 6px; padding: 5px; text-align: center; font-size: 12px; color: var(--base-gray-400); flex: 1;"><span id="maxExp">100</span> años</div>
                                    </div>
                                </div>
                            </div>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Filter Options -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Desarrolladores Independientes', [], 'independent', false, true); ?>
                                <?php renderFilterGroup('Estudios', [], 'studios', false, true); ?>
                                <?php renderFilterGroup('Verificados', [], 'verified', false, false); ?>
                            </div>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Category Filters -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Especialidades', ['Programación', 'Arte', 'Diseño', 'Sonido', 'Narrativa', 'Producción'], 'specialities', true); ?>
                                <?php renderFilterGroup('País', ['España', 'Argentina', 'México', 'USA', 'Japón', 'Canadá'], 'countries', true); ?>
                                <?php renderFilterGroup('Géneros', ['RPG', 'Shooter', 'Estrategia', 'Aventura', 'Simulación', 'Deportes'], 'genres', true); ?>
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
