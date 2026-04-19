<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
?>

<main id="home">
    <section id="main-content" class="main-content">
        
        <!-- HERO SECTION WITH GAME IMAGE -->
        <section style="position: relative; margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
            <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                <img src="https://via.placeholder.com/1200x400?text=TETRIS" alt="TETRIS" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            
            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 40px; color: white;">
                <h1 style="font-size: 3em; font-weight: bold; margin: 0;">TETRIS</h1>
                <div style="display: flex; gap: 15px; margin-top: 15px; flex-wrap: wrap;">
                    <button class="btn btn-dark" style="padding: 10px 20px;">Editar ficha</button>
                    <button class="btn btn-dark" style="padding: 10px 20px;">Créditos</button>
                    <button class="btn btn-primary" style="padding: 10px 20px;">Top 100 games</button>
                </div>
            </div>
        </section>

        <!-- INFORMATION TABS SECTION -->
        <section class="section-B">
            <div class="card-content">
                <div style="display: flex; gap: 15px; border-bottom: 2px solid var(--border-sky); margin-bottom: 20px; overflow-x: auto; padding-bottom: 10px;">
                    <button class="btn btn-sm btn-primary" style="white-space: nowrap;">Información</button>
                    <button class="btn btn-sm btn-dark" style="white-space: nowrap;">Ficha técnica</button>
                    <button class="btn btn-sm btn-dark" style="white-space: nowrap;">DLCs</button>
                    <button class="btn btn-sm btn-dark" style="white-space: nowrap;">Requisitos</button>
                    <button class="btn btn-sm btn-dark" style="white-space: nowrap;">Lanzamientos</button>
                </div>

                <!-- DESCRIPTION -->
                <div style="margin-bottom: 30px;">
                    <h3 style="color: var(--text-main); margin-bottom: 15px; font-size: 1.3rem;">Descripción</h3>
                    <p style="color: var(--text-secondary); line-height: 1.7; font-size: 1rem;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                </div>

                <!-- PLATFORMS -->
                <div style="display: flex; gap: 30px; align-items: center;">
                    <div>
                        <p style="color: var(--text-secondary); margin-bottom: 8px; font-weight: bold;">Plataformas:</p>
                        <div style="display: flex; gap: 15px;">
                            <span class="os-icon"><i class="bi bi-windows"></i></span>
                            <span class="os-icon"><i class="bi bi-apple"></i></span>
                            <span class="os-icon"><i class="bi bi-joystick"></i></span>
                            <span class="os-icon"><i class="bi bi-playstation"></i></span>
                            <span class="os-icon"><i class="bi bi-xbox"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DEV BLOGS SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <h2 class="section-title">Dev Blogs (15)</h2>
                    <button class="btn btn-dark">+ Añadir Develog</button>
                </div>
            </div>

            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-sky);">
                            <img src="https://via.placeholder.com/400x200?text=Dev+Blog+1" alt="Dev Blog" style="width: 100%; height: 200px; object-fit: cover;">
                            <div style="padding: 15px;">
                                <h4 style="color: var(--text-main); margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes</h4>
                                <p style="color: var(--text-secondary); font-size: 0.9rem;">500 $</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-sky);">
                            <img src="https://via.placeholder.com/400x200?text=Dev+Blog+2" alt="Dev Blog" style="width: 100%; height: 200px; object-fit: cover;">
                            <div style="padding: 15px;">
                                <h4 style="color: var(--text-main); margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes</h4>
                                <p style="color: var(--text-secondary); font-size: 0.9rem;">500 $</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMMUNITY SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Comunidad - Hilos destacando</h2>
            </div>

            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                            <img src="https://via.placeholder.com/50x50?text=User" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                            <img src="https://via.placeholder.com/50x50?text=User" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                            <img src="https://via.placeholder.com/50x50?text=User" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky); display: flex; gap: 12px;">
                            <img src="https://via.placeholder.com/50x50?text=User" alt="User" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div>
                                <p style="color: var(--text-main); font-weight: bold; margin-bottom: 2px;">Título de la noticia que es muy largo porque los títulos son importantes</p>
                                <p style="color: var(--text-secondary); font-size: 0.85rem;">Descripción corta de la noticia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-footer">
                <button class="btn btn-dark">Ir a comunidad</button>
            </div>
        </section>

        <!-- GALLERY SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <h2 class="section-title">Galería</h2>
                    <button class="btn btn-dark">Expandir ▼</button>
                </div>
            </div>

            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+1" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+2" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+3" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+4" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+5" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <img src="https://via.placeholder.com/300x200?text=Gallery+6" alt="Gallery" style="width: 100%; border-radius: 8px; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </div>
            </div>
        </section>

        <!-- REVIEWS SECTION -->
        <section class="section-B">
            <div class="section-buttons">
                <h2 class="section-title">Reseñas populares</h2>
            </div>

            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-12">
                        <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky);">
                            <img src="https://via.placeholder.com/100x100?text=Review" alt="Review" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                            <div style="flex: 1;">
                                <h4 style="color: var(--text-main); margin-bottom: 8px;">Asunto reseña</h4>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4; margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes Descripción corta de la noticia.</p>
                                <div style="display: flex; gap: 10px;">
                                    <span style="background: var(--bg-main); padding: 4px 12px; border-radius: 4px; color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👍 500</span>
                                    <span style="background: var(--bg-main); padding: 4px 12px; border-radius: 4px; color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👎 50</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="display: flex; gap: 15px; background: var(--card-bg); padding: 15px; border-radius: 8px; border: 1px solid var(--border-sky);">
                            <img src="https://via.placeholder.com/100x100?text=Review" alt="Review" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; flex-shrink: 0;">
                            <div style="flex: 1;">
                                <h4 style="color: var(--text-main); margin-bottom: 8px;">Asunto reseña</h4>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.4; margin-bottom: 10px;">Título de la noticia que es muy largo porque los títulos son importantes Descripción corta de la noticia.</p>
                                <div style="display: flex; gap: 10px;">
                                    <span style="background: var(--bg-main); padding: 4px 12px; border-radius: 4px; color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👍 500</span>
                                    <span style="background: var(--bg-main); padding: 4px 12px; border-radius: 4px; color: var(--text-secondary); font-size: 0.85rem; cursor: pointer;">👎 50</span>
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

            <div class="card-content container">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <div style="background: var(--card-bg); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform 0.2s; height: 100%;">
                            <img src="https://via.placeholder.com/300x180?text=Game+Similar+1" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
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
                        <div style="background: var(--card-bg); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform 0.2s; height: 100%;">
                            <img src="https://via.placeholder.com/300x180?text=Game+Similar+2" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
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
                        <div style="background: var(--card-bg); border-radius: 8px; overflow: hidden; border: 1px solid var(--border-sky); cursor: pointer; transition: transform 0.2s; height: 100%;">
                            <img src="https://via.placeholder.com/300x180?text=Game+Similar+3" alt="Game" style="width: 100%; height: 180px; object-fit: cover;">
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
        </section>

    </section>
</main>

<?php
include_once("../componentes/footer.php");
?>
