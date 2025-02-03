<?php
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$aula_cod = $data['aula_cod'];

$sql = "DELETE FROM aula WHERE aula_cod = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $aula_cod);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conexao->close();
?>
