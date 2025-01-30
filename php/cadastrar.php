<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome_cadastro = $_POST['nome_cadastrar'];
    $email_cadastro = $_POST['email_cadastrar'];
    $cpf_cadastro = $_POST['cpf_cadastrar'];
    $endereco_cadastro = $_POST['endereco_cadastrar'];
    $telefone_cadastro = $_POST['telefone_cadastrar'];
    $nascimento_cadastro = $_POST['nascimento_cadastrar'];
    $senha_cadastro = $_POST['senha_cadastrar'];
    $tipo_cadastro = $_POST['tipo_cadastrar'];

    $sql1 = "INSERT INTO usuarios(email_usuario, senha_usuario, tipo_usuario) VALUES (?, ?, ?)";
    $stmt1 = $conexao->prepare($sql1);
    $stmt1->bind_param('sss', $email_cadastro, $senha_cadastro, $tipo_cadastro);
    $stmt1->execute();

    $sql2 = "INSERT INTO aluno(aluno_cod, aluno_nome, aluno_email, aluno_cpf, aluno_endereco, aluno_telefone, aluno_nasc, aluno_senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conexao->prepare($sql2);
    $stmt2->bind_param('issssiss', $id_usuario, $nome_cadastro, $email_cadastro, $cpf_cadastro, $endereco_cadastro, $telefone_cadastro, $nascimento_cadastro, $senha_cadastro);
    $stmt2->execute();

    $cadastro_sucesso = true;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <title>Cadastrar</title>
</head>

<body>
    <main id="main-cadastrar">
        <div class="container">
            <form action="" method="post" id="cadastrar">
                <span><a id="cadastrar-voltar" href="login.php">Voltar</a></span>
                <img src="../img/logo.png" alt="" id="logo">
                <h1>Cadastra-se</h1>

                <label for="nome_cadastrar">Nome</label>
                <input type="text" id="nome_cadastrar" name="nome_cadastrar" required placeholder="Digite seu Nome">

                <label for="email_cadastrar">Email</label>
                <input type="email" id="email_cadastrar" name="email_cadastrar" required placeholder="Digite seu email">

                <label for="cpf_cadastrar">CPF</label>
                <input type="number" id="cpf_cadastrar" name="cpf_cadastrar" required placeholder="Digite seu cpf">

                <label for="endereco_cadastrar">Endereço</label>
                <input type="text" id="endereco_cadastrar" name="endereco_cadastrar" required placeholder="Digite seu endereço">

                <label for="telefone_cadastrar">Telefone</label>
                <input type="number" id="telefone_cadastrar" name="telefone_cadastrar" required placeholder="Digite seu telefone">

                <label for="nascimento_cadastrar">Data de nascimento</label>
                <input type="date" id="nascimento_cadastrar" name="nascimento_cadastrar" required placeholder="Digite sua data de nascimento">

                <label for="senha_cadastrar">Senha</label>
                <input type="password" id="senha_cadastrar" name="senha_cadastrar" required placeholder="Digite sua Senha">

                <input style="display:none;" type="text" id="tipo_cadastrar" name="tipo_cadastrar" required value="Aluno">

                <button id="entrar-cadastrar" type="submit">Entrar</button>
            </form>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if ($cadastro_sucesso): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Usuário cadastrado com sucesso!',
                    text: 'Você será redirecionado para a página de login.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.php";
                    }
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>