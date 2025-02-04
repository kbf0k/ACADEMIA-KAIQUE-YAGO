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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alunos.js" defer></script>
    <link rel="stylesheet" href="../css/alunos.css">
</head>

<body>
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
                                <td>" . htmlspecialchars($row["aluno_nome"]) . "</td>
                                <td>" . htmlspecialchars($row["aluno_cpf"]) . "</td>
                                <td>" . htmlspecialchars($row["aluno_telefone"]) . "</td>
                                <td>
                                    <a href='editar_aluno.php?id=" . $row["aluno_cod"] . "' class='btn btn-warning btn-sm'>Editar</a>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='" . $row["aluno_cod"] . "'>Excluir</button>
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
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Adiciona o evento de clique apenas quando o botão "Excluir" for clicado
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let alunoId = this.getAttribute('data-id');
                    confirmDeletion(alunoId);
                });
            });
        });
    </script>
</body>
</html>
