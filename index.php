<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
include_once("componentes/sidebar.php");
?>

<!-- Menu hamburguesa movil -->
<button id="toggle-sidebar" class="btn-toggle-sidebar" title="Abrir menú">
    <i class="bi bi-list"></i>
</button>

<!-- Header móvil - Solo visible en dispositivos móviles -->
<div class="mobile-nav-header"></div>

    <main id="home">
        <section id="main-content" class="main-content">
            <section class="section-hero" id="hero-section">
                <div class="hero-image-wrapper">
                    <img src="https://picsum.photos/1000/" alt="Minecraft">
                </div>
                
                <div class="hero-content">
                    <div>
                        <h1>Minecraft</h1>
                        <p>Minecraft es un videojuego de construcción de tipo «mundo abierto» creado originalmente por Markus Persson.</p>
                    </div>
                    
                    <div class="hero-tags-group">
                        <div class="hero-tags">
                            <span class="card-tag">Sandbox</span>
                            <span class="card-tag">Aventura</span>
                            <span class="card-tag">Supervivencia</span>
                            <span class="card-tag">Multijugador</span>
                        </div>

                        <div class="hero-platforms-icons">
                            <a href="#" title="Steam" class="platform-icon">
                                <i class="bi bi-steam"></i>
                            </a>
                            <a href="#" title="Epic Games" class="platform-icon">
                                <i class="bi bi-joystick"></i>
                            </a>
                            <a href="#" title="GOG" class="platform-icon">
                                <i class="bi bi-globe"></i>
                            </a>
                        </div>

                        <div class="hero-os-icons">
                            <span class="os-icon" title="Windows">
                                <i class="bi bi-windows"></i>
                            </span>
                            <span class="os-icon" title="macOS">
                                <i class="bi bi-apple"></i>
                            </span>
                            <span class="os-icon" title="Linux">
                                <i class="bi bi-ubuntu"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="hero-actions">
                        <button class="btn btn-primary">Quizz diario</button>
                        <button class="btn btn-dark">
                            Ficha del juego <i class="bi bi-box-arrow-up-right"></i>
                        </button>
                    </div>
                </div>
            </section>

            <section class="section-A games-module" id="games-section">
                <div class="section-buttons">
                    <div>
                        <button class="btn btn-dark active">Popular</button>
                        <button class="btn btn-dark">Nuevo</button>
                        <button class="btn btn-dark">Destacados</button>
                    </div>
                    <h2 class="section-title">Juegos de la semana</h2>
                </div>
                <div class="card-content container">
                    <!-- ═══════════════════════════════════════════════════
                         ► JUEGOS DE LA SEMANA
                         ═════════════════════════════════════════════════ -->
                    <!-- Contenido a completar en js -->
                    <div class="row g-2">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card-game">
                            <div>
                                <span><i class="bi bi-box-arrow-up-right"></i></span>
                            </div>
                            <img src="https://picsum.photos/300/150" class="img-fluid" alt="Game">
                            <div>
                                <div class="tags">
                                    <div class="card-tag"><i class="bi bi-star-fill"></i>8</span> </div>
                                    <div class="card-tag">Indie</div>
                                    <div class="card-tag">Cooperativo</div>
                                    <div class="card-tag">Aventura</div>
                                </div>
                                <div>
                                    <img src="https://picsum.photos/200/?random=3" alt="Studio">
                                    <h5>Título Videojuego very largo and truncated in a very human way
                                    </h5>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-footer">
                    <div class="section-dots">
                        <button class="dot active" data-tab="0"></button>
                        <button class="dot" data-tab="1"></button>
                        <button class="dot" data-tab="2"></button>
                    </div>
                    <button class="btn btn-dark">Ver más destacados</button>
                </div>
            </section>

            <section class="section-A devs-module" id="developers-section">
                <div class="section-buttons">
                    <div>
                        <button class="btn btn-dark active">Devs</button>
                        <button class="btn btn-dark">Estudios</button>
                        <button class="btn btn-dark">Creadores de contenido</button>
                    </div>
                    <h2 class="section-title">Desarrolladores de la semana</h2>
                </div>

                <div class="card-content container">
                    <!-- ═══════════════════════════════════════════════════
                         ► DESARROLLADORES DE LA SEMANA
                         ═════════════════════════════════════════════════ -->
                    <div class="row g-2">
                        <div class="col-lg-2 col-sm-4">
                            <div class="card-dev">
                            <div>
                                <span><i class="bi bi-box-arrow-up-right"></i></span>
                            </div>
                            <img src="https://picsum.photos/150/200" class="img-fluid" alt="Game">
                            <div>
                                <div>
                                    <Span>Featured Game</Span>
                                </div>
                                <div>
                                    <h5>Título Videojuego very largo and truncated in a very human way
                                    </h5>
                                    <p>Job</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="section-footer">
                    <div class="section-dots">
                        <button class="dot active" data-tab="0"></button>
                        <button class="dot" data-tab="1"></button>
                        <button class="dot" data-tab="2"></button>
                    </div>
                    <button class="btn btn-dark">Ver más desarrolladores</button>
                </div>
            </section>

            <section class="section-B" id="releases-section">
                <div class="section-buttons">
                        <h2 class="section-title">Próximos lanzamientos</h2>
                </div>

                <div class="card-content container">
                    <!-- ═══════════════════════════════════════════════════
                         ► PRÓXIMOS LANZAMIENTOS
                         ═════════════════════════════════════════════════ -->
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="card-upcoming">
                                <img src="https://picsum.photos/400/160?random=14" alt="Dark Kingdoms: Rise of the Fallen">
                                <div>
                                    <span>09/12/2025</span>
                                    <div>
                                        <div>
                                            <span>20</span>
                                            <span>Days</span>
                                        </div>
                                        <div>
                                            <span>05</span>
                                            <span>Hours</span>
                                        </div>
                                        <div>
                                            <span>35</span>
                                            <span>Minutes</span>
                                        </div>
                                    </div>
                                    <p>Dark Kingdoms: Rise of the Fallen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-footer">
                    <div class="section-dots">
                        <button class="dot active" data-tab="0"></button>
                        <button class="dot" data-tab="1"></button>
                        <button class="dot" data-tab="2"></button>
                    </div>
                    <button class="btn btn-dark">Ver más lanzamientos</button>
                </div>
            </section>

            <section class="section-B" id="news-section">
                <div class="section-buttons">
                    <div>
                        <h2 class="section-title">Noticias</h2>
                    </div>
                </div>

                <div class="card-content container">
                    <!-- ═══════════════════════════════════════════════════
                         ► NOTICIAS
                         ═════════════════════════════════════════════════ -->
                    <div class="row g-4">
                        
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="news-card">
                                <div>
                                    <h4>Título de la noticia con un texto muy largo para ver el truncado Título de la noticia con un texto muy largo para ver el truncado</h4>
                                    <div>
                                        <span class="card-tag-inverse">Indie</span>
                                        <span class="card-tag-inverse">GameAwards</span>
                                        <span class="card-tag-inverse">2025</span>
                                    </div>
                                    <p>Tiempo de lectura: 5 min · Redacción</p>
                                </div>
                                <img src="https://picsum.photos/400/400?random=18" alt="Noticia">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="section-footer">
                    <div class="section-dots">
                        <button class="dot active" data-tab="0"></button>
                        <button class="dot" data-tab="1"></button>
                        <button class="dot" data-tab="2"></button>
                    </div>
                    <button class="btn btn-dark">Ver más noticias</button>
                </div>
            </section>

            <section class="section-B" id="community-section">
                <div class="section-buttons">
                    <div>
                        <h2 class="section-title">Comunidad</h2>
                    </div>
                </div>

                <div class="card-content container">
                    <!-- ═══════════════════════════════════════════════════
                         ► COMUNIDAD
                         ═════════════════════════════════════════════════ -->
                    <div class="row g-3">
                        
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="community-card">
                                <a href="#">
                                    <h4>Hilos populares</h4>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <div>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...La nueva salida d..La nueva salida d..</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <span>R</span>
                                        <div>
                                            <p>Riot Games</p>
                                            <p>La nueva salida d...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="section-footer">
                    <div class="section-dots">
                        <button class="dot active" data-tab="0"></button>
                        <button class="dot" data-tab="1"></button>
                        <button class="dot" data-tab="2"></button>
                    </div>
                    <button class="btn btn-dark">Explorar comunidad</button>
                </div>
            </section>


<?php
include_once("componentes/footer.php");
?>