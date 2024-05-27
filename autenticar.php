<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado!";
    exit();
}

$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : 'Usuário';
include 'telinha.html';
?>
