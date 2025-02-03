<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
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
                <span>HYPERFORCE</span>
                <p>Transforme seu corpo e mente conosco.</p>
                <p>Oferecemos uma experiência única em bem-estar e fitness</p>
                <a href="#sobre" class="saiba_mais">Saiba mais</a>
            </div>
        </section>

        <section id="sobre">
            <div id="sobre_text">
                <h2>Sobre Nós</h2>
                <h1>SOMOS A <span>HYPERFORCE</span></h1>
                <p>A Hyperforce nasceu para revolucionar o mercado fitness, oferecendo inovação e acessibilidade.
                    Com uma estrutura moderna e instrutores qualificados, proporcionamos a melhor experiência em treino e bem-estar.</p>
                <a href="#servicos" class="saiba_mais">Saiba Mais</a>
            </div>
            <img class="img-sobre" src="../img/logo.png" alt="Academia">
        </section>

        <section id="servicos">
    <h1>EXPLORE NOSSOS <span>SERVIÇOS</span></h1>
    <div id="servicos_container">
        <div class="card">
            <img src="../img/icone_musculaçao.png" alt="Musculação">
            <h3>Musculação</h3>
            <p>Equipamentos modernos e acompanhamento profissional para atingir seus objetivos.</p>
        </div>
        <div class="card">
            <img src="../img/icone_crossfit.png" alt="Crossfit">
            <h3>Crossfit</h3>
            <p>Treinamento de alta intensidade para quem busca força e resistência.</p>
        </div>
        <div class="card">
            <img src="../img/icone_yoga.png" alt="Yoga">
            <h3>Yoga</h3>
            <p>Conecte mente e corpo com nossas aulas de Yoga para todos os níveis.</p>
        </div>
        <div class="card">
            <img src="../img/icone_zumba.png" alt="Zumba">
            <h3>Zumba</h3>
            <p>Dança animada e divertida para queimar calorias com alegria.</p>
        </div>
        <div class="card">
            <img src="../img/icone_pilates2.png" alt="Pilates">
            <h3>Pilates</h3>
            <p>Fortaleça seu corpo com exercícios que melhoram a postura e flexibilidade.</p>
        </div>
        <div class="card">
            <img src="../img/icone_personal.png" alt="Personal Trainer">
            <h3>Personal Trainer</h3>
            <p>Treinos exclusivos e acompanhamento personalizado para seus objetivos.</p>
        </div>
    </div>
    <div class="botao-container">
        <a href="aulas.php" class="botao-ver-mais">Ver todas as aulas</a>
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