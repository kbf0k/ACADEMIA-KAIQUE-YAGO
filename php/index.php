<?php
session_start();
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyperforce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
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
                    <?php if (isset($_SESSION['usuario_nome'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Seção de Boas-Vindas -->
    <div class="container mt-5 text-center">
        <h1>Bem-vindo à HYPERFORCE</h1>
        <p>Transforme seu corpo e mente conosco. Oferecemos uma experiência única em bem-estar e fitness.</p>
    </div>

    <!-- Sobre a Academia -->
    <div class="container mt-5">
        <h2 class="section-title text-center">Sobre Nós</h2>
        <div class="about-container">
            <div class="about-text">
                <p>A Hyperforce é um centro de treinamento moderno e inovador, dedicado a ajudar você a alcançar seus objetivos de saúde e fitness. Contamos com uma infraestrutura completa e uma equipe de instrutores altamente qualificados que estão prontos para apoiar sua jornada.</p>
                <p>Nosso compromisso é fornecer um ambiente motivador e acolhedor para todos os nossos alunos, oferecendo aulas diversificadas, equipamentos de última geração e um atendimento personalizado.</p>
            </div>
            <div class="about-image">
                <img src="./img/logo4.png" alt="" class="about-img">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="section-title text-center">Explore Nossos Serviços</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="service-box" style="background-image: url('./img/woman-gym-body-building.jpg');">
                    <div class="overlay">
                        <h4>Treinamento Personalizado</h4>
                        <p>Desenvolva sua melhor versão com acompanhamento exclusivo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box" style="background-image: url('imagem2.jpg');">
                    <div class="overlay">
                        <h4>Equipamentos de Última Geração</h4>
                        <p>Treine com o melhor equipamento para resultados rápidos e eficientes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box" style="background-image: url('imagem3.jpg');">
                    <div class="overlay">
                        <h4>Saúde e Bem-estar</h4>
                        <p>Cuide da sua saúde com nosso acompanhamento completo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include('footer.php'); ?>

</body>

</html>