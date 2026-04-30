<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
?>

<main id="home">
    <section id="main-content" class="main-content">
        
        <!-- HERO SECTION -->
        <section class="section-hero-gamefile">
            <div>
                <img src="https://picsum.photos/300/400?random=1" alt="TETRIS Cover">
                <div class="info">
                    <img src="https://picsum.photos/600/300?random=1" alt="TETRIS Cover">
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
                <h2>Tetris</h2>
                <p>Alekséi Pázhitnov</p>
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
                        <span>8.75 [250 Reviews]</span>
                        <span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                    </div>
                    <p>Fecha de Lanzamiento: 10/11/2012</p>
                    <p>Estado del juego: Publicado</p>
                    <p>Añadido a 1000 colecciones</p>
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
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit atque sapiente corporis? Incidunt nam aspernatur hic enim sed aliquid explicabo suscipit saepe dignissimos dolorum et vero, fugit omnis, debitis inventore voluptas, eius nemo nesciunt dolore? Quas, itaque tenetur architecto rem perferendis dignissimos commodi provident pariatur earum, dolore aspernatur ducimus. Eveniet!</p>
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

        <!-- REVIEWS SECTION -->
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

    </section>
</main>

<?php
include_once("../componentes/footer.php");
?>
