<?php
// Incluir arquivo de configuração
include('config.php');
session_start();

// Verificar se o ID do aluno foi passado via URL
if (isset($_GET['id'])) {
    $aluno_id = $_GET['id'];

    // Consultar os dados do aluno com o ID fornecido
    $sql = "SELECT * FROM aluno WHERE aluno_cod = $aluno_id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Aluno não encontrado!";
        exit;
    }
} else {
    echo "ID não especificado!";
    exit;
}

// Processar o formulário de atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    $sql_update = "UPDATE aluno SET aluno_nome = ?, aluno_cpf = ?, aluno_telefone = ? WHERE aluno_cod = ?";
    $stmt = $conexao->prepare($sql_update);
    $stmt->bind_param("sssi", $nome, $cpf, $telefone, $aluno_id);

    if ($stmt->execute()) {
        header("Location: alunos.php");
        exit;
    } else {
        echo "Erro ao atualizar o aluno: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../css/editar_aluno.css">
</head>
<body>
    <h2>Editar Aluno</h2>
    <form method="post" action="">
        Nome: <input type="text" name="nome" value="<?php echo $row['aluno_nome']; ?>"><br>
        CPF: <input type="text" name="cpf" value="<?php echo $row['aluno_cpf']; ?>"><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $row['aluno_telefone']; ?>"><br>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>