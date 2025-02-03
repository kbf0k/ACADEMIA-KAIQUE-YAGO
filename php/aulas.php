<?php
session_start();
require 'config.php'; // Arquivo de conexão com o banco de dados

$sql = "SELECT 
            aula.aula_tipo, 
            aula.aula_data, 
            instrutor.instrutor_nome, 
            aluno.aluno_nome 
        FROM aula 
        LEFT JOIN instrutor ON aula.fk_instrutor_cod = instrutor.instrutor_cod 
        LEFT JOIN aluno ON aula.fk_aluno_cod = aluno.aluno_cod";

$result = $conexao->query($sql);

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link rel="stylesheet" href="../css/aulas.css">
    <script src="../js/aulas.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <style>
        /* BENEFICIOS */
        #beneficios {
            padding: 50px 20px;
            text-align: center;
            background: linear-gradient(360deg, white, #00356d3d);
            width: 100%;
        }
        
        #beneficios h1 {
            font-size: 40px;
            color: #00356d;
            margin-bottom: 30px;
        }
        
        #beneficios h1 span {
            color: #007BFF;
            font-weight: bold;
            font-style: italic;
            transition: 0.5s ease-in-out;
            text-shadow: 2px 2px rgba(0, 0, 0, 0.86);
        }
        
        #beneficios_container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            justify-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
            width: 250px;
        }
        
        .card:hover {
            transform: translateY(-10px);
        }
        
        .card img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 20px;
        }
        
        .card h3 {
            font-size: 22px;
            color: #00356d;
            margin-bottom: 15px;
        }
        
        .card p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        #aulas {
            background: linear-gradient(180deg, white, #00356d);
            width: 100%;
            text-align: center;
            padding: 70px;
        }
        #aulas h1 {
            font-size: 40px;
            color: #007BFF;
            text-shadow: 2px 2px rgba(0, 0, 0, 0.86);
            margin-bottom: 25px;
        }

        .aulas-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .aula-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            transition: transform 0.2s ease-in-out;
        }

        .aula-card:hover {
            transform: scale(1.05);
        }

        .aula-card h3 {
            color: #00356d;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .aula-card p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .criar-btn {
            display: block;
            width: 40%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .criar-btn:hover {
            background: #0056b3;
        }
    </style>

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
        <!-- Seção inicial melhorada -->
        <section id="home">
            <div id="home_texto">
                <h1>BEM-VINDO À</h1>
                <span>AULAS</span>
                <p>Transforme sua vida com bem-estar e fitness</p>
                <p>Oferecemos uma experiência única para você</p>
                <a href="#aulas" class="saiba_mais">Ver Aulas Agendadas</a>
            </div>
        </section>

        <section id="sobre">
            <div class="sobre-container">
                <h2>Sobre as Aulas</h2>
                <p>As aulas são oferecidas por instrutores altamente qualificados para garantir sua evolução no bem-estar e saúde.</p>
                <p>Explore nossas opções e agende sua participação para aproveitar os benefícios de um treinamento planejado.</p>
            </div>
        </section>

        <section id="beneficios">
            <h1>DESCUBRA OS <span>BENEFÍCIOS</span> DAS NOSSAS AULAS</h1>
            <div id="beneficios_container">
                <div class="card">
                    <img src="../img/icone_musculo.png" alt="Força muscular">
                    <h3>Ganho de Força Muscular</h3>
                    <p>Ao praticar musculação, você fortalece os músculos, melhora a postura e aumenta sua resistência física.</p>
                </div>
                <div class="card">
                    <img src="../img/icone_saude.png" alt="Vida Mais Saudável">
                    <h3>Vida Mais Saudável</h3>
                    <p>Com a prática regular de exercícios, você melhora sua saúde geral, prevenindo doenças e promovendo o bem-estar físico e mental.</p>
                </div>
                <div class="card">
                    <img src="../img/icone_flexi.png" alt="Flexibilidade">
                    <h3>Aumento da Flexibilidade</h3>
                    <p>As aulas de yoga e alongamento promovem maior flexibilidade e evitam lesões, além de trazerem equilíbrio mental.</p>
                </div>
                <div class="card">
                    <img src="../img/icone_queima-caloria.png" alt="Queima de calorias">
                    <h3>Queima de Calorias</h3>
                    <p>Com treinos de alta intensidade, você acelera a queima de calorias, contribuindo para o emagrecimento e condicionamento físico.</p>
                </div>
            </div>
        </section>

        <!-- Seção de Aulas Agendadas -->
        <section id="aulas">
            <h1>Aulas Agendadas</h1>
            <div class="aulas-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="aula-card">
                            <h3><?php echo htmlspecialchars($row['aula_tipo']); ?></h3>
                            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($row['aula_data'])); ?></p>
                            <p><strong>Instrutor:</strong> <?php echo htmlspecialchars($row['instrutor_nome'] ?: 'Não definido'); ?></p>
                            <p><strong>Aluno:</strong> <?php echo htmlspecialchars($row['aluno_nome'] ?: 'Não definido'); ?></p>                        
                        </div>
                        
                        <?php endwhile; ?>
                        <?php else: ?>
                            <p>Nenhuma aula agendada.</p>
                            <?php endif; ?>
                        </div>
                        <button class="criar-btn">Criar Aula</button>
                        <button class="gerenciar-btn">Gerenciar Aulas</button>
                        <!-- Modal de inscrição -->
                        <div id="inscricaoModal" class="modal"> 
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Cadastrar Nova Aula</h2>
                                <form id="formAula">
                                    <label for="aula_tipo">Tipo de Aula:</label>
                                    <select id="aula_tipo" required>
                                        <!-- As opções serão preenchidas com os dados do banco -->
                                    </select><br><br>
                        
                                    <label for="aula_data">Data da Aula:</label>
                                    <input type="date" id="aula_data" required><br><br>
                        
                                    <label for="instrutor">Instrutor:</label>
                                    <select id="instrutor" required>
                                        <!-- As opções serão preenchidas com os dados do banco -->
                                    </select><br><br>
                        
                                    <button type="submit">Cadastrar Aula</button>
                                </form>
                            </div>
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