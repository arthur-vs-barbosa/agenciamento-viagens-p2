<?php include '../sql/crudReservas.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Cliente</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../css/styleForm.css">
    </head>
    <body>
        <!--Topo do site-->
        <div class="topo">
           <h1>Agência de Turismo</h1>
            <div class="usuario">
                <h4>Funcionário</h4>
                <img src="../Icones/person-circle.svg" alt="user">
            </div>
        </div>
        <div id="main">
            <!--Lateral do site-->
            <?php include 'lateralsite.php';?>

            <div class="meioForm">
                <h1>Realizar Reserva</h1>
                <!--Formulário-->
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    <div class="organForm">
                        <label>ID Cliente</label>
                        <input type="number" name="idCliente" required>
                    </div>
                    <div class="organForm">
                        <label>ID Pacote</label>
                        <input type="number" name="idPacote" required>
                    </div>
                    <div class="organForm">
                        <label>Data da Reserva</label>
                        <input type="date" name="dataReserva" required>
                    </div>
                    <div class="organForm">
                        <label>Status da Reserva</label>
                        <input type="text" name="status">
                    </div>
                    <button type="submit">Enviar</button>
                </form>
                <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                <form action="../relatorios/gerarPDF.php" method="get">
                    <input type="hidden" name="tipo" value="reservas">
                    <button type="submit">Relatório de Reservas</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Reservas Feitas</h1>
                    <!--Aqui colocar uma lista das reservas já feitas e um método de pesquisa-->
                    <!-- Tabela de reservas -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>ID Cliente</th>
                            <th>ID Pacote</th>
                            <th>Data da Reserva</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        <?php while($reserva = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $reserva['id']; ?></td>
                            <td><?php echo $reserva['idCliente']; ?></td>
                            <td><?php echo $reserva['idPacote']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($reserva['dataReserva'])); ?></td>
                            <td><?php echo $reserva['status']; ?></td>
                            <td>
                                <a href="?editar=<?php echo $reserva['id']; ?>">Editar</a> |
                                <a href="?excluir=<?php echo $reserva['id']; ?>" onclick="return confirm('Excluir reserva?')">Excluir</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!--Rodapé-->
        <div class="rodape">
            <p>Site realizado para o projeto proposto na disciplina de Desenvolvimento Web II</p>
        </div>
    </body>
</html>