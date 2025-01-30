<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - HYPERFORCE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
        }
        .about-image {
            position: relative;
            width: 50%;
            max-width: 500px;
        }
        .about-image img {
            width: 100%;
            border-radius: 10px;
            display: block;
        }
        .about-text {
            width: 50%;
            text-align: left;
        }
        .about-text h2 {
            font-size: 16px;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .about-text h1 {
            font-size: 36px;
            font-weight: bold;
            color: #222;
        }
        .about-text h1 span {
            color: #ff6600;
            font-style: italic;
        }
        .about-text p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #ff6600;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #e65500;
        }
        /* Elementos gráficos (os X laranjas) */
        .graphic {
            position: absolute;
            top: -10px;
            left: -10px;
            font-size: 30px;
            color: #ff6600;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
            }
            .about-image,
            .about-text {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="about-image">
            <span class="graphic">✖✖✖</span>
            <img src="academia.jpg" alt="Academia">
        </div>
        <div class="about-text">
            <h2>Sobre Nós</h2>
            <h1>SOMOS A <span>HYPERFORCE</span></h1>
            <p>
                A Hyperforce nasceu para revolucionar o mercado fitness, oferecendo inovação e acessibilidade. 
                Com uma estrutura moderna e instrutores qualificados, proporcionamos a melhor experiência em treino e bem-estar.
            </p>
            <a href="#" class="btn">Saiba Mais</a>
        </div>
    </div>

</body>
</html>
