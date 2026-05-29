<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
?>

    <!-- HEADER WITH BANNER -->
    <header class="header-games">
        <h1 class="header-games-title">COMUNIDAD</h1>
    </header>

    <section id="main-content" class="main-content">
        <main id="home">
            <!-- TITLE SECTION -->
            <section class="section-B">
                <div class="card-content container">
                    <h1 style="font-size: 32px; margin: 0 0 30px 0; color: var(--text-main);">Comunidad de [Nombre del juego]</h1>
                </div>
            </section>

            <!-- CATEGORIES TABS -->
            <section class="section-B">
                <div class="card-content container">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px;">
                        <span class="card-tag" style="background: var(--bg-surface); color: var(--text-main); padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: 500; font-size: 13px; border: 1px solid var(--border-sky);">Lo más destacado</span>
                        <span class="card-tag" style="background: var(--bg-surface); color: var(--text-main); padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: 500; font-size: 13px; border: 1px solid var(--border-sky);">Fanarte</span>
                        <span class="card-tag" style="background: var(--bg-surface); color: var(--text-main); padding: 8px 16px; border-radius: 20px; cursor: pointer; font-weight: 500; font-size: 13px; border: 1px solid var(--border-sky);">Eventos de la comunidad</span>
                    </div>
                </div>
            </section>

            <!-- FEATURED CARDS (Horizontal Cards) -->
            <section class="section-B">
                <div class="card-content container">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 30px;">
                        <!-- FEATURED CARD 1 -->
                        <div style="background: var(--bg-surface); padding: 12px; border-radius: 12px; cursor: pointer; display: flex; flex-direction: column; border: 1px solid var(--border-sky);">
                            <div style="width: 100%; height: 120px; background: var(--secondary-hover); border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/120/120?random=1" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <h3 style="margin: 0 0 6px 0; font-size: 14px; font-weight: bold; color: var(--text-main); line-height: 1.3;">Título de hilo, puede que ocupe dos files incluso.</h3>
                            <p style="margin: 0 0 4px 0; font-size: 12px; opacity: 0.85; color: var(--text-muted);">Autor</p>
                            <div style="display: flex; gap: 10px; font-size: 11px; color: var(--text-main); margin-top: 8px;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- FEATURED CARD 2 -->
                        <div style="background: var(--bg-surface); padding: 12px; border-radius: 12px; cursor: pointer; display: flex; flex-direction: column; border: 1px solid var(--border-sky);">
                            <div style="width: 100%; height: 120px; background: var(--secondary-hover); border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/120/120?random=2" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <h3 style="margin: 0 0 6px 0; font-size: 14px; font-weight: bold; color: var(--text-main); line-height: 1.3;">Título de hilo, puede que ocupe dos files incluso.</h3>
                            <p style="margin: 0 0 4px 0; font-size: 12px; opacity: 0.85; color: var(--text-muted);">Autor</p>
                            <div style="display: flex; gap: 10px; font-size: 11px; color: var(--text-main); margin-top: 8px;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- FEATURED CARD 3 -->
                        <div style="background: var(--bg-surface); padding: 12px; border-radius: 12px; cursor: pointer; display: flex; flex-direction: column; border: 1px solid var(--border-sky);">
                            <div style="width: 100%; height: 120px; background: var(--secondary-hover); border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/120/120?random=3" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <h3 style="margin: 0 0 6px 0; font-size: 14px; font-weight: bold; color: var(--text-main); line-height: 1.3;">Título de hilo, puede que ocupe dos files incluso.</h3>
                            <p style="margin: 0 0 4px 0; font-size: 12px; opacity: 0.85; color: var(--text-muted);">Autor</p>
                            <div style="display: flex; gap: 10px; font-size: 11px; color: var(--text-main); margin-top: 8px;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- POSTS HEADER & SEARCH -->
            <section class="section-B">
                <div class="card-content container">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                        <div style="padding: 8px 16px; background: rgba(22, 201, 201, 0.2); border-radius: 20px; border: 1px solid var(--border-sky); color: var(--text-main); font-weight: 500; font-size: 13px;">Posts de la comunidad</div>
                        <div style="flex: 1; min-width: 200px; background: rgba(22, 201, 201, 0.1); padding: 10px 16px; border-radius: 20px; border: 1px solid var(--border-sky); display: flex; align-items: center; gap: 8px;">
                            <i class="bi bi-search" style="color: var(--text-main);"></i>
                            <input type="text" placeholder="Buscar..." style="background: transparent; border: none; outline: none; flex: 1; color: var(--text-main); font-size: 13px;">
                        </div>
                    </div>

                    <!-- SEARCH FILTERS -->
                    <div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
                        <input type="text" class="form-control" placeholder="Nombre, usuario, etiqueta" aria-label="Buscar" style="flex: 1; min-width: 200px; background: var(--bg-secondary); border: 1px solid var(--border-sky); color: var(--text-main); padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                        <input type="text" class="form-control" placeholder="Categoría" aria-label="Categoría" style="min-width: 140px; background: var(--bg-secondary); border: 1px solid var(--border-sky); color: var(--text-main); padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                        <input type="text" class="form-control" placeholder="Plataforma" aria-label="Plataforma" style="min-width: 140px; background: var(--bg-secondary); border: 1px solid var(--border-sky); color: var(--text-main); padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                        <button class="btn btn-dark" style="padding: 8px 20px; font-size: 13px;">Buscar</button>
                    </div>

                    <!-- SORT BY -->
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                        <span style="color: var(--text-main); font-size: 13px; white-space: nowrap;">Ordenar por</span>
                        <select class="form-control select-dark" style="flex: 1; min-width: 150px; background: var(--bg-secondary); border: 1px solid var(--border-sky); color: var(--text-main); padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                            <option value="-recent">Más recientes</option>
                            <option value="recent">Menos recientes</option>
                            <option value="-likes">Más likes</option>
                            <option value="likes">Menos likes</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- COMMUNITY POSTS LIST -->
            <section class="section-B">
                <div class="card-content container">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <!-- COMMUNITY POST CARD 1 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=4" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 2 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=5" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 3 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=6" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 4 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=7" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 5 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=8" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 6 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=9" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 7 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=10" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
                            </div>
                        </div>

                        <!-- COMMUNITY POST CARD 8 -->
                        <div style="background: var(--bg-surface); padding: 14px; border-radius: 10px; cursor: pointer; display: flex; gap: 12px; align-items: center; border: 1px solid var(--border-sky);">
                            <div style="width: 70px; height: 70px; background: var(--secondary-hover); border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <img src="https://picsum.photos/70/70?random=11" alt="Contenido" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div style="flex: 1; color: var(--text-main); min-width: 0;">
                                <h3 style="margin: 0 0 4px 0; font-size: 14px; font-weight: bold; line-height: 1.3;">Título del hilo muy muy muy largo</h3>
                                <p style="margin: 0; font-size: 11px; opacity: 0.85;">Autor • Fecha de publicación: XX</p>
                            </div>
                            <div style="display: flex; gap: 12px; font-size: 11px; color: var(--text-main); flex-shrink: 0; white-space: nowrap;">
                                <span>❤️ Likes</span>
                                <span>💬 Resp</span>
                                <span>⭐ Compartir</span>
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
