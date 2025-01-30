<?php
include('config.php');
include('header.php');

// Consulta todos os instrutores cadastrados
$sql = "SELECT * FROM instrutor";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Instrutores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Gerenciamento de Instrutores</h2>


    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarInstrutor">Adicionar Instrutor</button>

    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['instrutor_nome']) ?></td>
                    <td><?= htmlspecialchars($row['instrutor_especialidade']) ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn-editar" 
                                data-id="<?= $row['instrutor_cod'] ?>" 
                                data-nome="<?= htmlspecialchars($row['instrutor_nome']) ?>" 
                                data-especialidade="<?= htmlspecialchars($row['instrutor_especialidade']) ?>" 
                                data-bs-toggle="modal" data-bs-target="#modalEditarInstrutor">Editar</button>
                        
                        <a href="excluir_instrutor.php?id=<?= $row['instrutor_cod'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Adicionar Instrutor -->
<div class="modal fade" id="modalAdicionarInstrutor" tabindex="-1" aria-labelledby="modalAdicionarInstrutorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarInstrutorLabel">Adicionar Instrutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="adicionar_instrutor.php" method="POST">
                    <div class="mb-3">
                        <label for="instrutorNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="instrutorNome" required>
                    </div>
                    <div class="mb-3">
                        <label for="instrutorEspecialidade" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" name="instrutorEspecialidade" required>
                    </div>
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Instrutor -->
<div class="modal fade" id="modalEditarInstrutor" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Instrutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="editar_instrutor.php" method="POST">
                    <input type="hidden" id="instrutorId" name="instrutorId">
                    <div class="mb-3">
                        <label for="instrutorNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="instrutorNomeInput" name="instrutorNome" required>
                    </div>
                    <div class="mb-3">
                        <label for="instrutorEspecialidade" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" id="instrutorEspecialidadeInput" name="instrutorEspecialidade" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const editarButtons = document.querySelectorAll(".btn-editar");

    editarButtons.forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("instrutorId").value = this.dataset.id;
            document.getElementById("instrutorNomeInput").value = this.dataset.nome;
            document.getElementById("instrutorEspecialidadeInput").value = this.dataset.especialidade;
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

/* Tabela de Instrutores */
.table {
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
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
    .table th, .table td {
        font-size: 14px;
        padding: 10px;
    }
}

</style>