<?php
session_start();
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

    $senha_criptografada = password_hash($senha_cadastro, PASSWORD_DEFAULT);

    $sql1 = "INSERT INTO usuarios(nome_usuario, email_usuario, senha_usuario, tipo_usuario) VALUES (?, ?, ?, ?)";
    $stmt1 = $conexao->prepare($sql1);
    $stmt1->bind_param('ssss', $nome_cadastro, $email_cadastro, $senha_criptografada, $tipo_cadastro);
    $stmt1->execute();

    $sql2 = "INSERT INTO aluno(aluno_nome, aluno_email, aluno_cpf, aluno_endereco, aluno_telefone, aluno_nasc, aluno_senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conexao->prepare($sql2);
    $stmt2->bind_param('ssssiss', $nome_cadastro, $email_cadastro, $cpf_cadastro, $endereco_cadastro, $telefone_cadastro, $nascimento_cadastro, $senha_criptografada);
    $stmt2->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login-cadastro.css">
    <title>Cadastrar</title>
</head>

<body>
    <main id="main-cadastrar">
        <div class="container">
            <video id="video-background" src="../img/video-background2.mp4" autoplay muted loop></video>
            <form action="" method="post" id="cadastrar">
                <span><a id="cadastrar-voltar" href="login.php">Voltar</a></span>
                <img src="../img/logo_1.png" alt="" id="logo">
                <h1>Cadastrar-se</h1>

                <div class="input-group">
                    <div>
                        <label for="nome_cadastrar">Nome</label>
                        <input type="text" id="nome_cadastrar" name="nome_cadastrar" required placeholder="Digite seu Nome">
                    </div>

                    <div>
                        <label for="email_cadastrar">Email</label>
                        <input type="email" id="email_cadastrar" name="email_cadastrar" required placeholder="Digite seu email">
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <label for="cpf_cadastrar">CPF</label>
                        <input type="number" id="cpf_cadastrar" name="cpf_cadastrar" required placeholder="Digite seu CPF">
                    </div>


                    <div>
                        <label for="telefone_cadastrar">Telefone</label>
                        <input type="number" id="telefone_cadastrar" name="telefone_cadastrar" required placeholder="Digite seu telefone">
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <label for="nascimento_cadastrar">Data de nascimento</label>
                        <input type="date" id="nascimento_cadastrar" name="nascimento_cadastrar" required placeholder="Digite sua data de nascimento">
                    </div>

                    <div>
                        <label for="senha_cadastrar">Senha</label>
                        <input type="password" id="senha_cadastrar" name="senha_cadastrar" required placeholder="Digite sua Senha">
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <label for="endereco_cadastrar">Endereço</label>
                        <input type="text" id="endereco_cadastrar" name="endereco_cadastrar" required placeholder="Digite seu endereço">
                    </div>
                </div>
                <input style="display:none;" type="text" id="tipo_cadastrar" name="tipo_cadastrar" required value="Aluno">

                <button id="entrar-cadastrar" type="submit">Entrar</button>
            </form>
        </div>
    </main>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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
        </script>
</body>

</html>