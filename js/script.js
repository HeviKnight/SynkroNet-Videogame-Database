// ============================================
// RAWG API - Direct calls from JavaScript
// ============================================

const endpoints = {
    games: 'games',
    developers: 'developers',
    platforms: 'platforms',
    genres: 'genres',
    tags: 'tags'
};

const externalGames = (() => {
    const RAWG_BASE_URL = 'https://api.rawg.io/api';
    let apiKey = null;

    // Obtiene la API key del servidor (solo en memoria)
    const loadApiKey = async () => {
        if (apiKey) return apiKey;
        try {
            const res = await fetch('./api/getApiKey.php');
            const json = await res.json();
            if (json && json.success && json.apiKey) {
                apiKey = json.apiKey;
                return apiKey;
            }
            console.error('No se obtuvo apiKey:', json && json.error);
            return null;
        } catch (err) {
            console.error('Error cargando apiKey:', err);
            return null;
        }
    };

    // Helper legible para detectar URLs absolutas
    const isAbsoluteUrl = (str) => typeof str === 'string' && (str.startsWith('http://') || str.startsWith('https://'));

    // Fetch sencillo: recibe una URL completa o una clave de `endpoints`, params y opciones
    // opciones: { onlyResults: boolean } -> si true devuelve json.results cuando exista
    const fetchUrl = async (endpointOrUrl = 'games', params = {}, options = {}) => {
        const key = await loadApiKey();
        if (!key) throw new Error('API key no disponible');

        let url;
        if (isAbsoluteUrl(endpointOrUrl)) {
            // URL absoluta: agregamos params tal cual (no añadimos la key automáticamente)
            url = new URL(endpointOrUrl);
            url.search = new URLSearchParams(params).toString();
        } else {
            const path = endpoints[endpointOrUrl] || endpointOrUrl;
            url = new URL(`${RAWG_BASE_URL}/${path}`);
            url.search = new URLSearchParams({ key, ...params }).toString();
        }

        const res = await fetch(url.toString());
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();

        // Si solicitan solo los resultados y existe la propiedad results, devolvemos el array
        if (options.onlyResults && json && Array.isArray(json.results)) {
            return json.results;
        }

        return json;
    };

    const clearCache = () => {
        const prefix = 'rawg_games_cache';
        Object.keys(localStorage).forEach(k => {
            if (k.startsWith(prefix)) localStorage.removeItem(k);
        });
        console.log('Caché RAWG limpiado');
    };

    return { clearCache, fetchUrl };
})();

// Global Functions ===== ACTUALIZAR CON EL JSON
function selectButtons(buttons, container, createListFn) {
    buttons.forEach(element => {
        element.addEventListener('click', () => {
            container.innerHTML = '';
            createListFn(`${element.textContent}`);
            buttons.forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
        });
    });
}

// ============================================
// HERO SECTION (Best game by Metacritic)
// ============================================

const heroSection = (() => {
    const fillHero = (game) => {
        if (!game) return;

        const heroSection = document.querySelector('.section-hero');
        if (!heroSection) return;

        // Image
        const imgWrapper = heroSection.querySelector('.hero-image-wrapper img');
        if (imgWrapper) {
            imgWrapper.src = game.background_image || 'https://picsum.photos/1000/';
            imgWrapper.alt = game.name || 'Game';
        }

        // Title
        const title = heroSection.querySelector('.hero-content > div:first-child h1');
        if (title) {
            title.textContent = game.name || 'Unknown';
        }

        // Description
        const desc = heroSection.querySelector('.hero-content > div:first-child p');
        if (desc) {
            const descText = game.description || game.description_raw || 'Mejor juego según Metacritic';
            desc.textContent = descText;
        }

        // Tags (genres)
        const tagsContainer = heroSection.querySelector('.hero-tags');
        if (tagsContainer && game.genres && game.genres.length > 0) {
            tagsContainer.innerHTML = '';
            for (const genre of game.genres.slice(0, 4)) {
                tagsContainer.innerHTML += `<span class="card-tag">${genre.name}</span>`;
            }
        }

        // Platforms (stores)
        const platformsContainer = heroSection.querySelector('.hero-platforms-icons');
        if (platformsContainer && game.stores && game.stores.length > 0) {
            platformsContainer.innerHTML = '';
            for (const store of game.stores.slice(0, 3)) {
                const storeIcon = getStoreIcon(store.store.slug);
                platformsContainer.innerHTML += `
                    <a href="#" title="${store.store.name}" class="platform-icon">
                        <i class="${storeIcon}"></i>
                    </a>
                `;
            }
        }

        // OS (platforms)
        const osContainer = heroSection.querySelector('.hero-os-icons');
        if (osContainer && game.platforms && game.platforms.length > 0) {
            osContainer.innerHTML = '';
            for (const platform of game.platforms.slice(0, 3)) {
                const osIcon = getOSIcon(platform.platform.slug);
                osContainer.innerHTML += `
                    <span class="os-icon" title="${platform.platform.name}">
                        <i class="${osIcon}"></i>
                    </span>
                `;
            }
        }
    };

    const getStoreIcon = (storeName) => {
        const iconMap = {
            'steam': 'bi bi-steam',
            'epic-games': 'bi bi-joystick',
            'gog': 'bi bi-globe',
            'playstation': 'bi bi-playstation',
            'xbox': 'bi bi-xbox',
            'nintendo': 'bi bi-controller'
        };
        return iconMap[storeName] || 'bi bi-bag';
    };

    const getOSIcon = (osName) => {
        const iconMap = {
            'pc': 'bi bi-windows',
            'windows': 'bi bi-windows',
            'macos': 'bi bi-apple',
            'mac': 'bi bi-apple',
            'linux': 'bi bi-ubuntu',
            'playstation': 'bi bi-playstation',
            'xbox': 'bi bi-xbox',
            'nintendo': 'bi bi-controller',
            'ios': 'bi bi-apple',
            'android': 'bi bi-android'
        };
        return iconMap[osName] || 'bi bi-joystick';
    };

    return {
        init: async () => {
            const CACHE_KEY_LOCAL = 'rawg_hero_cache_best_metacritic';
            const CACHE_EXPIRY_LOCAL = 7 * 24 * 60 * 60 * 1000; // 7 días

            // Intentar leer caché
            try {
                const raw = localStorage.getItem(CACHE_KEY_LOCAL);
                if (raw) {
                    const parsed = JSON.parse(raw);
                    if (parsed && parsed.data && Date.now() - parsed.timestamp <= CACHE_EXPIRY_LOCAL) {
                        fillHero(parsed.data);
                        return;
                    } else {
                        localStorage.removeItem(CACHE_KEY_LOCAL);
                    }
                }
            } catch (e) {
                console.warn('Error leyendo caché hero:', e);
            }

            try {
                // Obtener juego mejor valorado por metacritic
                const games = await externalGames.fetchUrl('games', { 
                    ordering: '-metacritic',
                    page_size: 1
                }, { onlyResults: true });

                console.log('Hero: Respuesta de API:', games);

                if (games && games.length > 0) {
                    const bestGame = games[0];
                    console.log('Hero: Rellenando con:', bestGame.name);
                    
                    // Guardar en caché
                    try {
                        localStorage.setItem(CACHE_KEY_LOCAL, JSON.stringify({ data: bestGame, timestamp: Date.now() }));
                    } catch (e) {
                        console.warn('No se pudo guardar caché hero:', e);
                    }

                    fillHero(bestGame);
                } else {
                    console.warn('Hero: No se obtuvieron juegos de la API');
                }
            } catch (err) {
                console.error('Error fetching best game:', err);
            }
        }
    };
})();

// ============================================
// GAMES SECTION (RAWG API - Top 10 Popular)
// ============================================

const gamesSection = (() => {
    const cache = {
        container: null,
        games: []
    };

    const initCache = () => {
        cache.container = document.querySelector('.games-module .card-content .row');
    };

    const renderGames = () => {
        cache.container.innerHTML = '';
        
        if (cache.games.length === 0) {
            cache.container.innerHTML = '<p>No se encontraron juegos</p>';
            return;
        }

        // Usamos for...of y DocumentFragment para crear y añadir cada card
        for (const game of cache.games) {
            const rating = game.rating ? parseFloat(game.rating).toFixed(1) : 'N/A';
            // createGameCard devuelve HTML; convertimos a fragmento y lo añadimos
            try {
                const html = createGameCard(game.name, rating, game.background_image);
                const fragment = document.createRange().createContextualFragment(html);
                cache.container.appendChild(fragment);
            } catch (e) {
                // Fallback: añadir usando innerHTML seguro en caso de error
                const wrapper = document.createElement('div');
                wrapper.innerHTML = createGameCard(game.name, rating, game.background_image);
                while (wrapper.firstChild) cache.container.appendChild(wrapper.firstChild);
            }
        }

        // Inicializar carrusel
        const row = cache.container.closest('.row');
        if (row) {
            setupCarousel(row);
        }
    };

    return {
        init: async () => {
            initCache();
            if (!cache.container) return;

            const CACHE_KEY_LOCAL = 'rawg_games_cache_top_popular_array';
            const CACHE_EXPIRY_LOCAL = 7 * 24 * 60 * 60 * 1000; // 7 días

            cache.container.innerHTML = '<p class="loading">Cargando juegos...</p>';

            // Intentar leer caché local
            try {
                const raw = localStorage.getItem(CACHE_KEY_LOCAL);
                if (raw) {
                    const parsed = JSON.parse(raw);
                    if (parsed && parsed.data && Date.now() - parsed.timestamp <= CACHE_EXPIRY_LOCAL) {
                        cache.games = parsed.data;
                        renderGames();
                        return;
                    } else {
                        localStorage.removeItem(CACHE_KEY_LOCAL);
                    }
                }
            } catch (e) {
                console.warn('Error leyendo caché local juegos:', e);
            }

            try {
                // Llamada directa al fetch genérico que devuelve solo results
                const games = await externalGames.fetchUrl('games', { ordering: '-rating', page_size: 10 }, { onlyResults: true });
                cache.games = Array.isArray(games) ? games : [];

                // Guardar en caché local con timestamp
                try {
                    localStorage.setItem(CACHE_KEY_LOCAL, JSON.stringify({ data: cache.games, timestamp: Date.now() }));
                } catch (e) {
                    console.warn('No se pudo guardar caché local de juegos:', e);
                }

                renderGames();
            } catch (error) {
                console.error('Error loading games:', error);
                cache.container.innerHTML = '<p>Error al cargar los juegos</p>';
            }
        }
    };
})();

// ============================================
// RELEASES SECTION (Upcoming releases - RAWG)
// ============================================

const releasesSection = (() => {
    const cache = { container: null, releases: [] };

    const initCache = () => {
        cache.container = document.querySelector('#releases-section .card-content .row');
    };

    const renderReleases = () => {
        if (!cache.container) return;
        cache.container.innerHTML = '';
        if (!cache.releases || cache.releases.length === 0) {
            cache.container.innerHTML = '<p>No upcoming releases</p>';
            return;
        }

        for (const game of cache.releases) {
            const title = game.name || 'Untitled';
            const dateStr = game.released || 'TBA';
            const imageUrl = game.background_image || 'https://picsum.photos/400/160';
            let days = 0, hours = 0, minutes = 0;

            if (dateStr && dateStr !== 'TBA') {
                const target = new Date(dateStr);
                const diff = Math.max(0, target.getTime() - Date.now());
                days = Math.floor(diff / (1000 * 60 * 60 * 24));
                hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            }

            const html = createReleaseCard(title, dateStr, days, hours, minutes, imageUrl);
            const fragment = document.createRange().createContextualFragment(html);
            cache.container.appendChild(fragment);
        }
    };

    return {
        init: async () => {
            initCache();
            if (!cache.container) return;

            const CACHE_KEY_LOCAL = 'rawg_releases_cache_upcoming_3';
            const CACHE_EXPIRY_LOCAL = 7 * 24 * 60 * 60 * 1000; // 7 días

            cache.container.innerHTML = '<p class="loading">Cargando lanzamientos...</p>';

            // try local cache
            try {
                const raw = localStorage.getItem(CACHE_KEY_LOCAL);
                if (raw) {
                    const parsed = JSON.parse(raw);
                    if (parsed && parsed.data && Date.now() - parsed.timestamp <= CACHE_EXPIRY_LOCAL) {
                        cache.releases = parsed.data;
                        renderReleases();
                        return;
                    } else {
                        localStorage.removeItem(CACHE_KEY_LOCAL);
                    }
                }
            } catch (e) {
                console.warn('Error leyendo caché local releases:', e);
            }

            try {
                // fechas: desde hoy hasta +1 año
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0');
                const dd = String(today.getDate()).padStart(2, '0');
                const start = `${yyyy}-${mm}-${dd}`;

                const nextYear = new Date(today);
                nextYear.setFullYear(nextYear.getFullYear() + 1);
                const nyy = nextYear.getFullYear();
                const nmm = String(nextYear.getMonth() + 1).padStart(2, '0');
                const ndd = String(nextYear.getDate()).padStart(2, '0');
                const end = `${nyy}-${nmm}-${ndd}`;

                const games = await externalGames.fetchUrl('games', { dates: `${start},${end}`, ordering: 'released', page_size: 3 }, { onlyResults: true });
                cache.releases = Array.isArray(games) ? games : [];

                try {
                    localStorage.setItem(CACHE_KEY_LOCAL, JSON.stringify({ data: cache.releases, timestamp: Date.now() }));
                } catch (e) {
                    console.warn('No se pudo guardar caché local de releases:', e);
                }

                renderReleases();
            } catch (err) {
                console.error('Error fetching releases:', err);
                cache.container.innerHTML = '<p>Error al cargar lanzamientos</p>';
            }
        }
    };
})();

// ============================================
// DEVELOPERS SECTION (Top 10 developers - RAWG)
// ============================================

const devsSection = (() => {
    const cache = { container: null, devs: [] };

    const initCache = () => {
        cache.container = document.querySelector('.devs-module .card-content .row');
    };

    const renderDevs = () => {
        if (!cache.container) return;
        cache.container.innerHTML = '';
        if (!cache.devs || cache.devs.length === 0) {
            cache.container.innerHTML = '<p>No se encontraron desarrolladores</p>';
            return;
        }

        for (const dev of cache.devs) {
            const name = dev.name || 'Unknown';
            const role = dev.slug || 'Developer';
            const imageUrl = dev.image_background || 'https://picsum.photos/150/200';
            
            // Featured game: usar el primer juego de la lista si existe
            const featuredGameTitle = (dev.games && dev.games[0]) ? dev.games[0].name : '';
            const featuredGameImage = (dev.games && dev.games[0]) ? dev.games[0].background_image : '';
            
            const html = createDeveloperCard(name, role, imageUrl, featuredGameTitle, featuredGameImage);
            const fragment = document.createRange().createContextualFragment(html);
            cache.container.appendChild(fragment);
        }

        // Inicializar carrusel
        const row = cache.container.closest('.row');
        if (row) {
            setupCarousel(row);
        }
    };

    return {
        init: async () => {
            initCache();
            if (!cache.container) return;

            const CACHE_KEY_LOCAL = 'rawg_devs_cache_top_10';
            const CACHE_EXPIRY_LOCAL = 7 * 24 * 60 * 60 * 1000; // 7 días

            cache.container.innerHTML = '<p class="loading">Cargando desarrolladores...</p>';

            try {
                const raw = localStorage.getItem(CACHE_KEY_LOCAL);
                if (raw) {
                    const parsed = JSON.parse(raw);
                    if (parsed && parsed.data && Date.now() - parsed.timestamp <= CACHE_EXPIRY_LOCAL) {
                        cache.devs = parsed.data;
                        renderDevs();
                        return;
                    } else {
                        localStorage.removeItem(CACHE_KEY_LOCAL);
                    }
                }
            } catch (e) {
                console.warn('Error leyendo caché local devs:', e);
            }

            try {
                const devs = await externalGames.fetchUrl('developers', { page_size: 10 }, { onlyResults: true });
                
                // Obtener juegos para cada desarrollador (máximo 3 por dev)
                const devsWithGames = await Promise.all(devs.map(async (dev) => {
                    try {
                        const games = await externalGames.fetchUrl(`developers/${dev.id}/games`, { page_size: 1 }, { onlyResults: true });
                        return { ...dev, games: Array.isArray(games) ? games : [] };
                    } catch (e) {
                        console.warn(`Error fetching games for dev ${dev.id}:`, e);
                        return { ...dev, games: [] };
                    }
                }));
                
                cache.devs = Array.isArray(devsWithGames) ? devsWithGames : [];

                try {
                    localStorage.setItem(CACHE_KEY_LOCAL, JSON.stringify({ data: cache.devs, timestamp: Date.now() }));
                } catch (e) {
                    console.warn('No se pudo guardar caché local de devs:', e);
                }

                renderDevs();
            } catch (err) {
                console.error('Error fetching developers:', err);
                cache.container.innerHTML = '<p>Error al cargar desarrolladores</p>';
            }
        }
    };
})();

// ============================================
// NEWS SECTION
// ============================================

const newsSection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('#news-section .card-content .row');
    };

    const createList = (titleName) => {
        for (let i = 0; i < 3; i++) {
            cache.container.insertAdjacentHTML('beforeend', createNewsCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (!cache.container) return; // Salir si no existe el elemento
            cache.container.innerHTML = '';
            createList('News');
        }
    };
})();

// ============================================
// COMMUNITY SECTION
// ============================================

const communitySection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('#community-section .card-content .row');
    };

    const createList = (titleName) => {
        for (let i = 0; i < 3; i++) {
            cache.container.insertAdjacentHTML('beforeend', createCommunityCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (!cache.container) return; // Salir si no existe el elemento
            cache.container.innerHTML = '';
            createList('Hilos populares');
        }
    };
})();

// ============================================
// GAMES GRID SECTION  
// ============================================

const gamesGridSection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('.search-grid-games .games-grid');
    };

    const createList = (titleName) => {
        if (!cache.container) {
            return;
        }
        for (let i = 0; i < 6; i++) {
            cache.container.insertAdjacentHTML('beforeend', createGameCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (cache.container) {
                cache.container.innerHTML = '';
                createList('GamesList');
            }
        }
    };
})();

// ============================================
// NEWS GRID SECTION  
// ============================================

const newsGridSection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('#news-grid');
    };

    const createList = () => {
        if (!cache.container) {
            return;
        }
        for (let i = 0; i < 6; i++) {
            cache.container.insertAdjacentHTML('beforeend', createNewsCardList('Noticia ' + (i + 1)));
        }
    };

    return {
        init: () => {
            initCache();
            if (cache.container) {
                cache.container.innerHTML = '';
                createList();
            }
        }
    };
})();

// ============================================
// DEVS GRID SECTION  
// ============================================

const devsGridSection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('#devs-grid');
    };

    const createList = () => {
        if (!cache.container) {
            return;
        }
        for (let i = 0; i < 6; i++) {
            cache.container.insertAdjacentHTML('beforeend', createDeveloperCard('Developer ' + (i + 1), 'Game Designer'));
        }
    };

    return {
        init: () => {
            initCache();
            if (cache.container) {
                cache.container.innerHTML = '';
                createList();
            }
        }
    };
})();

// ============================================
// FILTERS
// ============================================
// PRICE RANGE SLIDER ========================

const priceSlider = (() => {
    const initSliders = () => {
        const priceMin = document.getElementById('priceMin');
        const priceMax = document.getElementById('priceMax');
        const minPriceDisplay = document.getElementById('minPrice');
        const maxPriceDisplay = document.getElementById('maxPrice');

        if (!priceMin || !priceMax) return;

        const updateSliderBackground = () => {
            const minVal = parseInt(priceMin.value);
            const maxVal = parseInt(priceMax.value);
            const minPercent = (minVal / 100) * 100;
            const maxPercent = (maxVal / 100) * 100;

            // Actualizar priceMax background
            priceMax.style.background = `linear-gradient(to right, var(--base-sky-main) 0%, var(--base-sky-main) ${minPercent}%, #333 ${minPercent}%, #333 ${maxPercent}%, var(--base-sky-main) ${maxPercent}%, var(--base-sky-main) 100%)`;

            minPriceDisplay.textContent = minVal;
            maxPriceDisplay.textContent = maxVal;
        };

        priceMin.addEventListener('input', () => {
            if (parseInt(priceMin.value) > parseInt(priceMax.value)) {
                priceMin.value = priceMax.value;
            }
            updateSliderBackground();
        });

        priceMax.addEventListener('input', () => {
            if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
                priceMax.value = priceMin.value;
            }
            updateSliderBackground();
        });

        // Inicializar el background
        updateSliderBackground();
    };

    return {
        init: initSliders
    };
})();

// ============================================
// DUAL RANGE SLIDERS
// ============================================

const dualRangeSliders = (() => {
    const MIN_DISTANCE = 1;
    
    // Mapa de keypoints: índice -> etiqueta
    const keyPoints = ['FREE', '0', '5', '10', '30', '60+'];
    
    // Mapa de keypoints: índice -> valor real
    const keyValues = [0, 0, 5, 10, 30, 60];
    
    const getLabel = (index) => keyPoints[parseInt(index)];
    const getValue = (index) => keyValues[parseInt(index)];
    
    const updateTrack = (drange) => {
        const rangeMin = drange.querySelector(".drange-min");
        const rangeMax = drange.querySelector(".drange-max");
        const track = drange.querySelector(".drange-track");
        
        if (!rangeMin || !rangeMax || !track) return;
        
        const minIndex = parseInt(rangeMin.value);
        const maxIndex = parseInt(rangeMax.value);
        
        const minPercent = (minIndex / 5) * 100;
        const maxPercent = (maxIndex / 5) * 100;
        
        track.style.background = `linear-gradient(to right, var(--base-white) 0%, var(--base-white) ${minPercent}%, var(--base-sky-main) ${minPercent}%, var(--base-sky-main) ${maxPercent}%, var(--base-white) ${maxPercent}%, var(--base-white) 100%)`;
    };

    const initDualRangeSliders = () => {
        // Loop through all dual range sliders
        document.querySelectorAll(".drange").forEach(drange => {
            // Get range pickers & value display
            let ranges = drange.querySelectorAll("input[type=range]"),
                dmin = drange.querySelector(".dmin"),
                dmax = drange.querySelector(".dmax"),
                valueMin = drange.parentElement.querySelector(".drange-value-min"),
                valueMax = drange.parentElement.querySelector(".drange-value-max");

            if (ranges.length < 2 || !dmin || !dmax) return;

            const updateValues = () => {
                const minIndex = parseInt(ranges[0].value);
                const maxIndex = parseInt(ranges[1].value);

                const minLabel = getLabel(minIndex);
                const maxLabel = getLabel(maxIndex);
                const minValue = getValue(minIndex);
                const maxValue = getValue(maxIndex);

                // Mostrar formato: "minLabel € · maxLabel €"
                dmin.innerHTML = minLabel + ' €';
                dmax.innerHTML = maxLabel + ' €';

                if (valueMin) valueMin.value = minValue;
                if (valueMax) valueMax.value = maxValue;
                updateTrack(drange);
            };

            // Min cannot be more than max - mantiene distancia mínima
            ranges[0].addEventListener("input", e => {
                if (+ranges[0].value >= +ranges[1].value - MIN_DISTANCE) {
                    ranges[0].value = +ranges[1].value - MIN_DISTANCE;
                }
                updateValues();
            });

            // Max cannot be less than min - mantiene distancia mínima
            ranges[1].addEventListener("input", e => {
                if (+ranges[1].value <= +ranges[0].value + MIN_DISTANCE) {
                    ranges[1].value = +ranges[0].value + MIN_DISTANCE;
                }
                updateValues();
            });

            // Init value display
            updateValues();
        });
    };

    return {
        init: initDualRangeSliders
    };
})();

// ============================================
// INICIALIZACIÓN
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    heroSection.init();
    gamesSection.init();
    devsSection.init();
    releasesSection.init();
    newsSection.init();
    communitySection.init();
    gamesGridSection.init();
    newsGridSection.init();
    devsGridSection.init();
    priceSlider.init();
    dualRangeSliders.init();
});

// Helper: convierte una fila en un carrusel responsive (4/2/1)
function setupCarousel(row) {
    if (!row) return;
    if (row.dataset.carouselInitialized === '1') return;

    // Crear un contenedor wrapper para controlar mejor el layout
    const wrapper = document.createElement('div');
    wrapper.style.position = 'relative';
    wrapper.style.overflow = 'visible';
    wrapper.style.width = '100%';

    // Aplicar estilos al track (dentro del wrapper)
    const track = document.createElement('div');
    track.className = 'carousel-track';
    track.style.display = 'flex';
    track.style.gap = '1rem';
    track.style.transition = 'transform 0.35s ease';
    track.style.overflow = 'visible';
    track.style.width = '100%';

    // Mover children de row al track
    const children = Array.from(row.children);
    for (const child of children) {
        track.appendChild(child);
    }

    wrapper.appendChild(track);
    row.appendChild(wrapper);

    // Crear controles fuera del flujo
    const btnPrev = document.createElement('button');
    btnPrev.className = 'carousel-prev';
    btnPrev.type = 'button';
    btnPrev.innerHTML = '&larr;';
    
    const btnNext = document.createElement('button');
    btnNext.className = 'carousel-next';
    btnNext.type = 'button';
    btnNext.innerHTML = '&rarr;';

    // Estilos de posicionamiento absoluto
    [btnPrev, btnNext].forEach(b => {
        b.style.position = 'absolute';
        b.style.top = '50%';
        b.style.transform = 'translateY(-50%)';
        b.style.zIndex = '25';
    });
    btnPrev.style.left = '0px';
    btnNext.style.right = '0px';

    wrapper.style.paddingLeft = '40px';
    wrapper.style.paddingRight = '40px';
    wrapper.appendChild(btnPrev);
    wrapper.appendChild(btnNext);

    let itemsPerView = 4;
    const getItemsPerView = () => {
        const w = window.innerWidth;
        if (w >= 992) return 4;
        if (w >= 768) return 2;
        return 1;
    };

    let currentIndex = 0;
    const update = () => {
        itemsPerView = getItemsPerView();
        const totalItems = track.children.length;
        const itemWidthPercent = 100 / itemsPerView;
        const maxIndex = Math.max(0, Math.ceil(totalItems / itemsPerView) - 1);
        if (currentIndex > maxIndex) currentIndex = maxIndex;
        
        // El track solo ocupa el espacio de los items visibles
        track.style.width = `100%`;
        
        // set each child flex-basis
        for (const child of track.children) {
            child.style.flex = `0 0 calc(100% / ${itemsPerView})`;
        }
        
        // Calcular el desplazamiento basado en el índice de página
        const translatePercent = currentIndex * 100;
        track.style.transform = `translateX(-${translatePercent}%)`;
        btnPrev.disabled = currentIndex === 0;
        btnNext.disabled = currentIndex >= maxIndex;
    };

    btnPrev.addEventListener('click', () => {
        if (currentIndex > 0) currentIndex -= 1;
        update();
    });

    btnNext.addEventListener('click', () => {
        currentIndex += 1;
        update();
    });

    // Resize handler
    let resizeTimeout;
    const onResize = () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(update, 150);
    };
    window.addEventListener('resize', onResize);

    // marcar inicializado
    row.dataset.carouselInitialized = '1';
    update();
}










