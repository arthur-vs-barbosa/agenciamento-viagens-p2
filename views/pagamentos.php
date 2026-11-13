<?php include '../sql/crudPagamentos.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Cliente</title>
        <link rel="stylesheet" href="../CSS/stylesheet.css">
        <link rel="stylesheet" href="../CSS/styleForm.css">
    </head>
    <body>
        <div id="main">
            <!--Lateral do site-->
            <?php include 'lateralsite.php'?>

            <div class="meioForm">
                <h1>Realizar Pagamentos</h1>
                    <form method="post" class="cadastrar">
                        <input type='hidden' name='acao' value='criar'>
                        <div class="organForm">
                            <label>ID Reserva</label>
                            <input type="number" name="idReserva"> 
                        </div>
                        <div class="organForm">
                            <label>Valor</label>
                            <input type="number" name="valor" step="0.01" min="0">
                        </div>
                        <div class="organForm">
                            <label>Forma de Pagamento</label>
                            <input type="text" name="formaPagamento">
                        </div>
                        <div class="organForm">
                            <label>Status do Pagamento</label>
                            <input type="text" name="statusPagamento">
                        </div>
                        <div class="organForm">
                            <label>Data do Pagamento</label>
                            <input type="date" name="dataPagamento">
                        </div>
                        <button type="submit">Salvar</button>
                    </form>
                <hr>
                <div class="gerenciar">
                    <h1>Lista de Pagamentos</h1>
                </div>

<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
<h2>Pesquisar pagamento</h2>
<form method="get">
    <input type="text" name="buscar" placeholder="Pesquisar pagamento">
    <button type="submit">Pesquisar</button>
</form>

<h2>Pagamentos cadastrados</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Reserva</th>
        <th>Valor</th>
        <th>Forma</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>

    <?php while($pagamento = $resultado->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $pagamento['id']; ?></td>
            <td><?php echo $pagamento['codigoReserva']; ?></td>
            <td><?php echo $pagamento['valor']; ?></td>
            <td><?php echo $pagamento['formaPagamento']; ?></td>
            <td><?php echo $pagamento['statusPagamento']; ?></td>
            <td><?php echo $pagamento['dataPagamento']; ?></td>
            <td>
                <a href="?editar=<?php echo $pagamento['id']; ?>">Editar</a> |
                <a href="?excluir=<?php echo $pagamento['id']; ?>" onclick="return confirm('Excluir pagamento?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if($editar != null){ ?>
    <h2>Alterar pagamento</h2>
    <form method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">

        ID Reserva:
        <input type="number" name="idReserva" value="<?php echo $editar['idReserva']; ?>">

        Valor:
        <input type="number" name="valor" step="0.01" value="<?php echo $editar['valor']; ?>">

        Forma de pagamento:
        <input type="text" name="formaPagamento" value="<?php echo $editar['formaPagamento']; ?>">

        Status:
        <input type="text" name="statusPagamento" value="<?php echo $editar['statusPagamento']; ?>">

        Data:
        <input type="date" name="dataPagamento" value="<?php echo $editar['dataPagamento']; ?>">

        <button type="submit">Salvar</button>
    </form>
<?php } ?>
<!--FIM DOS CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
            </div>
        </div>
        <!--Rodapé-->
        <div class="rodape">
            <p>Site realizado para o projeto proposto na disciplina de Desenvolvimento Web II</p>
        </div>
    </body>
</html>