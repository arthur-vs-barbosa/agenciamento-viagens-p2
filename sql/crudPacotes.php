
<?php
    include "conexao.php";

    // 1. CRIAR PACOTE
    if(isset($_POST["acao"]) && $_POST["acao"] == "criar"){
        $idViagem = $_POST["idViagem"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $beneficios = $_POST["beneficios"];

        $sql = "INSERT INTO pacote (idViagem, nome, descricao, preco, beneficios)
                VALUES ('$idViagem', '$nome', '$descricao', '$preco', '$beneficios')";

        $conexao->query($sql);
        header("Location: pacotes.php");
        exit;
    }

    // 2. EDITAR PACOTE
    if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
        $id = $_POST["id"];
        $idViagem = $_POST["idViagem"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $beneficios = $_POST["beneficios"];

        $sql = "UPDATE pacote
                SET idViagem='$idViagem',
                    nome='$nome',
                    descricao='$descricao',
                    preco='$preco',
                    beneficios='$beneficios'
                WHERE id=$id";

        $conexao->query($sql);
        header("Location: pacotes.php");
        exit;
    }

    // 3. EXCLUIR PACOTE
    if(isset($_GET["excluir"])){
        $id = $_GET["excluir"];
        $sql = "DELETE FROM pacote WHERE id=$id";
        $conexao->query($sql);

        header("Location: pacotes.php");
        exit;
    }

    $editar = null;

    // 4. BUSCAR PARA EDITAR
    if(isset($_GET["editar"])){
        $id = $_GET["editar"];
        $sql = "SELECT * FROM pacote WHERE id=$id";
        $resultado = $conexao->query($sql);
        $editar = $resultado->fetch_assoc();
    }

    // 5. LISTAR PACOTES (Com barra de busca por nome)
    $busca = $_GET["buscar"] ?? "";

    $sql = "SELECT * FROM pacote
            WHERE nome LIKE '%$busca%'
            ORDER BY nome ASC";

    $resultado = $conexao->query($sql);
?>
