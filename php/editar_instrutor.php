<?php
include('config.php');


if (isset($_POST['instrutorId'])) {
    $instrutorId = $conexao->real_escape_string($_POST['instrutorId']);
    $nome = $conexao->real_escape_string($_POST['instrutorNome']);
    $especialidade = $conexao->real_escape_string($_POST['instrutorEspecialidade']);

   
    $sql = "UPDATE instrutor SET instrutor_nome = '$nome', instrutor_especialidade = '$especialidade' WHERE instrutor_cod = $instrutorId";
    
    if ($conexao->query($sql) === TRUE) {
     
        header('Location: instrutor.php');
        exit;
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
}
?>