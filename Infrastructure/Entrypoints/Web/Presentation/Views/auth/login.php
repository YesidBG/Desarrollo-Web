<?php
use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f1117;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #181c27;
            border: 1px solid #2d3748;
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0,0,0,.5);
        }
        .login-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #4f8ef7;
            text-align: center;
            margin-bottom: .5rem;
        }
        .login-sub {
            text-align: center;
            color: #94a3b8;
            font-size: .9rem;
            margin-bottom: 2rem;
        }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; font-size: .83rem; color: #94a3b8; margin-bottom: .4rem; }
        input {
            width: 100%;
            background: #1e2335;
            border: 1px solid #2d3748;
            border-radius: 6px;
            color: #e2e8f0;
            padding: .65rem .9rem;
            font-size: .95rem;
            outline: none;
            transition: border-color .2s;
        }
        input:focus { border-color: #4f8ef7; }
        .btn {
            width: 100%;
            background: #4f8ef7;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: .75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: .5rem;
            transition: opacity .2s;
        }
        .btn:hover { opacity: .85; }
        .alert {
            background: rgba(239,68,68,.1);
            border-left: 4px solid #ef4444;
            color: #fca5a5;
            padding: .75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.2rem;
            font-size: .9rem;
        }
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 1.2rem;
            color: #4f8ef7;
            font-size: .88rem;
            text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-title">🎓 CRUD Docentes</div>
    <div class="login-sub">Inicia sesión para continuar</div>

    <?php if (Flash::has('error')): ?>
        <div class="alert"><?= htmlspecialchars(Flash::get('error')) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?route=auth.authenticate">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   placeholder="tu@email.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password"
                   placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn">Iniciar sesión</button>
    </form>

    <a href="index.php?route=auth.forgot" class="forgot-link">
        ¿Olvidaste tu contraseña?
    </a>
</div>
</body>
</html>