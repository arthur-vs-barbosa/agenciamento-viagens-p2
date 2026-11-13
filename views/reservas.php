<?php include '../sql/crudReservas.php' ?>
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
                <h1>Realizar Reserva</h1>
                <form method="post" class="cadastrar">
                    <input type='hidden' name='acao' value='criar'>
                    <div class="organForm">
                        <label>ID Cliente</label>
                        <input type="number" name="idCliente">
                    </div>
                    <div class="organForm">
                        <label>ID Pacote</label>
                        <input type="number" name="idPacote">
                    </div>
                    <div class="organForm">
                        <label>Data da Reserva</label>
                        <input type="date" name="dataReserva">
                    </div>
                    <div class="organForm">
                        <label>Status da Reserva</label>
                        <input type="text" name="status">
                    </div>
                    <button type="submit">Enviar</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Reservas Feitas</h1>
                </div>

<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
<h2>Pesquisar reserva</h2>
<form method="get">
    <input type="text" name="buscar" placeholder="Pesquisar pelo cliente">
    <button type="submit">Pesquisar</button>
</form>

<h2>Reservas cadastradas</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Pacote</th>
        <th>Data</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php while($reserva = $resultado->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $reserva['id']; ?></td>
            <td><?php echo $reserva['nomeCliente']; ?></td>
            <td><?php echo $reserva['nomePacote']; ?></td>
            <td><?php echo $reserva['dataReserva']; ?></td>
            <td><?php echo $reserva['status']; ?></td>
            <td>
                <a href="?editar=<?php echo $reserva['id']; ?>">Editar</a> |
                <a href="?excluir=<?php echo $reserva['id']; ?>" onclick="return confirm('Excluir reserva?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if($editar != null){ ?>
    <h2>Alterar reserva</h2>
    <form method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">

        ID Cliente:
        <input type="number" name="idCliente" value="<?php echo $editar['idCliente']; ?>">

        ID Pacote:
        <input type="number" name="idPacote" value="<?php echo $editar['idPacote']; ?>">

        Data:
        <input type="date" name="dataReserva" value="<?php echo $editar['dataReserva']; ?>">

        Status:
        <input type="text" name="status" value="<?php echo $editar['status']; ?>">

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