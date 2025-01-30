<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_cadastro = isset($_POST['instrutorNome']) ? $conexao->real_escape_string($_POST['instrutorNome']) : '';
    $email_cadastro = isset($_POST['instrutorEmail']) ? $conexao->real_escape_string($_POST['instrutorEmail']) : '';
    $senha_criptografada = isset($_POST['instrutorSenha']) ? password_hash($_POST['instrutorSenha'], PASSWORD_DEFAULT) : '';
    $tipo_cadastro = 'instrutor';  
    $especialidade_cadastro = isset($_POST['instrutorEspecialidade']) ? $conexao->real_escape_string($_POST['instrutorEspecialidade']) : '';


    $sql_verifica = "SELECT email_usuario FROM usuarios WHERE email_usuario = ?";
    $stmt_verifica = $conexao->prepare($sql_verifica);
    $stmt_verifica->bind_param('s', $email_cadastro);
    $stmt_verifica->execute();
    $stmt_verifica->store_result();

    if ($stmt_verifica->num_rows > 0) {
        echo "Erro: Este e-mail já está cadastrado!";
        exit;
    }


    $sql1 = "INSERT INTO usuarios (email_usuario, senha_usuario, tipo_usuario) VALUES (?, ?, ?)";
    $stmt1 = $conexao->prepare($sql1);
    $stmt1->bind_param('sss', $email_cadastro, $senha_criptografada, $tipo_cadastro);

    if (!$stmt1->execute()) {
        echo "Erro ao inserir na tabela usuarios: " . $stmt1->error;
        exit;
    }

    $sql2 = "INSERT INTO instrutor (instrutor_nome, instrutor_especialidade) VALUES (?, ?)";
    $stmt2 = $conexao->prepare($sql2);
    $stmt2->bind_param('ss', $nome_cadastro, $especialidade_cadastro);

    if (!$stmt2->execute()) {
        echo "Erro ao inserir na tabela instrutor: " . $stmt2->error;
        exit;
    }


    header('Location: instrutor.php');
    exit;
}
?>
