<?php
    //desconsiderar por agora
    include "conexao.php";

    // 1. CRIAR FUNCIONÁRIO
    if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
        $nomeFunc = $_POST["nomeFunc"];
        $cargo = $_POST["cargo"];
        $emailFunc = $_POST["emailFunc"];

        $sql = "INSERT INTO funcionario (nomeFunc, cargo, emailFunc)
                VALUES ('$nomeFunc', '$cargo', '$emailFunc')";

        $conexao->query($sql);
        header("Location: funcionarios.php");
        exit;
    }

    // 2. EDITAR FUNCIONÁRIO
    if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
        $id = $_POST["id"];
        $nomeFunc = $_POST["nomeFunc"];
        $cargo = $_POST["cargo"];
        $emailFunc = $_POST["emailFunc"];

        $sql = "UPDATE funcionario
                SET nomeFunc='$nomeFunc',
                    cargo='$cargo',
                    emailFunc='$emailFunc'
                WHERE id=$id";

        $conexao->query($sql);
        header("Location: funcionarios.php");
        exit;
    }

    // 3. EXCLUIR FUNCIONÁRIO
    if(isset($_GET["excluir"])){
        $id = $_GET["excluir"];
        $sql = "DELETE FROM funcionario WHERE id=$id";
        $conexao->query($sql);

        header("Location: funcionarios.php");
        exit;
    }

    $editar = null;

    // 4. BUSCAR PARA EDITAR
    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM funcionario WHERE id=$id";
        $resultado = $conexao->query($sql);
        $editar = $resultado->fetch_assoc();
    }

    // 5. LISTAR FUNCIONÁRIOS (Com barra de busca por nome)
    $busca = $_GET["buscar"] ?? "";

    $sql = "SELECT * FROM funcionario
            WHERE nomeFunc LIKE '%$busca%'
            ORDER BY nomeFunc ASC";

    $resultado = $conexao->query($sql);
?>