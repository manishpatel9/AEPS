<?php
// Simple helper to create the MySQL database configured in .env
// Usage: php scripts/create_database.php

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    fwrite(STDERR, "Error: .env not found at $envPath\n");
    exit(1);
}

$raw = file_get_contents($envPath);
$lines = preg_split('/\r?\n/', $raw);
$vars = [];
foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) continue;
    if (!str_contains($line, '=')) continue;
    [$k, $v] = explode('=', $line, 2);
    $k = trim($k);
    $v = trim($v);
    $v = trim($v, "\"'");
    $vars[$k] = $v;
}

$dbHost = $vars['DB_HOST'] ?? '127.0.0.1';
$dbPort = $vars['DB_PORT'] ?? '3306';
$dbUser = $vars['DB_USERNAME'] ?? 'root';
$dbPass = $vars['DB_PASSWORD'] ?? '';
$dbName = $vars['DB_DATABASE'] ?? null;

if (!$dbName) {
    fwrite(STDERR, "Error: DB_DATABASE is not set in .env\n");
    exit(1);
}

echo "Connecting to MySQL at {$dbHost}:{$dbPort} as {$dbUser}...\n";
$mysqli = @new mysqli($dbHost, $dbUser, $dbPass, '', (int)$dbPort);
if ($mysqli->connect_errno) {
    fwrite(STDERR, "MySQL connection failed: ({$mysqli->connect_errno}) {$mysqli->connect_error}\n");
    exit(1);
}

$safeName = $mysqli->real_escape_string($dbName);
$sql = "CREATE DATABASE IF NOT EXISTS `{$safeName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($mysqli->query($sql)) {
    echo "Database '{$dbName}' created or already exists.\n";
    $dump = realpath(__DIR__ . '/../aeps_db.sql');
    if ($dump && file_exists($dump)) {
        echo "Note: SQL dump found at {$dump}. Import it via phpMyAdmin or mysql CLI (see README).\n";
    } else {
        echo "No SQL dump found in project root (aeps_db.sql). If you have one, import it into the new database.\n";
    }
    exit(0);
} else {
    fwrite(STDERR, "Failed to create database: " . $mysqli->error . "\n");
    exit(1);
}
