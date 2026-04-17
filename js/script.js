// Global Functions
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
// GAMES SECTION
// ============================================

const gamesSection = (() => {
    const cache = {
        container: null,
        buttons: null
    };

    const initCache = () => {
        cache.container = document.querySelector('.games-module .card-content .row');
        cache.buttons = document.querySelectorAll('.games-module .section-buttons div:first-child button');
    };

    const createList = (titleName) => {
        for (let i = 0; i < 4; i++) {
            cache.container.insertAdjacentHTML('beforeend', createGameCard(titleName));
        }
    };

    return {
        init: () => {
            initCache();
            if (!cache.container) return; // Salir si no existe el elemento
            selectButtons(cache.buttons, cache.container, createList);
            cache.container.innerHTML = '';
            createList('Popular');
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
// INICIALIZACIÓN
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    gamesSection.init();
    devsSection.init();
    releasesSection.init();
    newsSection.init();
    communitySection.init();
    gamesGridSection.init();
    priceSlider.init();
});










