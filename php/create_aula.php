<?php
session_start();
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

// Captura os dados enviados
$aula_tipo = $data['aula_tipo'];
$aula_data = $data['aula_data'];
$instrutor_cod = intval($data['instrutor']); // Converte para inteiro

// Insere a nova aula no banco de dados
$sql = "INSERT INTO aula (aula_tipo, aula_data, fk_instrutor_cod) 
        VALUES (?, ?, ?)";

// Preparar a consulta
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ssi', $aula_tipo, $aula_data, $instrutor_cod); // Ajuste no bind_param

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conexao->close();
?>
