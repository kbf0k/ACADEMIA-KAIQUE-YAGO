<?php
require 'config.php';

session_start();

$sql = "SELECT * FROM aula";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Aulas</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../js/gerenciar_aulas.js"></script>
    <script src="../js/home.js" defer></script>
    <link rel="stylesheet" href="../css/gerenciar_aulas.css">
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
    <section id="tabela">
        <h2>GERENCIAR AULAS</h2>
        <table>
            <tr>
                <th>Tipo</th>
                <th>Data</th>
                <th>Instrutor</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['aula_tipo'] ?></td>
                    <td><?= $row['aula_data'] ?></td>
                    <td><?= $row['fk_instrutor_cod'] ?></td>
                    <td>
                        <button class="editar-btn" data-id="<?= $row['aula_cod'] ?>">Editar</button>
                        <button class="excluir-btn" data-id="<?= $row['aula_cod'] ?>">Excluir</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
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

<?php $conexao->close(); ?>