<?php
session_start();
include 'bd.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        
        $stmt = $pdo->prepare("SELECT nome, senha FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $email;
            setcookie('username', $user['name'], time() + 3600);
            header('Location: autenticar.php');
            exit();
        } else {
            $errorMessage = "Credenciais inválidas!";
        }
    } catch (PDOException $e) {
        $errorMessage = "Erro ao processar o login: " . $e->getMessage();
    }
}

include 'index.html';
?>

