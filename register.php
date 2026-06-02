<?php
session_start();
require_once 'config.php';

// Si ya está logeado, redirigir a index
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Procesar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validación
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = 'Por favor completa todos los campos';
    } elseif (strlen($username) < 3) {
        $error = 'El nombre de usuario debe tener al menos 3 caracteres';
    } elseif (strlen($username) > 20) {
        $error = 'El nombre de usuario no puede exceder 20 caracteres';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor ingresa un correo válido';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres';
    } elseif ($password !== $password_confirm) {
        $error = 'Las contraseñas no coinciden';
    } else {
        try {
            // Verificar si el usuario ya existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = :username OR email = :email");
            $stmt->execute([':username' => $username, ':email' => $email]);
            $existing = $stmt->fetch();

            if ($existing) {
                $error = 'El nombre de usuario o correo ya están registrados';
            } else {
                // Crear hash de la contraseña
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                // Insertar nuevo usuario
                $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, password, es_desarrollador, nivel, experiencia, reputacion) VALUES (:username, :email, :password, 0, 1, 0, 0)");
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $password_hash
                ]);

                $success = 'Cuenta creada exitosamente. Por favor inicia sesión.';
                
                // Limpiar formulario
                $username = '';
                $email = '';
            }
        } catch (Exception $e) {
            $error = DEBUG_MODE ? $e->getMessage() : 'Error al crear la cuenta';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= APP_NAME ?> - Registrarse</title>
    <link rel="icon" type="image/ico" href="<?php echo $base_url; ?>/public/favicon.ico">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/styles.css" />
    
    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: var(--bg-base);
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            background: var(--bg-surface);
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-lg);
            padding: 48px 32px;
            border: 1px solid var(--border-color);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .login-logo {
            width: 64px;
            height: 64px;
            fill: var(--primary);
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: 0.05em;
            margin: 0;
        }

        .login-header h1 span {
            color: var(--primary);
        }

        .login-subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-main);
            font-weight: 500;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            background: var(--bg-base);
            color: var(--text-main);
            font-family: inherit;
            transition: all var(--transition-fast);
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 205, 219, 0.1);
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-hint.valid {
            color: var(--state-success);
        }

        .form-hint.invalid {
            color: var(--state-danger);
        }

        .btn-register {
            width: 100%;
            padding: 14px 24px;
            background: var(--primary);
            color: var(--text-inverse);
            border: 2px solid var(--primary);
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all var(--transition-fast);
            font-family: inherit;
            margin-top: 8px;
        }

        .btn-register:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-register:active {
            background: var(--primary-active);
            border-color: var(--primary-active);
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

        .login-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .login-footer p {
            margin: 0 0 12px 0;
        }

        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color var(--transition-fast);
        }

        .login-footer a:hover {
            color: var(--primary-hover);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 32px 24px;
            }

            .login-header {
                margin-bottom: 32px;
            }

            .login-logo {
                width: 48px;
                height: 48px;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <svg class="login-logo" viewBox="0 0 160 160">
                    <g id="Logo">
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
                </svg>
                <div>
                    <h1>Synkro<span>NET</span></h1>
                    <p class="login-subtitle">Crea tu cuenta</p>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> <?= htmlspecialchars($success) ?>
                </div>
                <div style="text-align: center; margin-top: 24px;">
                    <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 16px;">Redirigiendo a login en 3 segundos...</p>
                    <a href="login.php" class="btn btn-primary" style="text-decoration: none; display: inline-block; padding: 10px 24px;">
                        Ir a Login
                    </a>
                </div>
                <script>
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 3000);
                </script>
            <?php else: ?>
                <form method="POST" action="register.php">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" required autocomplete="username" placeholder="Tu nombre de usuario" value="<?= htmlspecialchars($username ?? '') ?>">
                        <div class="form-hint">Mínimo 3 caracteres, máximo 20</div>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required autocomplete="email" placeholder="tu@correo.com" value="<?= htmlspecialchars($email ?? '') ?>">
                        <div class="form-hint">Usaremos esto para recuperar tu cuenta</div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Tu contraseña segura">
                        <div class="form-hint">Mínimo 6 caracteres</div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirmar Contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm" required autocomplete="new-password" placeholder="Repite tu contraseña">
                        <div class="form-hint">Debe coincidir con la contraseña anterior</div>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-plus"></i> Crear Cuenta
                    </button>
                </form>

                <div class="login-footer">
                    <p>¿Ya tienes cuenta?</p>
                    <a href="<?php echo $base_url; ?>/login.php">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
