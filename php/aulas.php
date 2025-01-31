<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link rel="stylesheet" href="../css/home.css">
    <script src="../js/home.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

</head>
<header>
    <nav class="navbar">
        <a href="home.php"><img src="../img/logo3.png" alt="" class="logo"></a>
        <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="alunos.php">Alunos</a></li>
            <li><a href="instrutor.php">Instrutores</a></li>
            <li><a href="aulas.php">Aulas</a></li>
        </ul>

        <?php if (isset($_SESSION['nome_sessao'])): ?>
            <div class="usuario">
                <a href="#" id="nome_usuario">Olá, <?= htmlspecialchars($_SESSION['nome_sessao']) ?></a>
                <img id="logout" src="../img/logout.png" alt="">
            </div>
        <?php else: ?>
            <a href="login.php" id="entrar">Entrar</a>
            <div class="menu-icon" onclick="toggleMenu()">☰</div>
        <?php endif; ?>
    </nav>

</header>

<body>
    <main>
        <section id="home">
            <div id="home_texto">
                <h1>BEM-VINDO À</h1>
                <span>AULAS</span>
                <p>YAGO É PIKA.</p>
                <p>Oferecemos uma experiência única em bem-estar e fitness</p>
                <a href="#sobre" class="saiba_mais">Saiba mais</a>
            </div>
        </section>
    </main>

    <div class="footer">
        <p>&copy; 2025 HYPERFORCE - Todos os direitos reservados.</p>
    </div>
    <script>
        function toggleMenu() {
            document.querySelector(".navbar ul").classList.toggle("show");
        }
    </script>

</body>

</html>