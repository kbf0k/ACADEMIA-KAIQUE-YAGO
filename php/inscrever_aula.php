<?php
session_start(); // Inicia a sessão para pegar o ID do aluno
require 'config.php'; // Arquivo de conexão com o banco de dados

// Verifica se o aluno está logado
if (!isset($_SESSION['id_sessao'])) {
    echo json_encode(['success' => false, 'message' => 'Aluno não está logado']);
    exit;
}

$alunoCod = $_SESSION['id_sessao']; // O código do aluno armazenado na sessão
$data = json_decode(file_get_contents('php://input'), true); // Recebe os dados enviados via POST (JSON)
$aulaId = $data['aulaId']; // Pega o ID da aula que foi enviado via fetch

// Atualiza a tabela aula com o ID do aluno para se inscrever na aula
$sql = "UPDATE aula SET fk_aluno_cod = ? WHERE aula_cod = ? AND fk_aluno_cod IS NULL";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ii', $alunoCod, $aulaId); // O código do aluno e o ID da aula

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Inscrição realizada com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao inscrever na aula.']);
}

$stmt->close();
$conexao->close();
?>

