<?php
session_start();
echo "session_status: " . session_status() . "<br>";
echo "SESSION auth: " . (isset($_SESSION['auth']) ? 'SI hay sesion' : 'NO hay sesion') . "<br>";
echo "Destruyendo sesion...<br>";
session_destroy();
echo "Sesion destruida OK<br>";
?>
<!DOCTYPE html>
<html>
<head><title>Test Login</title></head>
<body style="background:#0f1117;color:#fff;font-family:sans-serif;padding:2rem;">
    <h2>Formulario de prueba</h2>
    <form method="POST" action="login-test.php">
        <input type="email" name="email" placeholder="email" style="padding:.5rem;margin:.5rem 0;display:block;width:300px"><br>
        <input type="password" name="password" placeholder="password" style="padding:.5rem;margin:.5rem 0;display:block;width:300px"><br>
        <button type="submit" style="padding:.5rem 1rem;background:#4f8ef7;color:#fff;border:none;border-radius:4px;">Login</button>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Email recibido: <?= htmlspecialchars($_POST['email'] ?? '') ?></p>
        <p>Password recibido: <?= htmlspecialchars($_POST['password'] ?? '') ?></p>
    <?php endif; ?>
</body>
</html>