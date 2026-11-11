<?php
    include "conexao.php";

        //CRIAÇÃO DOS CLIENTES (CREATE)
        if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
            $nome = $_POST["nome"];
            $cpf = $_POST["cpf"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];

            $sql = "INSERT INTO cliente(nome,cpf,email,telefone)
                    VALUES('$nome', '$cpf', '$email', '$telefone')";

            $conexao->query($sql);
            header("Location: clientes.php");
            exit;
        }

        //ATUALIZAÇÃO DOS CLIENTES (UPDATE)
        if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $cpf = $_POST["cpf"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];

            $sql = "UPDATE cliente
                    SET nome='$nome',
                        cpf='$cpf',
                        email='$email',
                        telefone='$telefone'
                    WHERE id=$id";

            $conexao->query($sql);
            header("Location: clientes.php");
            exit;
        }

        //EXCLUSÃO DE CLIENTES(DELENTE)
        if(isset($_GET["excluir"])){
            $id = $_GET["excluir"];
            $sql = "DELETE FROM cliente WHERE id=$id";
            $conexao->query($sql);

            header("Location: clientes.php");
            exit;
        }

        $editar = null;
        //PEGA OS CAMPOS NO SQL E TRAZ PARA EDIÇÃO
        if(isset($_GET["editar"])){
            $id = $_GET["editar"];
            $sql = "SELECT * FROM cliente WHERE id=$id";
            $resultado = $conexao->query($sql);
            $editar = $resultado->fetch_assoc();
        }

        //BUSCA DE CLIENTES (RESEARCH)
        $busca = $_GET["buscar"] ?? "";

        $sql = "SELECT * FROM cliente
                WHERE nome LIKE '%$busca%'
                ORDER BY nome ASC";

        $resultado = $conexao->query($sql);
    ?>