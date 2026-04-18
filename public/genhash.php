<?php
$clave = '123456';
$hash  = password_hash($clave, PASSWORD_BCRYPT);
echo "Hash generado: " . $hash . "<br>";
echo "Verificacion: " . (password_verify($clave, $hash) ? 'OK' : 'FALLO') . "<br>";

// Actualizar en BD
$pdo = new PDO(
    'mysql:host=localhost;dbname=crud_docentes;charset=utf8mb4',
    'root',
    '123456',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$stmt = $pdo->prepare("UPDATE docentes SET password = :hash WHERE id IN (1,2,3)");
$stmt->execute([':hash' => $hash]);
echo "Docentes 1, 2 y 3 actualizados con el nuevo hash<br>";
echo "Ya puedes iniciar sesion con: 123456";