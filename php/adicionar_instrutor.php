<?php
include('config.php');

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $nome_cadastro = isset($_POST['instrutorNome']) ? $conexao->real_escape_string($_POST['instrutorNome']) : '';
    $email_cadastro = isset($_POST['instrutorEmail']) ? $conexao->real_escape_string($_POST['instrutorEmail']) : '';
    $senha_criptografada = isset($_POST['instrutorSenha']) ? password_hash($conexao->real_escape_string($_POST['instrutorSenha']), PASSWORD_DEFAULT) : '';
    $tipo_cadastro = 'instrutor';  // Tipo de usuário fixo como instrutor
    $especialidade_cadastro = isset($_POST['instrutorEspecialidade']) ? $conexao->real_escape_string($_POST['instrutorEspecialidade']) : '';


    // 1. Inserir o usuário na tabela usuarios
    $sql1 = "INSERT INTO usuarios (email_usuario, senha_usuario, tipo_usuario) VALUES (?, ?, ?)";
    $stmt1 = $conexao->prepare($sql1);
    $stmt1->bind_param('sss', $email_cadastro, $senha_criptografada, $tipo_cadastro);
    if (!$stmt1->execute()) {
        echo "Erro ao inserir na tabela usuarios: " . $stmt1->error;
        exit;
    }

    $id_usuario = $stmt1->insert_id; // Obter o ID do novo usuário

    // 2. Inserir os dados do instrutor na tabela instrutor
    $sql2 = "INSERT INTO instrutor (usuario_id, instrutor_nome, instrutor_especialidade) VALUES (?, ?, ?)";
    $stmt2 = $conexao->prepare($sql2);
    $stmt2->bind_param('iss', $id_usuario, $nome_cadastro, $especialidade_cadastro);
    if (!$stmt2->execute()) {
        echo "Erro ao inserir na tabela instrutor: " . $stmt2->error;
        exit;
    }

    // Redireciona após a inserção
    header('Location: instrutor.php');
    exit;
}
?>
