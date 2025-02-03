<?php
require 'config.php';

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
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Gerenciar Aulas</h2>

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

</body>
</html>

<?php $conexao->close(); ?>
