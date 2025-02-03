<?php
$dbhost = 'localhost';
$dbusuario = "root";
$dbpassword = "";
$dbname = "db_academia";

$conexao = mysqli_connect($dbhost, $dbusuario, $dbpassword, $dbname, 3307);

if (!$conexao) {
    die("Falhou a conexão" . mysqli_connect_error());
}
?>