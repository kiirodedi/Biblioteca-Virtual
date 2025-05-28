<?php
// Variáveis de conexão com o servidor //
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "biblioteca_virtual";

$conexao = new mysqli($servidor, $usuario, $senha, $bd);

// Teste de conexão
if($conexao->connect_error){
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}
?>