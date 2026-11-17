<?php
$servidor="localhost";
$usuario="root";
$senha="usbw";
$banco="agenciaviagens";
$porta=3307;
$conexao= new mysqli($servidor,$usuario,$senha,$banco,$porta);
if ($conexao -> connect_error){
    die("Erro na conexão: ".$conexao -> connect_error);
}
echo"Banco conectado com sucesso!";
$conexao->set_charset("utf8");
?>