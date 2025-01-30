<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Academia</title>
    <link rel="stylesheet" href="../css/home.css">
    <style>

    </style>
</head>
<nav class="navbar">
    <a href="home.php"><img src="../img/logo3.png" alt="" class="logo"></a>
    <ul>
        <li><a href="alunos.php">Alunos</a></li>
        <li><a href="instrutor.php">Instrutores</a></li>
        <li><a href="aula.php">Aulas</a></li>
    </ul>
    <a href="#" class="button">Buscar Academia</a>
    <div class="menu-icon" onclick="toggleMenu()">☰</div>
</nav>
<body>

<!-- CONTEÚDO PRINCIPAL -->
<div class="container">
    <div class="bem-vindo">
        <h1>Bem-vindo à <span>HYPERFORCE</span></h1>
        <p>Transforme seu corpo e mente conosco. <br> 
           Oferecemos uma experiência única em bem-estar e fitness.</p>
    </div>

    <div class="sobre">
        <div class="sobre-text">
            <h2>Sobre Nós</h2>
            <h1>SOMOS A <span>HYPERFORCE</span></h1>
            <p>
                A Hyperforce nasceu para revolucionar o mercado fitness, oferecendo inovação e acessibilidade. 
                Com uma estrutura moderna e instrutores qualificados, proporcionamos a melhor experiência em treino e bem-estar.
            </p>
            <a href="#" class="btn">Saiba Mais</a>
    
        </div>
        <img class="img-sobre" src="../img/logo.png" alt="Academia">
    </div>
    
    <h2>Explore Nossos Serviços</h2>
    <div class="services">
        <div class="card">
            <img src="musculacao.jpg" alt="Musculação">
            <h3>Musculação</h3>
            <p>Equipamentos modernos e acompanhamento profissional para atingir seus objetivos.</p>
        </div>
        <div class="card">
            <img src="crossfit.jpg" alt="Crossfit">
            <h3>Crossfit</h3>
            <p>Treinamento de alta intensidade para quem busca força e resistência.</p>
        </div>
        <div class="card">
            <img src="yoga.jpg" alt="Yoga">
            <h3>Yoga</h3>
            <p>Conecte mente e corpo com nossas aulas de Yoga para todos os níveis.</p>
        </div>
    </div>
        
    </div>

<!-- RODAPÉ -->
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
