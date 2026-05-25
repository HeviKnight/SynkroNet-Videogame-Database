// ============================================
// RAWG API - Direct calls from JavaScript
// ============================================

const externalGames = (() => {
    const CACHE_KEY = 'rawg_games_cache';
    const CACHE_EXPIRY = 7 * 24 * 60 * 60 * 1000; // 7 días
    const RAWG_BASE_URL = 'https://api.rawg.io/api/games';
    let RAWG_API_KEY = null;

    /**
     * Obtiene la API KEY desde el servidor
     */
    const loadApiKey = async () => {
        if (RAWG_API_KEY) return RAWG_API_KEY;
        
        try {
            const response = await fetch('./api/getApiKey.php');
            const data = await response.json();
            
            if (data.success) {
                RAWG_API_KEY = data.apiKey;
                return RAWG_API_KEY;
            } else {
                console.error('Error loading API key:', data.error);
                return null;
            }
        } catch (error) {
            console.error('Error fetching API key:', error);
            return null;
        }
    };

    /**
     * Obtiene datos en caché o null si expiró
     */
    const getCachedData = (cacheKey) => {
        try {
            const cached = localStorage.getItem(cacheKey);
            if (!cached) return null;
            
            const { data, timestamp } = JSON.parse(cached);
            if (Date.now() - timestamp > CACHE_EXPIRY) {
                localStorage.removeItem(cacheKey);
                return null;
            }
            
            return data;
        } catch (error) {
            console.error('Error reading cache:', error);
            return null;
        }
    };

    /**
     * Guarda datos en caché con timestamp
     */
    const setCachedData = (data, cacheKey) => {
        try {
            localStorage.setItem(cacheKey, JSON.stringify({
                data,
                timestamp: Date.now()
            }));
        } catch (error) {
            console.error('Error setting cache:', error);
        }
    };

    /**
     * Llamada estructurada a RAWG API
     */
    const fetchFromRAWG = async (params = {}) => {
        try {
            const apiKey = await loadApiKey();
            if (!apiKey) {
                throw new Error('API key no disponible');
            }

            const query = new URLSearchParams({
                key: apiKey,
                ...params
            }).toString();
            
            const url = `${RAWG_BASE_URL}?${query}`;
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            return data.results || [];
        } catch (error) {
            console.error('Error fetching from RAWG:', error);
            return [];
        }
    };

    /**
     * Obtiene los 10 juegos más populares con caché
     */
    const getTopPopular = async () => {
        const cacheKey = `${CACHE_KEY}_top_popular`;
        const cached = getCachedData(cacheKey);
        
        if (cached) {
            console.log('Top Popular Games: usando caché');
            return cached;
        }
        
        console.log('Top Popular Games: fetch desde RAWG API');
        const games = await fetchFromRAWG({
            ordering: '-rating',
            page_size: 10
        });
        
        if (games.length > 0) {
            setCachedData(games, cacheKey);
        }
        
        return games;
    };

    /**
     * Limpia el caché
     */
    const clearCache = () => {
        const keys = Object.keys(localStorage);
        keys.forEach(key => {
            if (key.startsWith('rawg_games_cache')) {
                localStorage.removeItem(key);
            }
        });
        console.log('Caché RAWG limpiado');
    };

    return {
        getTopPopular,
        clearCache
    };
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
        
        cache.games.forEach(game => {
            const rating = game.rating ? parseFloat(game.rating).toFixed(1) : 'N/A';
            cache.container.insertAdjacentHTML('beforeend', 
                createGameCard(game.name, rating, game.background_image)
            );
        });
    };

    return {
        init: async () => {
            initCache();
            if (!cache.container) return;
            
            cache.container.innerHTML = '<p class="loading">Cargando juegos...</p>';
            
            try {
                cache.games = await externalGames.getTopPopular();
                renderGames();
            } catch (error) {
                console.error('Error loading games:', error);
                cache.container.innerHTML = '<p>Error al cargar los juegos</p>';
            }
        }
    };
})();

// ============================================
// DEVELOPERS SECTION  
// ============================================

const devsSection = (() => {
    const cache = {
        container: null,
        buttons: null
    };

    const initCache = () => {
        cache.container = document.querySelector('.devs-module .card-content .row');
        cache.buttons = document.querySelectorAll('.devs-module .section-buttons div:nth-child(1) button');
    };

    const createList = (titleName) => {
        for (let i = 0; i < 6; i++) {
            cache.container.insertAdjacentHTML('beforeend', createDeveloperCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (!cache.container) return; // Salir si no existe el elemento
            selectButtons(cache.buttons, cache.container, createList);
            cache.container.innerHTML = '';
            createList('Devs');
        }
    };
})();

// ============================================
// RELEASES SECTION
// ============================================

const releasesSection = (() => {
    const cache = {
        container: null
    };

    const initCache = () => {
        cache.container = document.querySelector('#releases-section .card-content .row');
    };

    const createList = (titleName) => {
        for (let i = 0; i < 3; i++) {
            cache.container.insertAdjacentHTML('beforeend', createReleaseCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (!cache.container) return; // Salir si no existe el elemento
            cache.container.innerHTML = '';
            createList('Upcoming');
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










