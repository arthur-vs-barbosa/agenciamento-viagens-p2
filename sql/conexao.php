<?php
$servidor="localhost";
$usuario="root";
$senha="";
$banco="agenciaviagens";
$conexao= new mysqli($servidor,$usuario,$senha,$banco);
if ($conexao -> connect_error){
    die("Erro na conexão: ".$conexao -> connect_error);
}
echo"Banco conectado com sucesso!";
$conexao->set_charset("utf8");
?>