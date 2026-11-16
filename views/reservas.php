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
                <?php if (empty($editar)) { ?>
                    <!-- TELA DE CADASTRO -->
                     <h1>Realizar Reserva</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="criar">
                        
                        <div class="organForm">
                            <label>ID do Cliente</label>
                            <input type="number" name="idCliente" required>
                        </div>
                        <div class="organForm">
                            <label>ID do Pacote</label>
                            <input type="number" name="idPacote" required>
                        </div>
                        <div class="organForm">
                            <label>Data da Reserva</label>
                            <input type="date" name="dataReserva" required>
                        </div>
                        <div class="organForm">
                            <label>Status</label>
                            <input type="text" name="status" placeholder="Ex: Confirmada" required>
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>

                <?php } else { ?>
                    <!-- TELA DE EDIÇÃO -->
                    <h1>Editar Reserva</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $editar["id"] ?? ''; ?>">

                        <div class="organForm">
                            <label>ID do Cliente</label>
                            <input type="number" name="idCliente" value="<?php echo $editar["idCliente"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>ID do Pacote</label>
                            <input type="number" name="idPacote" value="<?php echo $editar["idPacote"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Data da Reserva</label>
                            <input type="date" name="dataReserva" value="<?php echo $editar["dataReserva"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Status</label>
                            <input type="text" name="status" value="<?php echo $editar["status"] ?? ''; ?>" required>
                        </div>

                        <div class="acoes-form">
                            <button type="submit">Salvar Edição</button>
                            <a href="reservas.php">Cancelar</a>
                        </div>
                    </form>
                <?php } ?>
                
                <hr>
                <div class="gerenciar">
                    <h1>Reservas Feitas</h1>
                    <!--Aqui colocar uma lista das reservas já feitas e um método de pesquisa-->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo ID">
                        <button type="submit">Pesquisar</button>
                    </form>

                    <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                    <form action="../relatorios/gerarPDF.php" method="get" class="formPDF">
                        <input type="hidden" name="tipo" value="reservas">
                        <button type="submit">Relatório de Reservas</button>
                    </form>
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