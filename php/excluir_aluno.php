<?php
// Incluir arquivo de configuração
include('config.php');
session_start();

// Verificar se o ID do aluno foi passado via URL
if (isset($_GET['id'])) {
    $aluno_id = $_GET['id'];

    // Excluir as referências na tabela 'aula'
    $sql_delete_aula = "DELETE FROM aula WHERE fk_aluno_cod = $aluno_id";
    if ($conexao->query($sql_delete_aula) === TRUE) {
        // Excluir o aluno
        $sql_delete_aluno = "DELETE FROM aluno WHERE aluno_cod = $aluno_id";
        if ($conexao->query($sql_delete_aluno) === TRUE) {
            echo "Aluno excluído com sucesso!";
            header("Location: alunos.php"); // Redirecionar de volta para a lista
            exit;
        } else {
            echo "Erro ao excluir o aluno: " . $conexao->error;
        }
    } else {
        echo "Erro ao excluir as referências na tabela aula: " . $conexao->error;
    }
} else {
    echo "ID não especificado!";
}

// Fechar a conexão
$conexao->close();
?>