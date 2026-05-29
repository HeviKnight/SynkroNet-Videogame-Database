<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');

// Procesar datos del desarrollador enviados por POST
$devData = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['developer_data'])) {
    $devData = json_decode($_POST['developer_data'], true);
}

// Valores por defecto
$devName = $devData['name'] ?? 'Developer Studio';
$devImage = $devData['image_background'] ?? 'https://picsum.photos/600/300?random=1';
$devCover = $devData['image'] ?? 'https://picsum.photos/225/300?random=1';
$devRole = $devData['role'] ?? 'Game Developer';
$devCompany = $devData['company'] ?? 'Independent';
$devBio = $devData['biography'] ?? 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.';
$devGames = $devData['games'] ?? [];

// Construir string de posiciones
$positionsStr = '';
if (is_array($devData['positions'] ?? []) && count($devData['positions']) > 0) {
    $positionNames = array_map(function($p) { 
        return is_array($p) ? ($p['name'] ?? '') : (is_object($p) ? ($p->name ?? '') : ''); 
    }, $devData['positions']);
    $positionsStr = implode(', ', array_filter($positionNames));
}
?>
    <script>
        window.DEV_FILE_URL = './dev-file.php';
    </script>

    <main id="home">
    <section id="main-content" class="main-content">
        
        <!-- HERO SECTION -->
        <section class="section-hero-gamefile">
            <div style="background-image: url('<?php echo htmlspecialchars($devImage); ?>');">
                <img src="<?php echo htmlspecialchars($devCover); ?>" alt="<?php echo htmlspecialchars($devName); ?> Profile">
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
                            Desarrollador destacado
                        </h4>
                    </div>
                </div>
            </div>
            <div>
                <h2><?php echo htmlspecialchars($devName); ?></h2>
                <p><?php echo htmlspecialchars($devRole); ?> • <?php echo htmlspecialchars($devCompany); ?></p>
            </div>
        </section>

        <!-- INFORMATION TABS SECTION -->
        <section class="section-info">
            <div class="buttons-set">
                <button class="btn-half-corner">Información</button>
                <button class="btn-half-corner">Datos personales</button>
                <button class="btn-half-corner">Etiquetas</button>
            </div>

            <div class="data">
                <div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="background-color: var(--base-gray-alpha); padding: 16px; border-radius: var(--border-radius); color: var(--text-main);">
                            <span style="font-weight: 600;">Rol:</span>
                            <p style="margin: 8px 0 0 0;"><?php echo htmlspecialchars($devRole); ?></p>
                        </div>
                        <div style="background-color: var(--base-gray-alpha); padding: 16px; border-radius: var(--border-radius); color: var(--text-main);">
                            <span style="font-weight: 600;">Empresa:</span>
                            <p style="margin: 8px 0 0 0;"><?php echo htmlspecialchars($devCompany); ?></p>
                        </div>
                        <?php if (!empty($positionsStr)): ?>
                        <div style="background-color: var(--base-gray-alpha); padding: 16px; border-radius: var(--border-radius); color: var(--text-main);">
                            <span style="font-weight: 600;">Posiciones:</span>
                            <p style="margin: 8px 0 0 0;"><?php echo htmlspecialchars($positionsStr); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <a href="#" class="btn btn-primary" style="width: 100%; margin-top: 12px;">Seguir desarrollador</a>
                    <a href="#" class="btn btn-primary" style="width: 100%; margin-top: 8px;">Comunidad</a>
                </div>
                <div>
                    <h3>Biografía</h3>
                    <p><?php echo htmlspecialchars($devBio); ?></p>
                    <div style="display: flex; gap: 12px; margin-top: 16px;">
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-globe"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-twitter"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-instagram"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-youtube"></i></a>
                        <a href="#" style="color: var(--text-main); font-size: 1.5rem; transition: all var(--transition);"><i class="bi bi-discord"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- TIMELINE SECTION - LANZAMIENTOS -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Lanzamientos <?php echo count($devGames); ?></h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div style="position: relative; padding: 20px 0; display: flex; flex-direction: column; gap: 30px;">
                        <?php if (!empty($devGames)): ?>
                            <?php foreach (array_slice($devGames, 0, 6) as $index => $game): ?>
                                <?php 
                                    $gameTitle = is_array($game) ? ($game['name'] ?? 'Unknown') : (is_object($game) ? ($game->name ?? 'Unknown') : 'Unknown');
                                    $gameImage = is_array($game) ? ($game['background_image'] ?? '') : (is_object($game) ? ($game->background_image ?? '') : '');
                                    $gameYear = is_array($game) ? ($game['released'] ?? 'N/A') : (is_object($game) ? ($game->released ?? 'N/A') : 'N/A');
                                ?>
                                <div style="display: flex; align-items: center; gap: 20px;">
                                    <?php if ($index % 2 === 0): ?>
                                        <div style="flex: 1; text-align: right;">
                                            <h4 style="color: var(--text-main); margin-bottom: 8px;"><?php echo htmlspecialchars($gameTitle); ?></h4>
                                            <p style="color: var(--text-muted);"><?php echo htmlspecialchars($gameYear); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div style="width: 50px; height: 50px; border-radius: var(--border-radius-full); background: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="bi bi-star-fill" style="color: white; font-size: 1.5rem;"></i>
                                    </div>
                                    <?php if ($index % 2 === 1): ?>
                                        <div style="flex: 1;">
                                            <h4 style="color: var(--text-main); margin-bottom: 8px;"><?php echo htmlspecialchars($gameTitle); ?></h4>
                                            <p style="color: var(--text-muted);"><?php echo htmlspecialchars($gameYear); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="text-align: center; color: var(--text-muted);">No hay lanzamientos registrados</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- GAMES SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Juegos publicados (<?php echo count($devGames); ?>)</h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <?php if (!empty($devGames)): ?>
                            <?php foreach (array_slice($devGames, 0, 6) as $game): ?>
                                <?php 
                                    $gameTitle = is_array($game) ? ($game['name'] ?? 'Unknown') : (is_object($game) ? ($game->name ?? 'Unknown') : 'Unknown');
                                    $gameImage = is_array($game) ? ($game['background_image'] ?? 'https://picsum.photos/300/180?random=1') : (is_object($game) ? ($game->background_image ?? 'https://picsum.photos/300/180?random=1') : 'https://picsum.photos/300/180?random=1');
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div style="background: var(--card-bg); border-radius: var(--border-radius-sm); overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform var(--transition); height: 100%;">
                                        <img src="<?php echo htmlspecialchars($gameImage); ?>" alt="<?php echo htmlspecialchars($gameTitle); ?>" style="width: 100%; height: 180px; object-fit: cover;">
                                        <div style="padding: 12px;">
                                            <h5 style="color: var(--text-main); margin-bottom: 10px;"><?php echo htmlspecialchars($gameTitle); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="text-align: center; color: var(--text-muted); grid-column: 1 / -1;">No hay juegos registrados</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- AWARDS SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Reconocimientos</h2>
            </div>

            <div class="card-content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-12">
                            <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky);">
                                <i class="bi bi-award" style="font-size: 2rem; color: var(--primary); flex-shrink: 0;"></i>
                                <div style="flex: 1;">
                                    <h4 style="color: var(--text-main); margin-bottom: 8px;">Mejor Estudio Independiente</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0;">The Game Awards 2023</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: var(--border-radius-sm); border: 1px solid var(--border-sky);">
                                <i class="bi bi-award" style="font-size: 2rem; color: var(--primary); flex-shrink: 0;"></i>
                                <div style="flex: 1;">
                                    <h4 style="color: var(--text-main); margin-bottom: 8px;">Innovación en Gameplay</h4>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0;">GDC Awards 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<?php
include_once("../componentes/footer.php");
?>
    </section>
</main>
