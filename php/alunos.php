<?php
include('config.php');
session_start();

// Consulta com filtro de pesquisa
$sql = "SELECT a.fk_aluno_cod, al.aluno_nome, a.aula_tipo 
        FROM aula a
        JOIN aluno al ON a.fk_aluno_cod = al.aluno_cod";

$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos da Hyperforce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link rel="stylesheet" href="../css/alunos.css">
    <script src="../js/alunos.js" defer></script>
</head>

<body>
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

    <div class="container mt-4">
        <h2 class="text-center">Alunos</h2>

        <!-- Botão para abrir o modal de adicionar aluno -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarAluno">Adicionar Aluno</button>

        <!-- Lista de Alunos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['aluno_nome']) ?></td>
                        <td><?= htmlspecialchars($row['aula_tipo']) ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-editar"
                                data-id="<?= $row['fk_aluno_cod'] ?>"
                                data-nome="<?= htmlspecialchars($row['aluno_nome']) ?>"
                                data-curso="<?= htmlspecialchars($row['aula_tipo']) ?>"
                                data-bs-toggle="modal" data-bs-target="#modalEditarAluno">Editar</button>

                            <a href="excluir_aluno.php?id=<?= $row['fk_aluno_cod'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Adicionar Aluno -->
    <div class="modal fade" id="modalAdicionarAluno" tabindex="-1" aria-labelledby="modalAdicionarAlunoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdicionarAlunoLabel">Adicionar Aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="adicionar_aluno.php" method="POST">
                        <div class="mb-3">
                            <label for="alunoNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="alunoNome" required>
                        </div>
                        <div class="mb-3">
                            <label for="alunoCurso" class="form-label">Curso</label>
                            <input type="text" class="form-control" name="alunoCurso" required>
                        </div>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Aluno -->
    <div class="modal fade" id="modalEditarAluno" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="editar_aluno.php" method="POST">
                        <input type="hidden" id="alunoId" name="alunoId">
                        <div class="mb-3">
                            <label for="alunoNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="alunoNomeInput" name="alunoNome" required>
                        </div>
                        <div class="mb-3">
                            <label for="alunoCurso" class="form-label">Curso</label>
                            <input type="text" class="form-control" id="alunoCursoInput" name="alunoCurso" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para preenchimento dos modais -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editarButtons = document.querySelectorAll(".btn-editar");

            editarButtons.forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("alunoId").value = this.dataset.id;
                    document.getElementById("alunoNomeInput").value = this.dataset.nome;
                    document.getElementById("alunoCursoInput").value = this.dataset.curso;
                });
            });
        });
    </script>

</body>

</html>