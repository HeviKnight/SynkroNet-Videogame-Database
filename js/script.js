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
            cache.container.innerHTML = '';
            createList('Hilos populares');
        }
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
});










