<?php 

$dsn = "mysql:host=localhost;dbname=blog";
$user = "root";
$password = "root";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($pdo === false) {
    echo 'Error connection' . $pdo->error_log();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $deleteArticle = $pdo->prepare('DELETE FROM article WHERE id=:id');
    $deleteArticle->execute(['id' => $id]);
    header('Location: http://localhost:8000');
}
// ARTICLE EN PARTICLULIER => id 