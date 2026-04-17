const SidebarModule = (() => {
    // ============================================
    // PRIVADO - Caché de elementos DOM
    // ============================================
    const cache = {
        sidebar: null,
        sidebarItems: null,
        toggleSidebarBtn: null,
        collapseSidebarBtn: null,
        mainContent: null,
        headerGames: null,
        btnLogin: null,
        btnLogout: null,
        footerGuest: null,
        footerAuth: null,
        sidebarOverlay: null,
        sidebarSearch: null,
        mediaQuery: null,
        initialized: false
    };

    /**
     * Inicializa caché de elementos DOM
     * Se ejecuta una sola vez para mejor performance
     */
    const initCache = () => {
        cache.sidebar = document.getElementById('sidebar');
        cache.sidebarItems = document.querySelectorAll('.sidebar-item');
        cache.toggleSidebarBtn = document.getElementById('toggle-sidebar');
        cache.collapseSidebarBtn = document.getElementById('collapse-sidebar');
        cache.mainContent = document.getElementById('main-content');
        cache.headerGames = document.querySelector('.header-games');
        cache.btnLogin = document.getElementById('btnLogin');
        cache.btnLogout = document.getElementById('btnLogout');
        cache.footerGuest = document.getElementById('footerGuest');
        cache.footerAuth = document.getElementById('footerAuth');
        cache.sidebarOverlay = document.getElementById('sidebar-overlay');
        cache.sidebarSearch = document.querySelector('.sidebar-search');
        cache.mediaQuery = window.matchMedia('(min-width: 769px)');
    };

    // ============================================
    // NAVEGACIÓN - Detección de página activa
    // ============================================

    /**
     * Establece la página activa basada en la URL actual
     * Usa data-page attribute para comparación exacta
     * @returns {void}
     */
    const setActivePage = () => {
        const currentPath = window.location.pathname;
        
        cache.sidebarItems.forEach((item) => {
            const href = item.getAttribute('href');
            if (!href) return;

            // Comparación mejorada: verificar coincidencia exacta
            const isActive = currentPath.includes(href) && 
                           (href === currentPath || href === currentPath.replace(/\/$/, ''));

            if (isActive) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    };

    // ============================================
    // SIDEBAR TOGGLE - Desktop (Collapse)
    // ============================================

    /**
     * Configura el evento de collapse/expand en desktop
     * @returns {void}
     */
    const setupCollapseBtnListener = () => {
        if (!cache.collapseSidebarBtn) return;

        cache.collapseSidebarBtn.addEventListener('click', () => {
            cache.sidebar.classList.toggle('collapsed');
            cache.mainContent.classList.toggle('sidebar-collapsed');
            if (cache.headerGames) {
                cache.headerGames.classList.toggle('sidebar-collapsed');
            }
        });
    };

    // ============================================
    // SIDEBAR TOGGLE - Mobile
    // ============================================

    /**
     * Configura el evento de toggle en dispositivos móviles
     * @returns {void}
     */
    const setupToggleBtnListener = () => {
        if (!cache.toggleSidebarBtn) return;

        cache.toggleSidebarBtn.addEventListener('click', () => {
            cache.sidebar.classList.toggle('active');
            cache.sidebarOverlay?.classList.toggle('active');
        });
    };

    /**
     * Configura el evento de cierre del overlay
     * Al hacer click en el overlay, se cierra el sidebar
     * @returns {void}
     */
    const setupOverlayClickListener = () => {
        if (!cache.sidebarOverlay) return;

        cache.sidebarOverlay.addEventListener('click', () => {
            cache.sidebar.classList.remove('active');
            cache.sidebarOverlay.classList.remove('active');
        });
    };

    /**
     * Cierra el sidebar cuando se hace click en un enlace (mobile)
     * @returns {void}
     */
    const setupSidebarItemsCloseListener = () => {
        cache.sidebarItems.forEach(item => {
            item.addEventListener('click', () => {
                // Solo cerrar si está en mobile
                if (window.innerWidth <= 768) {
                    cache.sidebar.classList.remove('active');
                    cache.sidebarOverlay?.classList.remove('active');
                }
            });
        });
    };

    /**
     * Maneja el resize de ventana (media query)
     * Cierra sidebar mobile al expandir ventana
     * @returns {void}
     */
    const setupResizeListener = () => {
        cache.mediaQuery.addEventListener('change', (e) => {
            if (e.matches) {
                // Ancho > 769px
                cache.sidebar.classList.remove('active');
                cache.sidebarOverlay?.classList.remove('active');
            }
        });
    };

    // ============================================
    // AUTENTICACIÓN - Toggle Footer
    // ============================================

    /**
     * Muestra footer de autenticación
     * @returns {void}
     */
    const showAuthFooter = () => {
        if (cache.footerGuest) cache.footerGuest.style.display = 'none';
        if (cache.footerAuth) cache.footerAuth.style.display = 'flex';
    };

    /**
     * Muestra footer de guest (no autenticado)
     * @returns {void}
     */
    const showGuestFooter = () => {
        if (cache.footerGuest) cache.footerGuest.style.display = 'flex';
        if (cache.footerAuth) cache.footerAuth.style.display = 'none';
    };

    /**
     * Configura listeners para botones de autenticación
     * @returns {void}
     */
    const setupAuthToggleListeners = () => {
        // Login button
        if (cache.btnLogin) {
            cache.btnLogin.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Si sidebar está colapsado, expandirlo
                if (cache.sidebar.classList.contains('collapsed')) {
                    cache.sidebar.classList.remove('collapsed');
                    cache.mainContent.classList.remove('sidebar-collapsed');
                    if (cache.headerGames) {
                        cache.headerGames.classList.remove('sidebar-collapsed');
                    }
                }
                
                // Cambiar a estado autenticado
                showAuthFooter();
            });
        }

        // Logout button / perfil
        if (cache.btnLogout) {
            cache.btnLogout.addEventListener('click', (e) => {
                e.preventDefault();
                showGuestFooter();
            });
        }
    };

    /**
     * Configura listener para expandir el sidebar al clickear en la búsqueda
     * @returns {void}
     */
    const setupSearchExpandListener = () => {
        if (!cache.sidebarSearch) return;

        cache.sidebarSearch.addEventListener('click', () => {
            // Si sidebar está colapsado, expandirlo
            if (cache.sidebar.classList.contains('collapsed')) {
                cache.sidebar.classList.remove('collapsed');
                cache.mainContent.classList.remove('sidebar-collapsed');
                if (cache.headerGames) {
                    cache.headerGames.classList.remove('sidebar-collapsed');
                }
            }
        });
    };

    // ============================================
    // INICIALIZACIÓN
    // ============================================

    /**
     * Inicializa todos los listeners y lógica
     * Se ejecuta cuando el DOM está listo
     * @returns {void}
     */
    const init = () => {
        if (cache.initialized) return; // Evitar doble inicialización

        // 1. Cargar caché de elementos
        initCache();

        // 2. Detectar página activa
        setActivePage();

        // 3. Setup Desktop listeners
        setupCollapseBtnListener();

        // 4. Setup Mobile listeners
        setupToggleBtnListener();
        setupOverlayClickListener();
        setupSidebarItemsCloseListener();
        setupResizeListener();

        // 5. Setup Auth listeners (consolidado)
        setupAuthToggleListeners();

        // 6. Setup Search expand listener
        setupSearchExpandListener();

        // 7. Marcar como inicializado
        cache.initialized = true;

    };

    // ============================================
    // API PÚBLICA
    // ============================================

    return {
        // Inicialización
        init,

        // Métodos útiles si se necesitan externamente
        toggleSidebar: () => cache.sidebar?.classList.toggle('active'),
        toggleCollapseSidebar: () => cache.sidebar?.classList.toggle('collapsed'),
        setAuthState: (isAuthenticated) => {
            if (isAuthenticated) {
                showAuthFooter();
            } else {
                showGuestFooter();
            }
        }
    };
})();



// ============================================
// AUTO-INICIALIZACIÓN AL CARGAR DOM
// ============================================

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        SidebarModule.init();
    });
} else {
    // Ya cargó
    SidebarModule.init();
}
