<?php
session_start();
require 'config.php'; // Arquivo de conexão com o banco de dados

$sql = "SELECT 
            aula.aula_cod, 
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

</head>
<header>
    <nav class="navbar">
        <a href="home.php"><img src="../img/logo_2.png" alt="" class="logo"></a>
        <ul>
            <li><a href="home.php">Início</a></li>

            <?php if (!isset($_SESSION['tipo_sessao'])): ?>
                <li><a href="aulas.php">Aulas</a></li>
            <?php else: ?>
                <?php if ($_SESSION['tipo_sessao'] === 'aluno'): ?>
                    <li><a href="aulas.php">Aulas</a></li>
                    <li><a href="alunos.php">Alunos</a></li>
                <?php elseif ($_SESSION['tipo_sessao'] === 'instrutor'): ?>
                    <li><a href="aulas.php">Aulas</a></li>
                    <li><a href="alunos.php">Alunos</a></li>
                    <li><a href="instrutor.php">Instrutores</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>

        <?php if (isset($_SESSION['nome_sessao'])): ?>
            <div class="usuario">
                <a href="#" id="nome_usuario">Olá, <?= htmlspecialchars($_SESSION['nome_sessao']) ?></a>
                <img id="logout" src="../img/logout.png" alt="Sair">
            </div>
        <?php else: ?>
            <a href="login.php" id="entrar">Entrar</a>
        <?php endif; ?>

        <div class="menu-icon">☰</div>
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
                <h2>SOBRE AS AULAS</h2>
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
            <h1>AULAS AGENDADAS</h1>
            <div class="aulas-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="aula-card">
                            <h3><?php echo htmlspecialchars($row['aula_tipo']); ?></h3>
                            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($row['aula_data'])); ?></p>
                            <p><strong>Instrutor:</strong> <?php echo htmlspecialchars($row['instrutor_nome'] ?: 'Não definido'); ?></p>
                            <p><strong>Aluno:</strong> <?php echo htmlspecialchars($row['aluno_nome'] ?: 'Não definido'); ?></p>

                            <?php if ($row['aluno_nome'] === null): ?>
                                <!-- Verifica se o usuário é um aluno e se a aula não tem aluno inscrito -->
                                <?php if (isset($_SESSION['tipo_sessao']) && $_SESSION['tipo_sessao'] === 'aluno' && $row['aluno_nome'] === null): ?>
                                    <button class="inscrever-btn" data-aula-id="<?php echo htmlspecialchars($row['aula_cod']); ?>">Quero me inscrever</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Não há aulas disponíveis no momento.</p>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['tipo_sessao']) && $_SESSION['tipo_sessao'] === 'instrutor'): ?>
                <div class="botao-container">
                    <button class="criar-btn">Criar Aula</button>
                    <a class="gerenciar-btn" href="gerenciar_aulas.php">Gerenciar Aulas</a>
                </div>
            <?php endif; ?>

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
        const menu = document.querySelector('.navbar ul');
        const menuIcon = document.querySelector('.menu-icon');

        menuIcon.addEventListener('click', () => {
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            } else {
                menu.classList.add('show');
            }
        });
    </script>

</body>

</html>