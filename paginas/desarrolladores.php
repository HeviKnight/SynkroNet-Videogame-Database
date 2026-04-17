<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
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
                    <!-- Date Range -->
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
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="independent" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);" checked>
                                    <label for="independent" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">Desarrolladores Independientes</label>
                                </div>
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="studios" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);" checked>
                                    <label for="studios" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">Estudios</label>
                                    <button style="width: 10px; height: 10px; border: none; background: none; cursor: pointer; color: var(--base-ink); padding: 0;">
                                        <i class="bi bi-chevron-up" style="font-size: 8px;"></i>
                                    </button>
                                </div>
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="verified" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);">
                                    <label for="verified" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">Verificados</label>
                                </div>
                            </div>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Category Filters -->
                            <div style="padding: 5px 10px;">
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="specialities" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);">
                                    <label for="specialities" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">Especialidades</label>
                                    <button style="width: 10px; height: 10px; border: none; background: none; cursor: pointer; color: var(--base-ink); padding: 0;">
                                        <i class="bi bi-chevron-up" style="font-size: 8px;"></i>
                                    </button>
                                </div>
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="countries" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);">
                                    <label for="countries" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">País</label>
                                    <button style="width: 10px; height: 10px; border: none; background: none; cursor: pointer; color: var(--base-ink); padding: 0;">
                                        <i class="bi bi-chevron-up" style="font-size: 8px;"></i>
                                    </button>
                                </div>
                                <div style="background-color: white; border-radius: 6px; padding: 5px; display: flex; gap: 5px; align-items: center; margin-bottom: 10px;">
                                    <input type="checkbox" id="genres" style="width: 12px; height: 12px; accent-color: var(--base-Turquoise-main);">
                                    <label for="genres" style="font-size: 11px; color: var(--base-ink); cursor: pointer; flex: 1; margin: 0;">Géneros</label>
                                    <button style="width: 10px; height: 10px; border: none; background: none; cursor: pointer; color: var(--base-ink); padding: 0;">
                                        <i class="bi bi-chevron-up" style="font-size: 8px;"></i>
                                    </button>
                                </div>
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
