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
    <script src="../js/home.js" defer></script>
    <link rel="stylesheet" href="../css/aulas.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-top: 30px;
            font-size: 32px;
            color: #007BFF;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #007BFF;
            color: #fff;
            font-weight: bold;
        }

        td {
            color: #555;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 8px 16px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .editar-btn {
            background-color: #28a745;
            color: white;
        }

        .editar-btn:hover {
            background-color: #218838;
        }

        .excluir-btn {
            background-color: #dc3545;
            color: white;
        }

        .excluir-btn:hover {
            background-color: #c82333;
        }

        #tabela {
            display: flex;
            justify-content: center;
            align-items: baseline;
            flex-direction: column;
            height: 100vh;
            width: 100%;
            text-align: center;
            color: white;
            position: sticky;
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


</body>
</html>

<?php $conexao->close(); ?>

