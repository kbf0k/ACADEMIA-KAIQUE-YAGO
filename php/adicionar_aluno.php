<?php
include('config.php');

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $nome = $conexao->real_escape_string($_POST['instrutorNome']);
    $especialidade = $conexao->real_escape_string($_POST['instrutorEspecialidade']);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO instrutor (instrutor_nome, instrutor_especialidade) VALUES ('$nome', '$especialidade')";
    
    if ($conexao->query($sql) === TRUE) {
        header('Location: alunos.php'); // Redireciona após a inserção
        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}
?>
