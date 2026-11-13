
<?php
    include "conexao.php";

    // 1. CRIAR RESERVA
    if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){

        // Recebe os dados enviados pelo formulário
        $idCliente = $_POST["idCliente"];
        $idPacote = $_POST["idPacote"];
        $dataReserva = $_POST["dataReserva"];
        $status = $_POST["status"];

        // Insere uma nova reserva no banco de dados
        $sql = "INSERT INTO reserva (idCliente, idPacote, dataReserva, `status`)
                VALUES ('$idCliente', '$idPacote', '$dataReserva', '$status')";

        $conexao->query($sql);

        // Redireciona para a página de reservas
        header("Location: reservas.php");
        exit;
    }

    // 2. EDITAR RESERVA
    if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){

        // Recebe o ID da reserva e os novos dados
        $id = $_POST["id"];
        $idCliente = $_POST["idCliente"];
        $idPacote = $_POST["idPacote"];
        $dataReserva = $_POST["dataReserva"];
        $status = $_POST["status"];

        // Atualiza os dados da reserva selecionada
        $sql = "UPDATE reserva
                SET idCliente='$idCliente',
                    idPacote='$idPacote',
                    dataReserva='$dataReserva',
                    `status`='$status'
                WHERE id=$id";

        $conexao->query($sql);

        // Redireciona após a edição
        header("Location: reservas.php");
        exit;
    }

    // 3. EXCLUIR RESERVA
    if(isset($_GET["excluir"])){

        // Recebe o ID da reserva que será excluída
        $id = $_GET["excluir"];

        // Exclui a reserva do banco de dados
        $sql = "DELETE FROM reserva WHERE id=$id";
        $conexao->query($sql);

        // Redireciona após a exclusão
        header("Location: reservas.php");
        exit;
    }

    $editar = null;

    // 4. BUSCAR PARA EDITAR
    if(isset($_GET["editar"])){

        // Recebe o ID da reserva que será editada
        $id = $_GET["editar"];

        // Busca os dados da reserva no banco
        $sql = "SELECT * FROM reserva WHERE id=$id";
        $resultado = $conexao->query($sql);

        // Guarda os dados encontrados para preencher o formulário
        $editar = $resultado->fetch_assoc();
    }

    // 5. LISTAR AS RESERVAS
    // Permite pesquisar reservas pelo nome do cliente
    $busca = $_GET["buscar"] ?? "";

    // Busca as reservas junto com o nome do cliente e do pacote
    $sql = "SELECT reserva.*, 
                   cliente.nome AS nomeCliente,
                   pacote.nome AS nomePacote
            FROM reserva
            JOIN cliente ON reserva.idCliente = cliente.id
            JOIN pacote ON reserva.idPacote = pacote.id
            WHERE cliente.nome LIKE '%$busca%'
            ORDER BY reserva.id DESC";

    $resultado = $conexao->query($sql);
?>
