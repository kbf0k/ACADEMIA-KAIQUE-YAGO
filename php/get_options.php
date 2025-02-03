<?php
session_start();
require 'config.php'; // Arquivo de conexão com o banco de dados

// Buscar os tipos de aula sem duplicação
$sql_tipo_aula = "SELECT DISTINCT aula_tipo FROM aula"; // Ajuste conforme sua estrutura
$sql_instrutores = "SELECT instrutor_cod, instrutor_nome FROM instrutor"; 

$result_tipo_aula = $conexao->query($sql_tipo_aula);
$result_instrutores = $conexao->query($sql_instrutores);

// Preparar arrays para os resultados
$tipos_aula = [];
$instrutores = [];

// Preencher os arrays
while ($row = $result_tipo_aula->fetch_assoc()) {
    $tipos_aula[] = $row['aula_tipo'];
}

while ($row = $result_instrutores->fetch_assoc()) {
    $instrutores[] = [
        'cod' => $row['instrutor_cod'], 
        'nome' => $row['instrutor_nome']
    ];
}

// Retornar os dados como JSON
echo json_encode([
    'tipos_aula' => $tipos_aula,
    'instrutores' => $instrutores
]);

$conexao->close();
?>
