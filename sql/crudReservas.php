<?php
    include "conexao.php";

    // 1. CRIAR RESERVA
    if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
        $idCliente = $_POST["idCliente"];
        $idViagem = $_POST["idViagem"];
        $dataReserva = $_POST["dataReserva"];
        $status = $_POST["status"];

        $sql = "INSERT INTO reserva (idCliente, idViagem, dataReserva, status)
                VALUES ('$idCliente', '$idViagem', '$dataReserva', '$status')";

        $conexao->query($sql);
        header("Location: reservas.php");
        exit;
    }

    // 2. EDITAR RESERVA
    if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
        $id = $_POST["id"];
        $idCliente = $_POST["idCliente"];
        $idViagem = $_POST["idViagem"];
        $dataReserva = $_POST["dataReserva"];
        $status = $_POST["status"];

        $sql = "UPDATE reserva
                SET idCliente='$idCliente',
                    idViagem='$idViagem',
                    dataReserva='$dataReserva',
                    status='$status'
                WHERE id=$id";

        $conexao->query($sql);
        header("Location: reservas.php");
        exit;
    }

    // 3. EXCLUIR RESERVA
    if(isset($_GET["excluir"])){
        $id = $_GET["excluir"];
        $sql = "DELETE FROM reserva WHERE id=$id";
        $conexao->query($sql);

        header("Location: reservas.php");
        exit;
    }

    $editar = null;

    // 4. BUSCAR PARA EDITAR
    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM reserva WHERE id=$id";
        $resultado = $conexao->query($sql);
        $editar = $resultado->fetch_assoc();
    }

    // 5. LISTAR AS RESERVAS (Com JOIN para mostrar o Nome do Cliente e o Destino da Viagem)
    $busca = $_GET["buscar"] ?? "";

    $sql = "SELECT reserva.*, cliente.nome AS nomeCliente, viagem.destino AS nomeDestino 
            FROM reserva
            JOIN cliente ON reserva.idCliente = cliente.id
            JOIN viagem ON reserva.idViagem = viagem.id
            WHERE cliente.nome LIKE '%$busca%'
            ORDER BY reserva.id DESC";

    $resultado = $conexao->query($sql);
?>