<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');

// Procesar datos del juego enviados por POST
$gameData = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_data'])) {
    $gameData = json_decode($_POST['game_data'], true);
}

// Valores por defecto
$gameName = $gameData['name'] ?? 'Tetris';
$gameImage = $gameData['background_image'] ?? 'https://picsum.photos/600/300?random=1';
$gameRating = $gameData['rating'] ?? 8.75;
$gameDesc = $gameData['description'] ?? 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.';
$gameReleased = $gameData['released'] ?? '10/11/2012';
$gameMetacritic = $gameData['metacritic'] ?? 87;
$genres = $gameData['genres'] ?? [];
$developers = $gameData['developers'] ?? [];
$platforms = $gameData['platforms'] ?? [];

// Construir string de géneros
$genresStr = '';
if (is_array($genres) && count($genres) > 0) {
    $genreNames = array_map(function($g) { 
        return is_array($g) ? ($g['name'] ?? '') : (is_object($g) ? ($g->name ?? '') : ''); 
    }, $genres);
    $genresStr = implode(', ', array_filter($genreNames));
}

// Construir string de desarrolladores
$devsStr = '';
if (is_array($developers) && count($developers) > 0) {
    $devNames = array_map(function($d) { 
        return is_array($d) ? ($d['name'] ?? '') : (is_object($d) ? ($d->name ?? '') : ''); 
    }, $developers);
    $devsStr = implode(', ', array_filter($devNames));
}
?>
    <style>
        :root {
            --game-bg-image: url('<?php echo htmlspecialchars($gameImage); ?>');
        }
    </style>
    <script>
        window.GAME_FILE_URL = './game-file.php';
    </script>

    <main id="home">
    <section id="main-content" class="main-content">
        
        <!-- HERO SECTION -->
        <section class="section-hero-gamefile">
            <div style="background-image: url('<?php echo htmlspecialchars($gameImage); ?>');">
                <img src="<?php echo htmlspecialchars($gameImage); ?>" alt="<?php echo htmlspecialchars($gameName); ?> Cover">
                <div class="info">
                    <div>
                        <a href="#" class="btn btn-dark">
                            <i class="bi bi-pencil"></i>
                            <h4>Editar ficha</h4>
                        </a>
                        <a href="#" class="btn btn-dark">
                            <i class="bi bi-info-circle"></i>
                            <h4>Créditos</h4>
                        </a>         
                        <h4 class="btn tag-inverse">
                            <i class="bi bi-trophy"></i>
                            Top 100 games
                        </h4>
                    </div>
                </div>
            </div>
            <div>
                <h2><?php echo htmlspecialchars($gameName); ?></h2>
                <p><?php echo htmlspecialchars($devsStr ?: 'Desarrollador desconocido'); ?></p>
            </div>
        </section>

        <!-- INFORMATION TABS SECTION -->
        <section class="section-info">
            <div class="buttons-set">
                <button class="btn-half-corner">Información</button>
                <button class="btn-half-corner">Ficha técnica</button>
                <button class="btn-half-corner">DLCs</button>
                <button class="btn-half-corner">Etiquetas</button>
                <button class="btn-half-corner">Lanzamientos</button>
            </div>

            <div class="data">
                <div>
                    <div class="rating">
                        <span>Valoración:</span>
                        <span><?php echo number_format($gameRating, 2); ?> [Reviews]</span>
                        <span>
                            <?php 
                            $stars = round($gameRating / 2);
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $stars) {
                                    echo '<i class="bi bi-star-fill"></i>';
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                            }
                            ?>
                        </span>
                    </div>
                    <p>Fecha de Lanzamiento: <?php echo htmlspecialchars($gameReleased); ?></p>
                    <p>Metacritic: <?php echo htmlspecialchars($gameMetacritic ?? 'N/A'); ?></p>
                    <?php if (!empty($genresStr)): ?>
                        <p>Géneros: <?php echo htmlspecialchars($genresStr); ?></p>
                    <?php endif; ?>
                    <a href="#" class="btn btn-primary">Añadir a mi colección</a>
                    <a href="#" class="btn btn-primary">Comunidad</a>
                </div>
                <div>
                    <div style="position: relative; display: inline-block;">
                        <select class="btn btn-selector" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; padding-right: 40px; background-image: none;">
                            <option selected>¿He completado el juego o estoy en ello?</option>
                            <option value="not-started">Sin empezar</option>
                            <option value="in-progress">En progreso</option>
                            <option value="completed">Completado</option>
                        </select>
                        <i class="bi bi-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); pointer-events: none; color: var(--text-main); font-size: 1rem;"></i>
                    </div>
                    <a href="#" class="btn btn-dark"><i class="bi bi-box-arrow-up-right"></i> Dejar una reseña</a>
                    <h3>Descripción</h3>
                    <p><?php echo htmlspecialchars($gameDesc); ?></p>
                    <div style="display: flex; gap: 12px; margin-top: 16px;">
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-facebook"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-twitter"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-instagram"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-youtube"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-discord"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Links section -->
          <!-- RATINGS, LINKS & LANGUAGES SECTION -->
        <section id="links-section">
            <!-- Edad Recomendada -->
            <div class="section-link-card">
                <h5>Edad recomendada</h5>
                <div class="row">
                    <div class="col-4">
                        <img src='https://picsum.photos/200/200?random=1' alt="">
                        <span>EU</span>
                    </div>
                    <div class="col-4">
                        <img src='https://picsum.photos/200/200?random=2' alt="">
                        <span>JP</span>
                    </div>
                    <div class="col-4">
                        <img src='https://picsum.photos/200/200?random=3' alt="">
                        <span>US</span>
                    </div>
                    <div class="col-4">
                        <img src='https://picsum.photos/200/200?random=4' alt="">
                        <span>AU</span>
                    </div>
                </div>
            </div>

            <!-- Links a Terceros -->
            <div class="section-link-card">
                <h5>Links</h5>
                <div class="row">
                    <a href="#" class="col-4"><i class="bi bi-link-45deg"></i></a>
                    <a href="#" class="col-4"><i class="bi bi-discord"></i></a>
                    <a href="#"class="col-4"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="col-4"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="col-4"><i class="bi bi-twitch"></i></a>
                </div>
            </div>

            <!-- Idiomas Disponibles -->
            <div class="section-link-card">
                <h5>Idiomas</h5>
                <ul>
                    <li>Español</li>
                    <li>English</li>
                    <li>Français</li>
                    <li>中文</li>
                </ul>
            </div>
        </section>

        <!-- DEV BLOGS SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Dev Blogs (15)</h2>
                <button class="btn-b btn-dark" style="margin-left: auto;">
                    <i class="bi bi-plus-lg"></i> Añadir Develog
                </button>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky);">
                                <img src="https://picsum.photos/400/200?random=2" alt="Dev Blog" style="width: 100%; height: 200px; object-fit: cover;">
                                <div style="padding: 15px;">
                                    <h4 style="color: var(--text-main); margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem;">500 $</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky);">
                                <img src="https://picsum.photos/400/200?random=3" alt="Dev Blog" style="width: 100%; height: 200px; object-fit: cover;">
                                <div style="padding: 15px;">
                                    <h4 style="color: var(--text-main); margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem;">500 $</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMMUNITY SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Comunidad - Hilos destacados</h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                                <img src="https://picsum.photos/50/50?random=4" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                                <img src="https://picsum.photos/50/50?random=5" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                                <img src="https://picsum.photos/50/50?random=6" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                                <img src="https://picsum.photos/50/50?random=7" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-footer">
                <button class="btn-b btn-dark">Ir a comunidad</button>
            </div>
        </section>

        <!-- GALLERY SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Galería</h2>
                <button class="btn-b btn-dark" style="margin-left: auto;">
                    Expandir <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=8" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=9" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=10" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=11" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=12" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <img src="https://picsum.photos/300/200?random=13" alt="Gallery" style="width: 100%; border-radius: var(--border-radius-sm); cursor: pointer; transition: transform var(--transition);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Reseñas populares</h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-12">
                            <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky);">
                                <img src="https://picsum.photos/100/100?random=14" alt="Review" style="width: 100px; height: 100px; object-fit: cover; border-radius: var(--border-radius-xs); flex-shrink: 0;">
                                <div style="flex: 1;">
                                    <h4 style="color: var(--text-main); margin-bottom: 8px;">Asunto reseña</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4; margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes Descripción corta de la noticia.</p>
                                    <div style="display: flex; gap: 10px;">
                                        <span style="background: var(--bg-main); padding: 4px 12px; border-radius: var(--border-radius-xs); color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👍 500</span>
                                        <span style="background: var(--bg-main); padding: 4px 12px; border-radius: var(--border-radius-xs); color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👎 50</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky);">
                                <img src="https://picsum.photos/100/100?random=15" alt="Review" style="width: 100px; height: 100px; object-fit: cover; border-radius: var(--border-radius-xs); flex-shrink: 0;">
                                <div style="flex: 1;">
                                    <h4 style="color: var(--text-main); margin-bottom: 8px;">Asunto reseña</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4; margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes Descripción corta de la noticia.</p>
                                    <div style="display: flex; gap: 10px;">
                                        <span style="background: var(--bg-main); padding: 4px 12px; border-radius: var(--border-radius-xs); color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👍 500</span>
                                        <span style="background: var(--bg-main); padding: 4px 12px; border-radius: var(--border-radius-xs); color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👎 50</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SIMILAR GAMES SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Juegos similares</h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6">
                            <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform var(--transition); height: 100%;">
                                <img src="https://picsum.photos/300/180?random=16" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
                                <div style="padding: 12px;">
                                    <h5 style="color: var(--text-main); margin-bottom: 10px;">Juego Similar</h5>
                                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Puzzle</span>
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Clásico</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform var(--transition); height: 100%;">
                                <img src="https://picsum.photos/300/180?random=17" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
                                <div style="padding: 12px;">
                                    <h5 style="color: var(--text-main); margin-bottom: 10px;">Juego Similar</h5>
                                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Puzzle</span>
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Clásico</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform var(--transition); height: 100%;">
                                <img src="https://picsum.photos/300/180?random=18" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
                                <div style="padding: 12px;">
                                    <h5 style="color: var(--text-main); margin-bottom: 10px;">Juego Similar</h5>
                                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Puzzle</span>
                                        <span style="background: var(--bg-main); color: var(--text-secondary); padding: 3px 8px; border-radius: 3px; font-size: 0.75rem;">Clásico</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
include_once("../componentes/footer.php");
?>
    </section>
</main>

