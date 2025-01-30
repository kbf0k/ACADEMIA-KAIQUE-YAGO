<?php include('header.php');
include('config.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hyperforce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .section-title {
            color: #007bff;
            margin-bottom: 20px;
        }

        .feature-icon {
            font-size: 40px;
            color: #007bff;
        }

        .feature-box {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .feature-box:hover {
            transform: scale(1.05);
        }

        .feature-box h4 {
            margin-top: 10px;
            font-weight: bold;
        }

        .about-img {
            max-width: 100%;
            border-radius: 8px;
        }

        .about-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .about-text {
            flex: 1;
            padding: 20px;
        }

        .about-image {
            flex: 1;
            padding: 20px;
        }

        .testimonial-carousel img {
            max-width: 80px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .testimonial {
            text-align: center;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .testimonial p {
            font-style: italic;
        }
        
        /* Estilo geral da caixa */
        .service-box {
            position: relative;
            height: 250px;
            margin-bottom: 20px;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Overlay (camada de opacidade) */
        .service-box .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Opacidade inicial */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        /* Efeito de hover na caixa */
        .service-box:hover .overlay {
            opacity: 1; /* Mostra a overlay quando o mouse passa por cima */
        }

        /* Títulos e textos */
        .service-box h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .service-box p {
            font-size: 16px;
        }

    </style>
</head>
<body>

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

