<?php
include('config.php');

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $instrutorId = $conexao->real_escape_string($_GET['id']);

    // Deleta o instrutor do banco de dados
    $sql = "DELETE FROM instrutor WHERE instrutor_cod = $instrutorId";
    
    if ($conexao->query($sql) === TRUE) {
        // Redireciona para a página instrutor.php após a exclusão
        header('Location: instrutor.php');
        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}
?>
