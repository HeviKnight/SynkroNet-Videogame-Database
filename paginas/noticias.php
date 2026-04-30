<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
include_once('../componentes/filter-component.php');
?>

<!-- HEADER WITH GRADIENT TITLE -->
<header class="header-games">
    <h1 class="header-games-title">NOTICIAS</h1>
</header>

<section id="main-content" class="main-content">
    <main id="home">
        <?php include_once('../componentes/news-section.php'); ?>

        <!-- SEARCH SECTION -->
        <section class="section-B" id="search-section">
            <div class="section-buttons">
                <h2 class="section-title">Búsqueda avanzada</h2>
            </div>
            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-12">
                        <input type="text" class="form-control" placeholder="Título de noticia, autor, etiqueta, etc" aria-label="Buscar noticia">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="Categoría" aria-label="Buscar categoría">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <input type="text" class="form-control" placeholder="Fecha" aria-label="Buscar fecha">
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

        <!-- NEWS GRID AND FILTERS -->
        <section class="search-grid">
            <div class="search-grid-news">
                <div class="" id="news-grid">
                </div>
            </div>

            <div class="search-grid-filters">
                            <!-- Date Slider -->
                            <?php renderRangeSlider('Rango de fecha', 'date', 0, 60, 0, 60, ''); ?>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Filter Options -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Destacadas', [], 'featured', false, true); ?>
                                <?php renderFilterGroup('Tendencias', [], 'trending', false, true); ?>
                                <?php renderFilterGroup('Comentadas', [], 'commented', false, false); ?>
                            </div>

                            <div style="border-bottom: 1px solid white; margin: 5px;"></div>

                            <!-- Category Filters -->
                            <div style="padding: 5px 10px;">
                                <?php renderFilterGroup('Categorías', ['Gaming', 'Esports', 'Indie', 'Conferencias', 'Lanzamientos', 'Actualizaciones'], 'newsCategories', true); ?>
                                <?php renderFilterGroup('Autores', ['Redacción', 'Colaboradores', 'Expertos', 'Influencers'], 'newsAuthors', true); ?>
                                <?php renderFilterGroup('Etiquetas', ['2024', '2025', 'PC', 'Consolas', 'Mobile'], 'newsTags', true); ?>
                            </div>
                        </div>
            </section>

<?php
include_once("../componentes/footer.php");
?>
