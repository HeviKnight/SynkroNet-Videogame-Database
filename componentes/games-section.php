<?php
// Obtener juegos de la base de datos
$games_popular = [];
$games_new = [];

try {
    if (isset($pdo)) {
        // Juegos populares (ordenados por rating_avg DESC)
        $stmt = $pdo->prepare("SELECT id, titulo, imagen_url, rating_avg, descripcion FROM videojuegos WHERE imagen_url IS NOT NULL AND imagen_url != '' ORDER BY rating_avg DESC LIMIT 12");
        $stmt->execute();
        $games_popular = $stmt->fetchAll();
        
        // Juegos nuevos (ordenados por fecha de creación DESC)
        $stmt = $pdo->prepare("SELECT id, titulo, imagen_url, rating_avg, descripcion FROM videojuegos WHERE imagen_url IS NOT NULL AND imagen_url != '' ORDER BY id DESC LIMIT 12");
        $stmt->execute();
        $games_new = $stmt->fetchAll();
    }
} catch (Exception $e) {
    // Error silencioso
}

// Si no hay juegos en la BD, usar datos por defecto
if (empty($games_popular)) {
    $games_popular = [
        ['id' => 1, 'titulo' => 'The Witcher 3', 'imagen_url' => 'https://picsum.photos/300/150?random=1', 'rating_avg' => 4.5, 'descripcion' => 'RPG épico'],
        ['id' => 2, 'titulo' => 'Cyberpunk 2077', 'imagen_url' => 'https://picsum.photos/300/150?random=2', 'rating_avg' => 4.2, 'descripcion' => 'Futurista'],
        ['id' => 3, 'titulo' => 'Elden Ring', 'imagen_url' => 'https://picsum.photos/300/150?random=3', 'rating_avg' => 4.8, 'descripcion' => 'Acción'],
        ['id' => 4, 'titulo' => 'Baldur\'s Gate 3', 'imagen_url' => 'https://picsum.photos/300/150?random=4', 'rating_avg' => 4.7, 'descripcion' => 'RPG'],
    ];
}

if (empty($games_new)) {
    $games_new = $games_popular;
}
?>

<section class="section-A games-module" id="games-section">
    <div class="section-buttons">
        <div>
            <button class="btn btn-dark games-tab active" data-tab="popular">Popular</button>
            <button class="btn btn-dark games-tab" data-tab="nuevo">Nuevo</button>
            <button class="btn btn-dark games-tab" data-tab="destacados">Destacados</button>
        </div>
        <h2 class="section-title" id="games-title">Juegos Populares</h2>
    </div>
    <div class="card-content container">
        <!-- TAB: POPULAR -->
        <div class="games-carousel" id="carousel-popular" style="display: grid;">
            <div class="row g-2">
                <?php foreach ($games_popular as $index => $game): ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card-game">
                            <div>
                                <span><i class="bi bi-box-arrow-up-right"></i></span>
                            </div>
                            <img src="<?= htmlspecialchars($game['imagen_url']) ?>" class="img-fluid" alt="<?= htmlspecialchars($game['titulo']) ?>">
                            <div>
                                <div class="tags">
                                    <?php if ($game['rating_avg'] > 0): ?>
                                        <div class="card-tag"><i class="bi bi-star-fill"></i><?= number_format($game['rating_avg'], 1) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h5><?= htmlspecialchars($game['titulo']) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- TAB: NUEVO -->
        <div class="games-carousel" id="carousel-nuevo" style="display: none;">
            <div class="row g-2">
                <?php foreach ($games_new as $index => $game): ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card-game">
                            <div>
                                <span><i class="bi bi-box-arrow-up-right"></i></span>
                            </div>
                            <img src="<?= htmlspecialchars($game['imagen_url']) ?>" class="img-fluid" alt="<?= htmlspecialchars($game['titulo']) ?>">
                            <div>
                                <div class="tags">
                                    <?php if ($game['rating_avg'] > 0): ?>
                                        <div class="card-tag"><i class="bi bi-star-fill"></i><?= number_format($game['rating_avg'], 1) ?></div>
                                    <?php endif; ?>
                                    <div class="card-tag" style="background: #00CDDB; color: #0a0e27;">Nuevo</div>
                                </div>
                                <div>
                                    <h5><?= htmlspecialchars($game['titulo']) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- TAB: DESTACADOS -->
        <div class="games-carousel" id="carousel-destacados" style="display: none;">
            <div class="row g-2">
                <?php foreach (array_slice($games_popular, 0, 8) as $index => $game): ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card-game">
                            <div>
                                <span><i class="bi bi-box-arrow-up-right"></i></span>
                            </div>
                            <img src="<?= htmlspecialchars($game['imagen_url']) ?>" class="img-fluid" alt="<?= htmlspecialchars($game['titulo']) ?>">
                            <div>
                                <div class="tags">
                                    <?php if ($game['rating_avg'] > 0): ?>
                                        <div class="card-tag"><i class="bi bi-star-fill"></i><?= number_format($game['rating_avg'], 1) ?></div>
                                    <?php endif; ?>
                                    <div class="card-tag" style="background: #A4F0F5;">⭐ Destacado</div>
                                </div>
                                <div>
                                    <h5><?= htmlspecialchars($game['titulo']) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="section-footer">
        <div class="section-dots">
            <button class="dot active" data-carousel="popular"></button>
            <button class="dot" data-carousel="nuevo"></button>
            <button class="dot" data-carousel="destacados"></button>
        </div>
        <button class="btn btn-dark">Ver más juegos</button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.games-tab');
    const carousels = document.querySelectorAll('.games-carousel');
    const dots = document.querySelectorAll('.section-dots .dot');
    const titleEl = document.getElementById('games-title');
    const titles = {
        popular: 'Juegos Populares',
        nuevo: 'Juegos Nuevos',
        destacados: 'Juegos Destacados'
    };

    function showTab(tabName) {
        // Ocultar todos
        carousels.forEach(c => c.style.display = 'none');
        tabs.forEach(t => t.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));

        // Mostrar seleccionado
        const carousel = document.getElementById(`carousel-${tabName}`);
        if (carousel) carousel.style.display = 'grid';
        
        tabs.forEach(t => {
            if (t.dataset.tab === tabName) t.classList.add('active');
        });
        
        dots.forEach(d => {
            if (d.dataset.carousel === tabName) d.classList.add('active');
        });

        titleEl.textContent = titles[tabName] || 'Juegos';
    }

    // Event listeners en botones
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            showTab(tab.dataset.tab);
        });
    });

    // Event listeners en dots
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            showTab(dot.dataset.carousel);
        });
    });
});
</script>
