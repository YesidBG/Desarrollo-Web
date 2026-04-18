<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contraseña enviada</title>
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
            width: 100%; max-width: 480px;
            box-shadow: 0 8px 32px rgba(0,0,0,.5);
            text-align: center;
        }
        .icon { font-size: 3rem; margin-bottom: 1rem; }
        .title { font-size: 1.4rem; font-weight: 700; color: #22c55e; margin-bottom: .5rem; }
        .sub { color: #94a3b8; font-size: .9rem; margin-bottom: 2rem; }
        .clave-box {
            background: #1e2335; border: 2px dashed #4f8ef7;
            border-radius: 8px; padding: 1.5rem; margin: 1.5rem 0;
        }
        .clave-label { font-size: .8rem; color: #94a3b8; margin-bottom: .5rem; }
        .clave {
            font-family: 'Courier New', monospace;
            font-size: 2rem; font-weight: 700;
            color: #4f8ef7; letter-spacing: .2em;
        }
        .email-info { color: #94a3b8; font-size: .88rem; margin-bottom: 1.5rem; }
        .btn {
            display: inline-block; background: #4f8ef7; color: #fff;
            border: none; border-radius: 6px; padding: .75rem 2rem;
            font-size: 1rem; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: opacity .2s;
        }
        .btn:hover { opacity: .85; }
        .warning {
            background: rgba(245,158,11,.1); border-left: 4px solid #f59e0b;
            color: #fde68a; padding: .75rem 1rem; border-radius: 6px;
            margin-top: 1.5rem; font-size: .85rem; text-align: left;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="icon">✅</div>
    <div class="title">¡Contraseña generada!</div>
    <div class="sub">Se ha generado una contraseña temporal para tu cuenta</div>

    <?php if (!empty($newPass)): ?>
        <div class="email-info">
            Cuenta: <strong><?= htmlspecialchars($email) ?></strong>
        </div>

        <div class="clave-box">
            <div class="clave-label">Tu nueva contraseña temporal es:</div>
            <div class="clave"><?= htmlspecialchars($newPass) ?></div>
        </div>

        <div class="warning">
            ⚠️ Anota esta contraseña ahora. Una vez que cierres esta página no podrás verla de nuevo.
        </div>
    <?php else: ?>
        <p style="color:#94a3b8">Si el email está registrado, se generó una contraseña temporal. Contacta al administrador.</p>
    <?php endif; ?>

    <br><br>
    <a href="index.php?route=auth.login" class="btn">Ir al login</a>
</div>
</body>
</html>