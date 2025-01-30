<?php
include('config.php');

// Verifica se o ID do instrutor foi passado via POST
if (isset($_POST['instrutorId'])) {
    $instrutorId = $conexao->real_escape_string($_POST['instrutorId']);
    $nome = $conexao->real_escape_string($_POST['instrutorNome']);
    $especialidade = $conexao->real_escape_string($_POST['instrutorEspecialidade']);

    // Atualiza os dados no banco de dados
    $sql = "UPDATE instrutor SET instrutor_nome = '$nome', instrutor_especialidade = '$especialidade' WHERE instrutor_cod = $instrutorId";
    
    if ($conexao->query($sql) === TRUE) {
        // Redireciona para a página instrutor.php após a edição
        header('Location: instrutor.php');
        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}
?>
