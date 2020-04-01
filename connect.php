<?php 

$dsn = "mysql:host=localhost;dbname=blog";
$user = "root";
$password = "root";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($pdo === false) {
    echo 'Error connection' . $pdo->error_log();
}