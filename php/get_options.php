<?php
session_start();
require 'config.php'; // Arquivo de conexão com o banco de dados

// Consultar a definição da tabela para pegar o enum de tipos de aula
$sql = "DESCRIBE aula";
$result = $conexao->query($sql);

$aula_tipos = [];
$instrutores = [];

// Pegando os tipos de aula (ENUM)
if ($result->num_rows > 0) {
    // Percorrer o resultado para encontrar o campo 'aula_tipo'
    while ($row = $result->fetch_assoc()) {
        if ($row['Field'] == 'aula_tipo') {
            // Extrair os valores do enum
            preg_match_all("/'(.*?)'/", $row['Type'], $matches);
            $aula_tipos = $matches[1]; // Os valores do enum
        }
    }
} else {
    echo "Tabela não encontrada.";
}

// Consultar os instrutores
$sql_instrutores = "SELECT instrutor_cod, instrutor_nome FROM instrutor";
$result_instrutores = $conexao->query($sql_instrutores);

// Preencher o array de instrutores
if ($result_instrutores->num_rows > 0) {
    while ($row = $result_instrutores->fetch_assoc()) {
        $instrutores[] = [
            'cod' => $row['instrutor_cod'], 
            'nome' => $row['instrutor_nome']
        ];
    }
}

$conexao->close();

// Retornar os dados como JSON (tipos de aula e instrutores)
echo json_encode([
    'tipos_aula' => $aula_tipos,
    'instrutores' => $instrutores
]);
?>
