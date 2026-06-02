<?php
session_start();
require_once 'config.php';

// Verificar si está logeado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verificar timeout de sesión
if (time() - $_SESSION['login_time'] > SESSION_TIMEOUT) {
    session_destroy();
    header('Location: login.php?timeout=1');
    exit;
}

// Actualizar tiempo de última actividad
$_SESSION['login_time'] = time();

$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Variables para mensajes
$message = '';
$message_type = '';

// Procesar formulario de inserción de juegos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_game') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $imagen_url = trim($_POST['imagen_url'] ?? '');
    $demo_url = trim($_POST['demo_url'] ?? '');
    $rating_avg = floatval($_POST['rating_avg'] ?? 0);
    $fecha_lanzamiento = $_POST['fecha_lanzamiento'] ?? null;
    $rawg_id = intval($_POST['rawg_id'] ?? 0);

    if (empty($titulo)) {
        $message = 'El título del juego es obligatorio';
        $message_type = 'error';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO videojuegos (rawg_id, titulo, descripcion, imagen_url, demo_url, rating_avg, fecha_lanzamiento) VALUES (:rawg_id, :titulo, :descripcion, :imagen_url, :demo_url, :rating_avg, :fecha_lanzamiento)");
            $stmt->execute([
                ':rawg_id' => $rawg_id > 0 ? $rawg_id : null,
                ':titulo' => $titulo,
                ':descripcion' => $descripcion,
                ':imagen_url' => $imagen_url,
                ':demo_url' => $demo_url,
                ':rating_avg' => $rating_avg,
                ':fecha_lanzamiento' => !empty($fecha_lanzamiento) ? $fecha_lanzamiento : null
            ]);
            $message = 'Juego agregado exitosamente';
            $message_type = 'success';
        } catch (Exception $e) {
            $message = DEBUG_MODE ? $e->getMessage() : 'Error al agregar el juego';
            $message_type = 'error';
        }
    }
}

try {
    // Obtener información del usuario
    $stmt = $pdo->prepare("SELECT id, username, email, es_desarrollador, nivel, experiencia, reputacion, fecha_registro FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        session_destroy();
        header('Location: login.php');
        exit;
    }

    // Obtener juegos agregados
    $games_stmt = $pdo->prepare("SELECT * FROM videojuegos ORDER BY fecha_lanzamiento DESC LIMIT 10");
    $games_stmt->execute();
    $games = $games_stmt->fetchAll();
} catch (Exception $e) {
    die('Error: ' . (DEBUG_MODE ? $e->getMessage() : 'Error al cargar información'));
}

include_once("componentes/sidebar.php");
?>

<style>
    #main-content {
        margin-left: var(--sidebar-width-expanded);
        transition: margin-left var(--transition);
        padding: 40px;
        min-height: 100vh;
        background: var(--bg-base);
    }

    #sidebar.collapsed ~ #main-content {
        margin-left: var(--sidebar-width-collapsed);
    }

    .panel-header {
        margin-bottom: 48px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .panel-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .panel-header-subtitle {
        color: var(--text-muted);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
    }

    .btn-logout {
        background: var(--state-danger);
        color: white;
        padding: 10px 20px;
        border-radius: var(--border-radius-sm);
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-decoration: none;
        transition: all var(--transition-fast);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-logout:hover {
        background: #d63031;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--bg-surface);
        border-radius: var(--border-radius-md);
        padding: 24px;
        border: 1px solid var(--border-color);
        transition: all var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-card h3 {
        font-size: 0.875rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0 0 12px 0;
        font-weight: 600;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 8px 0;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
    }

    .stat-badge {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 6px 12px;
        border-radius: var(--border-radius-pill);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 12px;
    }

    .stat-badge.developer {
        background: var(--base-gold);
        color: var(--base-ink-dark);
    }

    .user-details {
        background: var(--bg-surface);
        border-radius: var(--border-radius-md);
        padding: 32px;
        border: 1px solid var(--border-color);
        margin-bottom: 40px;
    }

    .user-details h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0 0 24px 0;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .detail-item {
        padding: 16px;
        background: var(--bg-base);
        border-radius: var(--border-radius-sm);
        border: 1px solid var(--border-color);
    }

    .detail-label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .detail-value {
        color: var(--text-main);
        font-size: 1.125rem;
        font-weight: 600;
    }

    .form-section {
        background: var(--bg-surface);
        border-radius: var(--border-radius-md);
        padding: 32px;
        border: 1px solid var(--border-color);
        margin-bottom: 40px;
    }

    .form-section h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0 0 24px 0;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group-item {
        display: flex;
        flex-direction: column;
    }

    .form-group-item label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .form-group-item input,
    .form-group-item textarea {
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        font-size: 1rem;
        background: var(--bg-base);
        color: var(--text-main);
        font-family: inherit;
        transition: all var(--transition-fast);
    }

    .form-group-item textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-group-item input:focus,
    .form-group-item textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 205, 219, 0.1);
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        padding: 14px 32px;
        border: 2px solid var(--primary);
        border-radius: var(--border-radius-sm);
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        transition: all var(--transition-fast);
        font-family: inherit;
    }

    .btn-submit:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
    }

    .alert {
        padding: 14px 16px;
        border-radius: var(--border-radius-sm);
        margin-bottom: 24px;
        font-size: 0.875rem;
        border-left: 4px solid;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--state-danger);
        border-color: var(--state-danger);
    }

    .alert-success {
        background: rgba(17, 186, 37, 0.1);
        color: var(--state-success);
        border-color: var(--state-success);
    }

    .games-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .game-card {
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-md);
        overflow: hidden;
        transition: all var(--transition);
    }

    .game-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .game-card-image {
        width: 100%;
        height: 150px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .game-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .game-card-content {
        padding: 16px;
    }

    .game-card-title {
        font-weight: 600;
        color: var(--text-main);
        margin: 0 0 8px 0;
        font-size: 0.95rem;
    }

    .game-card-rating {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 4px 8px;
        border-radius: var(--border-radius-sm);
        font-size: 0.75rem;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        #main-content {
            padding: 20px;
            margin-left: var(--sidebar-width-collapsed);
        }

        .panel-header {
            margin-bottom: 32px;
            flex-direction: column;
            align-items: flex-start;
        }

        .panel-header h1 {
            font-size: 1.75rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .user-details {
            padding: 24px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<main id="main-content" class="main-content">
    <div class="panel-header">
        <div>
            <h1>Panel</h1>
            <p class="panel-header-subtitle">Gestiona tu perfil y contenido</p>
        </div>
        <a href="logout.php" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
    </div>

    <?php if (isset($_GET['timeout']) && $_GET['timeout'] == 1): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            Tu sesión expiró por inactividad. Por favor, inicia sesión nuevamente.
        </div>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message_type === 'error' ? 'danger' : 'success' ?>">
            <i class="bi bi-<?= $message_type === 'error' ? 'exclamation-circle' : 'check-circle' ?>"></i> 
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Nivel</h3>
            <div class="stat-value"><?= htmlspecialchars($user['nivel']) ?></div>
            <p class="stat-label">Rango Actual</p>
        </div>

        <div class="stat-card">
            <h3>Experiencia</h3>
            <div class="stat-value"><?= number_format($user['experiencia']) ?></div>
            <p class="stat-label">Puntos XP</p>
        </div>

        <div class="stat-card">
            <h3>Reputación</h3>
            <div class="stat-value"><?= number_format($user['reputacion']) ?></div>
            <p class="stat-label">Puntos de Reputación</p>
        </div>

        <div class="stat-card">
            <h3>Estado</h3>
            <div class="stat-value">✓</div>
            <p class="stat-label">Sesión Activa</p>
            <?php if ($user['es_desarrollador']): ?>
                <span class="stat-badge developer">Desarrollador</span>
            <?php else: ?>
                <span class="stat-badge">Usuario</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="user-details">
        <h2>Información de Cuenta</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">ID de Usuario</div>
                <div class="detail-value"><?= htmlspecialchars($user['id']) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Nombre de Usuario</div>
                <div class="detail-value"><?= htmlspecialchars($user['username']) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Correo Electrónico</div>
                <div class="detail-value"><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tipo de Cuenta</div>
                <div class="detail-value"><?= $user['es_desarrollador'] ? 'Desarrollador' : 'Usuario' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Miembro Desde</div>
                <div class="detail-value"><?= date('d/m/Y', strtotime($user['fecha_registro'])) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Última Actividad</div>
                <div class="detail-value"><?= date('H:i:s', $_SESSION['login_time']) ?></div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <h2>Agregar Nuevo Juego</h2>
        <form method="POST" action="panel.php">
            <input type="hidden" name="action" value="add_game">

            <div class="form-row">
                <div class="form-group-item">
                    <label for="titulo">Título del Juego *</label>
                    <input type="text" id="titulo" name="titulo" required placeholder="Ej: The Witcher 3">
                </div>
                <div class="form-group-item">
                    <label for="rawg_id">ID RAWG API</label>
                    <input type="number" id="rawg_id" name="rawg_id" placeholder="ID de RAWG (opcional)">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-item" style="grid-column: 1 / -1;">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Escribe una breve descripción del juego..."></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-item">
                    <label for="imagen_url">URL de Imagen</label>
                    <input type="url" id="imagen_url" name="imagen_url" placeholder="https://ejemplo.com/imagen.jpg">
                </div>
                <div class="form-group-item">
                    <label for="demo_url">URL de Demo</label>
                    <input type="url" id="demo_url" name="demo_url" placeholder="https://ejemplo.com/demo">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-item">
                    <label for="rating_avg">Calificación Promedio</label>
                    <input type="number" id="rating_avg" name="rating_avg" min="0" max="5" step="0.1" placeholder="4.5">
                </div>
                <div class="form-group-item">
                    <label for="fecha_lanzamiento">Fecha de Lanzamiento</label>
                    <input type="date" id="fecha_lanzamiento" name="fecha_lanzamiento">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-plus-circle"></i> Agregar Juego
            </button>
        </form>
    </div>

    <?php if (!empty($games)): ?>
        <div class="form-section">
            <h2>Juegos Recientes</h2>
            <div class="games-list">
                <?php foreach ($games as $game): ?>
                    <div class="game-card">
                        <div class="game-card-image">
                            <?php if (!empty($game['imagen_url'])): ?>
                                <img src="<?= htmlspecialchars($game['imagen_url']) ?>" alt="<?= htmlspecialchars($game['titulo']) ?>">
                            <?php else: ?>
                                <i class="bi bi-controller" style="font-size: 3rem; color: white; opacity: 0.5;"></i>
                            <?php endif; ?>
                        </div>
                        <div class="game-card-content">
                            <h4 class="game-card-title"><?= htmlspecialchars($game['titulo']) ?></h4>
                            <?php if (!empty($game['rating_avg'])): ?>
                                <span class="game-card-rating">⭐ <?= number_format($game['rating_avg'], 2) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $base_url; ?>/js/sidebar.js"></script>
</body>
</html>
