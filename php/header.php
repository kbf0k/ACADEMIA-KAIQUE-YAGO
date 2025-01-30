<?php session_start(); 
 include('config.php');?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia - Gerenciamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
    img {
        width: 100px;
        height: 100px;
        margin-right: 10px;
        border-radius: 50%;
        object-fit: cover;
        background-color: white;
    }

    .nav-item {
        margin-right: 40px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <img src="../img/logo2.png" alt="">
        <a class="navbar-brand" href="index.php">Hyperforce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="alunos.php">Alunos</a></li>
                <li class="nav-item"><a class="nav-link" href="instrutor.php">Instrutores</a></li>
                <li class="nav-item"><a class="nav-link" href="aulas.php">Aulas</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['usuario'])) { ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
