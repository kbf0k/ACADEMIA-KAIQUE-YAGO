<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email_digitado = $_POST['email_login'];
    $senha_digitado = $_POST['senha_login'];

    $sql = "SELECT * FROM usuarios WHERE email_usuario = ? AND senha_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email_digitado, $senha_digitado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $usuario_logado = $result->fetch_assoc();
        $_SESSION['nome_sessao'] = $usuario_logado['usuario_nome'];
        $_SESSION['tipo_sessao'] = $usuario_logado['usuario_tipo'];
        $_SESSION['id_sessao'] = $usuario_logado['usuario_cod'];
        header('location: inicio.php');
        exit();
    } else {
        // Aqui você pode mostrar um alerta de erro, por exemplo, se o login falhar
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <title>Login</title>
</head>

<body>
    <main>
        <div class="container">
            <form action="" method="POST" id="login">
                <img src="../img/logo.png" alt="" id="logo">
                <h1>Entrar</h1>

                <label for="email">Email</label>
                <input type="email" id="email_login" name="email_login" required placeholder="Digite seu email">

                <label for="senha">Senha</label>
                <input type="password" id="senha_login" name="senha_login" required placeholder="Digite sua Senha">

                <p>Nao tem uma conta?<a id="cadastrar-login" href="cadastrar.php">Cadastra-se</a></p>

                <button id="entrar-login" type="submit">Entrar</button>
            </form>
        </div>
    </main>
</body>

</html>