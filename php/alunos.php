<?php
include('config.php');

// Verificar se foi feito algum filtro de pesquisa
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta com filtro de pesquisa
$sql = "SELECT * FROM aluno WHERE aluno_nome LIKE '%$search%'";
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
    <link rel="stylesheet" href="../css/alunos.css">
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

    <div class="container mt-4">
        <h2 class="text-center">Alunos</h2>

        <!-- Campo de pesquisa -->
        <form method="GET" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome ou curso" value="<?= htmlspecialchars($search) ?>">
        </form>

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
                        <td><?= htmlspecialchars($row['aluno_curso']) ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-editar"
                                data-id="<?= $row['aluno_cod'] ?>"
                                data-nome="<?= htmlspecialchars($row['aluno_nome']) ?>"
                                data-curso="<?= htmlspecialchars($row['aluno_curso']) ?>"
                                data-bs-toggle="modal" data-bs-target="#modalEditarAluno">Editar</button>

                            <a href="excluir_aluno.php?id=<?= $row['aluno_cod'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
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

<style>
    /* Estilo geral */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        color: #333;
    }

    /* Cabeçalho */
    h2 {
        color: #007bff;
        margin-bottom: 20px;
    }

    /* Tabela de Alunos */
    .table {
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        text-align: center;
        padding: 15px;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    /* Botões */
    .btn {
        transition: background-color 0.3s ease;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Modal */
    .modal-content {
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .modal-header .btn-close {
        background-color: #fff;
        border: none;
        color: #007bff;
    }

    .modal-header .btn-close:hover {
        color: #0056b3;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body .form-label {
        font-weight: bold;
    }

    .modal-body .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 15px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
    }

    /* Responsividade */
    @media (max-width: 768px) {

        .table th,
        .table td {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>