<?php
$dsn = 'mysql:host=localhost;dbname=banco';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Falha na conexão: ' . $e->getMessage());
}
?>

