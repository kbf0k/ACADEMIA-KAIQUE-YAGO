<?php
// Incluir arquivo de configuração
include('config.php');
session_start();  // Iniciar a sessão

$sql = "SELECT aluno_cod, aluno_nome, aluno_cpf, aluno_telefone FROM aluno";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="../js/alunos.js" defer></script>
    <link rel="stylesheet" href="../css/alunos.css">
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
        <div class="container">
            <h2>LISTA DE ALUNOS</h2>
            <?php
            if ($result) {
                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["aluno_nome"] . "</td>
                                <td>" . $row["aluno_cpf"] . "</td>
                                <td>" . $row["aluno_telefone"] . "</td>
                                <td>
                                    <a href='editar_aluno.php?id=" . $row["aluno_cod"] . "' class='btn btn-warning btn-sm'>Editar</a>
                                    <a href='excluir_aluno.php?id=" . $row["aluno_cod"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                                </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>Nenhum aluno encontrado.</p>";
                }
            } else {
                echo "<p>Erro ao executar a consulta: " . $conexao->error . "</p>";
            }

            $conexao->close();
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </main>
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