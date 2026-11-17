<?php include '../sql/crudPagamentos.php'; ?>
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
                <h1>Realizar Pagamentos</h1>
                <!--Formulário-->
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    <div class="organForm">
                        <label>ID Reserva</label>
                        <input type="number" name="idReserva" required placeholder="ID da reservada do pagamento"> 
                    </div>
                    <div class="organForm">
                        <label>Valor</label>
                        <input type="number" name="valor" step="0.01" min="0" required placeholder="Valor do pagamento">
                    </div>
                    <div class="organForm">
                        <label>Forma de Pagamento</label>
                        <input type="text" name="formaPagamento" required placeholder="Pix, débito, crédito, etc.">
                    </div>
                    <div class="organForm">
                        <label>Status do Pagamento</label>
                        <input type="text" name="statusPagamento" required placeholder="Pago/pendente">
                    </div>
                    <div class="organForm">
                        <label>Data do Pagamento</label>
                        <input type="date" name="dataPagamento" required>
                    </div>
                    <button type="submit">Salvar</button>
                </form>
                <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                <form action="../relatorios/gerarPDF.php" method="get" class="relatorioForm">
                    <input type="hidden" name="tipo" value="pagamentos">
                    <button type="submit">Relatório de Pagamentos</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Lista de Pagamentos</h1>
                    <!--Aqui colocar uma lista dos pagamentos já registrados e um método de pesquisa-->
                    <!-- Tabela de pagamentos -->
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>ID Reserva</th>
                            <th>Valor</th>
                            <th>Forma de Pagamento</th>
                            <th>Status</th>
                            <th>Data do Pagamento</th>
                            <th>Ações</th>
                        </tr>
                        <?php while($pagamento = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $pagamento['id']; ?></td>
                            <td><?php echo $pagamento['idReserva']; ?></td>
                            <td>R$ <?php echo number_format($pagamento['valor'], 2, ',', '.'); ?></td>
                            <td><?php echo $pagamento['formaPagamento']; ?></td>
                            <td><?php echo $pagamento['statusPagamento']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($pagamento['dataPagamento'])); ?></td>
                            <td>
                                <a href="?editar=<?php echo $pagamento['id']; ?>">Editar</a> |
                                <a href="?excluir=<?php echo $pagamento['id']; ?>" onclick="return confirm('Excluir pagamento?')">Excluir</a>
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