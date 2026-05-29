/**
 * SynkroNET - Templates Module
 * Funciones simples para generar cards con valores por defecto
 */

function createGameCard(title = 'Título', score = 5, imageUrl = 'https://picsum.photos/300/150', gameData = {}) {
    // Generar un ID único para el formulario
    const formId = `game-form-${Math.random().toString(36).substr(2, 9)}`;
    
    // Preparar datos para enviar
    const dataStr = JSON.stringify({
        name: gameData.name || title,
        rating: gameData.rating || score,
        background_image: gameData.background_image || imageUrl,
        id: gameData.id || null,
        description: gameData.description_raw || '',
        genres: gameData.genres || [],
        platforms: gameData.platforms || [],
        stores: gameData.stores || [],
        released: gameData.released || '',
        metacritic: gameData.metacritic || null,
        developers: gameData.developers || []
    });
    
    return `
        <form id="${formId}" method="POST" action="/SynkroNET/paginas/game-file.php" style="display: none;">
            <input type="hidden" name="game_data" value='${dataStr.replace(/'/g, "&apos;")}'>
        </form>
        <div class="col-lg-3 col-sm-6">
            <button type="submit" form="${formId}" style="background: none; border: none; padding: 0; cursor: pointer; width: 100%;">
                <div class="card-game">
                    <div>
                        <span><i class="bi bi-box-arrow-up-right"></i></span>
                    </div>
                    <img src="${imageUrl}" alt="${title}">
                    <div>
                        <div class="tags">
                            <div class="card-tag"><i class="bi bi-star-fill"></i>${score}</div>
                        </div>
                        <div>
                            <h5>${title}</h5>
                        </div>
                    </div>
                </div>
            </button>
        </div>
    `;
}

function createDeveloperCard(name = 'Developer Name', role = 'Lead Developer', imageUrl = 'https://picsum.photos/150/200', featuredGameTitle = 'Featured Game', featuredGameImage = '') {
    return `
        <div class="col-lg-2 col-sm-4">
            <div class="card-dev">
                <div>
                    <span><i class="bi bi-box-arrow-up-right"></i></span>
                </div>
                <img src="${imageUrl}" class="img-fluid" alt="${name}">
                <div>
                    <div class="featured-game">
                        ${featuredGameImage ? `<img src="${featuredGameImage}" alt="${featuredGameTitle}" class="featured-game-img">` : ''}
                        <span class="featured-game-title">${featuredGameTitle}</span>
                    </div>
                    <div>
                        <h5>${name}</h5>
                        <p>${role}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function createReleaseCard(title = 'Game Title', date = '31/10/2024', days = 0, hours = 0, minutes = 0, imageUrl = 'https://picsum.photos/400/160', gameData = {}) {
    // Generar un ID único para el formulario
    const formId = `release-form-${Math.random().toString(36).substr(2, 9)}`;
    
    // Preparar datos para enviar
    const dataStr = JSON.stringify({
        name: gameData.name || title,
        rating: gameData.rating || 'N/A',
        background_image: gameData.background_image || imageUrl,
        id: gameData.id || null,
        description: gameData.description_raw || '',
        genres: gameData.genres || [],
        platforms: gameData.platforms || [],
        stores: gameData.stores || [],
        released: gameData.released || date,
        metacritic: gameData.metacritic || null,
        developers: gameData.developers || []
    });
    
    return `
        <form id="${formId}" method="POST" action="/SynkroNET/paginas/game-file.php" style="display: none;">
            <input type="hidden" name="game_data" value='${dataStr.replace(/'/g, "&apos;")}'>
        </form>
        <button type="submit" form="${formId}" style="background: none; border: none; padding: 0; cursor: pointer; display: block; width: 100%;" class="col-lg-4 col-md-6">
            <div class="card-upcoming">
                <img src="${imageUrl}" alt="${title}">
                <div>
                    <span>${date}</span>
                    <div>
                        <div>
                            <span>${days}</span>
                            <span>Days</span>
                        </div>
                        <div>
                            <span>${hours}</span>
                            <span>Hours</span>
                        </div>
                        <div>
                            <span>${minutes}</span>
                            <span>Minutes</span>
                        </div>
                    </div>
                    <p>${title}</p>
                </div>
            </div>
        </button>
    `;
}

function createNewsCard(title = 'Título de la noticia', author = 'Redacción') {
    return `
        <div class="col-lg-4 col-md-6 col-12">
            <div class="news-card">
                <div>
                    <h4>${title}</h4>
                    <div>
                        <span class="card-tag-inverse">Indie</span>
                        <span class="card-tag-inverse">Gaming</span>
                        <span class="card-tag-inverse">2024</span>
                    </div>
                    <p>Tiempo de lectura: 5 min · ${author}</p>
                </div>
                <img src="https://picsum.photos/400/400" alt="${title}">
            </div>
        </div>
    `;
}

function createNewsCardList(title = 'Título de la noticia', author = 'Redacción') {
    return `
        <div class="col-12">
            <div class="news-list">
                <img src="https://picsum.photos/100/100" alt="${title}" class="">
                <img src="https://picsum.photos/100/100" alt="${title}">
                <div>
                    <h4>${title}</h4>
                    <div>
                        <p>descripcion</p>
                        <p>Tiempo de lectura: 5 min · ${author}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function createCommunityCard(title = 'Hilos populares') {
    return `
        <div class="col-lg-4 col-md-6 col-12">
            <div class="community-card">
                <a href="#">
                    <h4>${title}</h4>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <div>
                    <a href="#">
                        <span>R</span>
                        <div>
                            <p>Riot Games</p>
                            <p>La nueva salida del juego...</p>
                        </div>
                    </a>
                    <a href="#">
                        <span>V</span>
                        <div>
                            <p>Valve</p>
                            <p>Counter-Strike 2 updates...</p>
                        </div>
                    </a>
                    <a href="#">
                        <span>E</span>
                        <div>
                            <p>Epic Games</p>
                            <p>Fortnite Chapter 6...</p>
                        </div>
                    </a>
                    <a href="#">
                        <span>B</span>
                        <div>
                            <p>Bethesda</p>
                            <p>Elder Scrolls VI anuncio...</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    `;
}
