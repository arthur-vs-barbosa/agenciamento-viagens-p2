<?php
    include "conexao.php";
        //CRIAÇÃO DE VIAGENS
        if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
            $destino = $_POST["destino"];
            $dtIda = $_POST["dtIda"];
            $dtVolta = $_POST["dtVolta"];
            $precoBase = $_POST["precoBase"];
            $vagas = $_POST["vagas"];

            $sql = "INSERT INTO viagem(destino,dtIda,dtVolta,precoBase,vagas)
                    VALUES('$destino', '$dtIda', '$dtVolta', '$precoBase','$vagas')";

            $conexao->query($sql);
            header("Location: viagens.php");
            exit;
        }

        //EDIÇÃO DE VIAGENS
        if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
            $id = $_POST["id"];
            $destino = $_POST["destino"];
            $dtIda = $_POST["dtIda"];
            $dtVolta = $_POST["dtVolta"];
            $precoBase = $_POST["precoBase"];
            $vagas = $_POST["vagas"];

            $sql = "UPDATE viagem
                    SET destino='$destino',
                        dtIda='$dtIda',
                        dtVolta='$dtVolta',
                        precoBase='$precoBase',
                        vagas='$vagas'
                    WHERE id=$id";

            $conexao->query($sql);
            header("Location: viagens.php");
            exit;
        }

        //EXCLUSÃO DE VIAGENS
        if(isset($_GET["excluir"])){
            $id = $_GET["excluir"];
            $sql = "DELETE FROM viagem WHERE id=$id";
            $conexao->query($sql);

            header("Location: viagens.php");
            exit;
        }

        $editar = null;
        //BUSCA OS CAMPOS NA TABELA VIAGENS E TRAZ PRA EDIÇÃO
        if(isset($_GET["editar"])){
            $id = $_GET["editar"];
            $sql = "SELECT * FROM viagem WHERE id=$id";
            $resultado = $conexao->query($sql);
            $editar = $resultado->fetch_assoc();
        }

        //PESQUISA DE VIAGENS (RESEARCH)
        $busca = $_GET["buscar"] ?? "";

        $sql = "SELECT * FROM viagem
                WHERE destino LIKE '%$busca%'
                ORDER BY destino ASC";

        $resultado = $conexao->query($sql);
    ?>