<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=aeps_db;charset=utf8mb4','root','');
} catch (PDOException $e) {
    echo "CONNECT_ERR: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
$stmt = $pdo->query("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'aeps_db'");
if (!$stmt) { echo "QUERY_ERR\n"; exit(1); }
$rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
if (!$rows) { echo "NO_TABLES\n"; exit(0); }
foreach ($rows as $t) { echo $t . PHP_EOL; }
