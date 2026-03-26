<?php
$hash = password_hash('dist123', PASSWORD_BCRYPT);
$dsn = 'mysql:host=127.0.0.1;dbname=xpaeps_db;charset=utf8';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare('UPDATE users SET password = ?, updated_at = NOW() WHERE email = ?');
    $stmt->execute([$hash, 'distributor@aeps.com']);
    echo "UPDATED\n";
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
