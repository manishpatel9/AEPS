<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=xpaeps_db', 'root', '');
    $sql = "ALTER TABLE kyc_documents ADD COLUMN IF NOT EXISTS document_number VARCHAR(100) NULL AFTER document_path";
    $pdo->exec($sql);
    echo "OK\n";
} catch (Exception $e) {
    echo 'ERR: '.$e->getMessage()."\n";
}
