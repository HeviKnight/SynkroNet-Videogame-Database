<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SynkroNET - Plataforma de Videojuegos</title>
    <meta name="description" content="SynkroNET - Tu plataforma de videojuegos favorita" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/styles.css" />
</head>

<body>
    <header id="sidebar">
        <button id="collapse-sidebar" class="btn-collapse-sidebar" title="Colapsar/Expandir">
            <i class="bi bi-chevron-left"></i>
        </button>
        
        <div>
            <a href="<?php echo $base_url; ?>/index.php" class="sidebar-logo">
                <svg id="Logo" data-name="Logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160">
                    <g id="Logo">
                        <g id="Vector">
                        <circle cx="80" cy="80" r="16"/>
                        <path d="M64,80c-7.6,0-36.86,0-53.48,6.86-3.67,1.51-8.04.16-9.74-3.42-.5-1.04-.77-2.21-.77-3.44s.28-2.39.77-3.44c1.71-3.58,6.07-4.94,9.74-3.42,16.62,6.86,45.89,6.86,53.49,6.86Z"/>
                        <path d="M96,80c7.6,0,36.86,0,53.49-6.86,3.67-1.51,8.04-.16,9.74,3.42.5,1.04.77,2.21.77,3.44s-.28,2.39-.77,3.44c-1.71,3.58-6.07,4.94-9.74,3.42-16.62-6.86-45.89-6.86-53.49-6.86Z"/>
                        <path d="M80,96c0,7.6,0,36.86,6.86,53.49,1.51,3.67.16,8.04-3.42,9.74-1.04.5-2.21.77-3.44.77s-2.39-.28-3.44-.77c-3.58-1.71-4.94-6.07-3.42-9.74,6.86-16.62,6.86-45.89,6.86-53.49Z"/>
                        <path d="M80,64c0-7.6,0-36.86-6.86-53.49-1.51-3.67-.16-8.04,3.42-9.74,1.04-.5,2.21-.77,3.44-.77s2.39.28,3.44.77c3.58,1.71,4.94,6.07,3.42,9.74-6.86,16.62-6.86,45.89-6.86,53.49Z"/>
                        <path d="M125.09,48.92c3.91,4.75,7.43,9.87,10.6,15.32-.38-7.1-3.11-14.13-7.37-20.24-.55-.79-.67-1.79-.35-2.7.1-.28.19-.56.26-.84,1.23-4.62,2.59-10.96,7.53-16.21-4.96,5.28-11.24,6.73-15.83,8.01-.25.07-.49.15-.74.23-.92.32-1.92.21-2.72-.35-6.1-4.27-13.11-7-20.24-7.34,4.29,2.54,8.25,5.09,11.97,7.91,1.14.86,2.24,1.74,3.33,2.65s1.37,2.52.6,3.74c-4.03,6.38-16.11,25.36-20.18,29.43,4.07-4.07,23.02-16.15,29.42-20.18,1.21-.76,2.81-.53,3.72.58Z"/>
                        <path d="M48.68,35.15c4.75-3.91,9.87-7.43,15.32-10.6-7.1.38-14.13,3.11-20.24,7.37-.79.55-1.79.67-2.7.35-.28-.1-.56-.19-.84-.26-4.62-1.23-10.96-2.59-16.21-7.53,5.28,4.96,6.73,11.24,8.01,15.83.07.25.15.49.23.74.32.92.21,1.92-.35,2.72-4.27,6.1-7,13.11-7.34,20.24,2.54-4.29,5.09-8.25,7.91-11.97.86-1.14,1.74-2.24,2.65-3.33s2.52-1.37,3.74-.6c6.38,4.03,25.36,16.11,29.43,20.18-4.07-4.07-16.15-23.02-20.18-29.42-.76-1.21-.53-2.81.58-3.72Z"/>
                        <path d="M34.67,111.32c-3.91-4.75-7.43-9.87-10.6-15.32.38,7.1,3.11,14.13,7.37,20.24.55.79.67,1.79.35,2.7-.1.28-.19.56-.26.84-1.23,4.62-2.59,10.96-7.53,16.21,4.96-5.28,11.24-6.73,15.83-8.01.25-.07.49-.15.74-.23.92-.32,1.92-.21,2.72.35,6.1,4.27,13.11,7,20.24,7.34-4.29-2.54-8.25-5.09-11.97-7.91-1.14-.86-2.24-1.74-3.33-2.65s-1.37-2.52-.6-3.74c4.03-6.38,16.11-25.36,20.18-29.43-4.07,4.07-23.02,16.15-29.42,20.18-1.21.76-2.81.53-3.72-.58Z"/>
                        <path d="M111.08,125.09c-4.75,3.91-9.87,7.43-15.32,10.6,7.1-.38,14.13-3.11,20.24-7.37.79-.55,1.79-.67,2.7-.35.28.1.56.19.84.26,4.62,1.23,10.96,2.59,16.21,7.53-5.28-4.96-6.73-11.24-8.01-15.83-.07-.25-.15-.49-.23-.74-.32-.92-.21-1.92.35-2.72,4.27-6.1,7-13.11,7.34-20.24-2.54,4.29-5.09,8.25-7.91,11.97-.86,1.14-1.74,2.24-2.65,3.33s-2.52,1.37-3.74.6c-6.38-4.03-25.36-16.11-29.43-20.18,4.07,4.07,16.15,23.02,20.18,29.42.76,1.21.53,2.81-.58,3.72Z"/>
                        </g>
                    </g>
                </svg>
                <span class="logo-text">Synkro<span>NET</span></span>
            </a>
        </div>

        <nav>
            <a href="<?php echo $base_url; ?>/index.php" class="sidebar-item" data-page="inicio">
                <i class="bi bi-house-fill"></i>
                <span>Inicio</span>
            </a>
            <a href="<?php echo $base_url; ?>/paginas/videojuegos.php" class="sidebar-item" data-page="videojuegos">
                <i class="bi bi-controller"></i>
                <span>Videojuegos</span>
            </a>
            <a href="<?php echo $base_url; ?>/paginas/desarrolladores.php" class="sidebar-item" data-page="desarrolladores">
                <i class="bi bi-arrow-up-right"></i>
                <span>Desarrolladores</span>
            </a>
            <a href="<?php echo $base_url; ?>/paginas/comunidad.php" class="sidebar-item" data-page="comunidad">
                <i class="bi bi-people-fill"></i>
                <span>Comunidad</span>
            </a>
            <a href="<?php echo $base_url; ?>/paginas/noticias.php" class="sidebar-item" data-page="noticias">
                <i class="bi bi-calendar-event"></i>
                <span>Noticias</span>
            </a>
            <a href="<?php echo $base_url; ?>/paginas/contribuir.php" class="sidebar-item" data-page="contribuir">
                <i class="bi bi-newspaper"></i>
                <span>Contribuir</span>
            </a>
        </nav>

        <div class="sidebar-search">
            <div>
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" placeholder="Buscar...">
            </div>
            <div>
                <select name="sidebar-dropdown" id="sidebar-dropdown">
                    <option value="Spanish">Español</option>
                    <option value="English">English</option>
                    <option value="Japanese">日本人</option>
                </select>
            </div>
        </div>

        <div class="sidebar-footer">
            <!-- ESTADO: NO AUTENTICADO (visible por defecto) -->
            <div class="sidebar-footer-guest" id="footerGuest">
                <a href="#" class="btn btn-dark" id="btnLogin" title="Iniciar Sesión">
                    Iniciar Sesión
                </a>
                <a href="#" class="btn btn-primary" title="Registrarse">
                    Registrarse
                </a>
            </div>

            <!-- ESTADO: AUTENTICADO (oculto por defecto) -->
            <div class="sidebar-footer-auth" id="footerAuth" style="display: none;">
                <div>
                    <span>Nivel XX </span>
                    <span>· XP: ----/----</span>
                    <div class="progress_bar">
                        <div></div>
                    </div>
                </div>
                <div class="user-profile" id="btnLogout">
                    <img src="https://ui-avatars.com/api/?name=Usuario&background=00CDDB&color=fff" alt="Avatar" class="user-avatar">
                    <p>Nicolás</p>
                    <a href="#" title="Ajustes">
                        <i class="bi bi-gear-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Overlay para cerrar sidebar en mobile -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>
    
    <!-- Módulo Sidebar - Consolidado (replaza sidebar-toggle.js y script.js sidebar logic) -->
    <script src="<?php echo $base_url; ?>/js/sidebar.js"></script>