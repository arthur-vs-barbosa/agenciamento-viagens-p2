<?php
    include "conexao.php";

    // 1. CRIAR PAGAMENTO
    if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
        $idReserva = $_POST["idReserva"];
        $valor = $_POST["valor"];
        $formaPagamento = $_POST["formaPagamento"];
        $statusPagamento = $_POST["statusPagamento"];
        $dataPagamento = $_POST["dataPagamento"];

        $sql = "INSERT INTO pagamento (idReserva, valor, formaPagamento, statusPagamento, dataPagamento)
                VALUES ('$idReserva', '$valor', '$formaPagamento', '$statusPagamento', '$dataPagamento')";

        $conexao->query($sql);
        header("Location: pagamentos.php");
        exit;
    }

    // 2. EDITAR PAGAMENTO
    if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
        $id = $_POST["id"];
        $idReserva = $_POST["idReserva"];
        $valor = $_POST["valor"];
        $formaPagamento = $_POST["formaPagamento"];
        $statusPagamento = $_POST["statusPagamento"];
        $dataPagamento = $_POST["dataPagamento"];

        $sql = "UPDATE pagamento
                SET idReserva='$idReserva',
                    valor='$valor',
                    formaPagamento='$formaPagamento',
                    statusPagamento='$statusPagamento',
                    dataPagamento='$dataPagamento'
                WHERE id=$id";

        $conexao->query($sql);
        header("Location: pagamentos.php");
        exit;
    }

    // 3. EXCLUIR PAGAMENTO
    if(isset($_GET["excluir"])){
        $id = $_GET["excluir"];
        $sql = "DELETE FROM pagamento WHERE id=$id";
        $conexao->query($sql);

        header("Location: pagamentos.php");
        exit;
    }

    $editar = null;

    // 4. BUSCAR PARA EDITAR
    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM pagamento WHERE id=$id";
        $resultado = $conexao->query($sql);
        $editar = $resultado->fetch_assoc();
    }

    // 5. LISTAR PAGAMENTOS (Com JOIN opcional para mostrar informações da Reserva/Cliente se precisar)
    $busca = $_GET["buscar"] ?? "";

    if(!empty($busca)){
        $sql = "SELECT pagamento.*, reserva.id AS codigoReserva 
                FROM pagamento
                LEFT JOIN reserva ON pagamento.idReserva = reserva.id
                WHERE pagamento.id = '$busca'
                ORDER BY pagamento.id DESC";
    } else {
        $sql = "SELECT pagamento.*, reserva.id AS codigoReserva 
                FROM pagamento
                LEFT JOIN reserva ON pagamento.idReserva = reserva.id
                ORDER BY pagamento.id DESC";
    }

    $resultado = $conexao->query($sql);
?>