<?php
session_start();
include 'bd.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmSenha = $_POST['confirm_password'];

    if ($senha !== $confirmSenha) {
        $errorMessage = "As senhas não estão iguais!";
    } else {
        
        $hashedSenha = password_hash($senha, PASSWORD_BCRYPT);

        try {
            
            $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hashedSenha]);

            $_SESSION['usuario'] = $email;
            setcookie('username', $nome, time() + 3600);
            header('Location: autenticar.php');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errorMessage = "E-mail já cadastrado!";
            } else {
                $errorMessage = "Erro ao registrar o usuário: " . $e->getMessage();
            }
        }
    }
}

include 'registrar.html';
?>

