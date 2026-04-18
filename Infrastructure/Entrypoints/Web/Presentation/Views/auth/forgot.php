<?php
use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f1117; color: #e2e8f0;
            min-height: 100vh; display: flex;
            align-items: center; justify-content: center;
        }
        .box {
            background: #181c27; border: 1px solid #2d3748;
            border-radius: 12px; padding: 2.5rem;
            width: 100%; max-width: 420px;
            box-shadow: 0 8px 32px rgba(0,0,0,.5);
        }
        .title { font-size: 1.4rem; font-weight: 700; color: #4f8ef7; margin-bottom: .5rem; }
        .sub { color: #94a3b8; font-size: .9rem; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; font-size: .83rem; color: #94a3b8; margin-bottom: .4rem; }
        input {
            width: 100%; background: #1e2335; border: 1px solid #2d3748;
            border-radius: 6px; color: #e2e8f0; padding: .65rem .9rem;
            font-size: .95rem; outline: none; transition: border-color .2s;
        }
        input:focus { border-color: #4f8ef7; }
        .btn {
            width: 100%; background: #4f8ef7; color: #fff; border: none;
            border-radius: 6px; padding: .75rem; font-size: 1rem;
            font-weight: 600; cursor: pointer; transition: opacity .2s;
        }
        .btn:hover { opacity: .85; }
        .alert { background: rgba(239,68,68,.1); border-left: 4px solid #ef4444;
            color: #fca5a5; padding: .75rem 1rem; border-radius: 6px;
            margin-bottom: 1.2rem; font-size: .9rem; }
        .back { display: block; text-align: center; margin-top: 1.2rem;
            color: #94a3b8; font-size: .88rem; text-decoration: none; }
        .back:hover { color: #4f8ef7; }
    </style>
</head>
<body>
<div class="box">
    <div class="title">🔑 Recuperar contraseña</div>
    <div class="sub">Ingresa tu email y recibirás una contraseña temporal</div>

    <?php if (Flash::has('error')): ?>
        <div class="alert"><?= htmlspecialchars(Flash::get('error')) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?route=auth.processForgot">
        <div class="form-group">
            <label for="email">Email registrado</label>
            <input type="email" id="email" name="email"
                   placeholder="tu@email.com" required autofocus>
        </div>
        <button type="submit" class="btn">Enviar contraseña temporal</button>
    </form>

    <a href="index.php?route=auth.login" class="back">← Volver al login</a>
</div>
</body>
</html>