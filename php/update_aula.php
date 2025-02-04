<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true); // Recebe os dados do frontend

$aula_cod = $data['aula_cod'];
$aula_tipo = $data['aula_tipo'];
$aula_data = $data['aula_data'];

// Verifica se todos os dados foram recebidos corretamente
if (isset($aula_cod, $aula_tipo, $aula_data)) {
    // Atualiza a aula no banco de dados
    $stmt = $conexao->prepare("UPDATE aula SET aula_tipo = ?, aula_data = ? WHERE aula_cod = ?");
    $stmt->bind_param("ssi", $aula_tipo, $aula_data, $aula_cod);

    if ($stmt->execute()) {
        // Se a atualização for bem-sucedida, retorna um JSON com sucesso
        echo json_encode(['success' => true]);
    } else {
        // Se houver um erro ao executar a query
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a aula']);
    }

    $stmt->close();
} else {
    // Se os dados não estiverem completos, retorna erro
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
}

$conexao->close();
?>
