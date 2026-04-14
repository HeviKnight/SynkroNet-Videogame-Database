/**
 * SynkroNET - Templates Module
 * Funciones simples para generar cards con valores por defecto
 */

/**
 * @param {string} title - Título (opcional)
 * @returns {string} HTML de la tarjeta
 */
function createGameCard(title = 'Título Videojuego', score = 5) {
    return `
        <div class="col-lg-3 col-sm-6">
            <div class="card-game">
                <div>
                    <span><i class="bi bi-box-arrow-up-right"></i></span>
                </div>
                <img src="https://picsum.photos/300/150" class="img-fluid" alt="${title}">
                <div>
                    <div class="tags">
                        <div class="card-tag"><i class="bi bi-star-fill"></i>${score}</div>
                        <div class="card-tag">Indie</div>
                        <div class="card-tag">Cooperativo</div>
                        <div class="card-tag">Aventura</div>
                    </div>
                    <div>
                        <img src="https://picsum.photos/50/50" alt="Studio">
                        <h5>${title}</h5>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * @param {string} name - Nombre (opcional)
 * @param {string} role - Rol (opcional)
 * @returns {string} HTML de la tarjeta
 */
function createDeveloperCard(name = 'Developer Name', role = 'Lead Developer') {
    return `
        <div class="col-lg-2 col-sm-4">
            <div class="card-dev">
                <div>
                    <span><i class="bi bi-box-arrow-up-right"></i></span>
                </div>
                <img src="https://picsum.photos/150/200" class="img-fluid" alt="${name}">
                <div>
                    <div>
                        <span>Featured Game</span>
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

/**
 * @param {string} title - Título (opcional)
 * @param {string} date - Fecha (opcional)
 * @returns {string} HTML de la tarjeta
 */
function createReleaseCard(title = 'Game Title', date = '31/10/2024') {
    return `
        <div class="col-lg-4 col-md-6">
            <div class="card-upcoming">
                <img src="https://picsum.photos/400/160" alt="${title}">
                <div>
                    <span>${date}</span>
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
                    <p>${title}</p>
                </div>
            </div>
        </div>
    `;
}

/**
 * @param {string} title - Título (opcional)
 * @param {string} author - Autor (opcional)
 * @returns {string} HTML de la tarjeta
 */
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

/**
 * @param {string} title - Título (opcional)
 * @returns {string} HTML de la tarjeta
 */
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
