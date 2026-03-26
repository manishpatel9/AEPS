<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=aeps_db;charset=utf8mb4','root','');
foreach($pdo->query('select email,role from users limit 50') as $r){
    echo $r['email'].' | '.$r['role'].PHP_EOL;
}
