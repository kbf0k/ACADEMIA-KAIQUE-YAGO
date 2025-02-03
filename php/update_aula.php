<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$aula_cod = $data['aula_cod'];
$aula_tipo = $data['aula_tipo'];
$aula_data = $data['aula_data'];

$sql = "UPDATE aula SET aula_tipo = ?, aula_data = ? WHERE aula_cod = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ssi', $aula_tipo, $aula_data, $aula_cod);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conexao->close();
?>
