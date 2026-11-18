<?php include '../sql/crudPagamentos.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Pagamentos</title>
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
                <!--Formulário-->
                <?php if (empty($editar)) { ?>
                    <!-- TELA DE CADASTRO -->
                    <h1>Realizar Pagamentos</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="criar">
                        
                        <div class="organForm">
                            <label>ID da Reserva</label>
                            <input type="number" name="idReserva" placeholder="ID da reserva associada" required>
                        </div>
                        <div class="organForm">
                            <label>Valor</label>
                            <input type="number" step="0.01" name="valor" placeholder="Ex: 540,00" required>
                        </div>
                        <div class="organForm">
                            <label>Forma de Pagamento</label>
                            <input type="text" name="formaPagamento" placeholder="Ex: Pix, Cartão" required>
                        </div>
                        <div class="organForm">
                            <label>Status do Pagamento</label>
                            <input type="text" name="statusPagamento" placeholder="Ex: Pago, Pendente" required>
                        </div>
                        <div class="organForm" style="grid-column: 1 / -1;">
                            <label>Data do Pagamento</label>
                            <input type="date" name="dataPagamento" required style="width: 25%;">
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>

                <?php } else { ?>
                    <!-- TELA DE EDIÇÃO -->
                    <h1>Editar Pagamento</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $editar["id"] ?? ''; ?>">

                        <div class="organForm">
                            <label>ID da Reserva</label>
                            <input type="number" name="idReserva" value="<?php echo $editar["idReserva"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Valor</label>
                            <input type="number" step="0.01" name="valor" value="<?php echo $editar["valor"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Forma de Pagamento</label>
                            <input type="text" name="formaPagamento" value="<?php echo $editar["formaPagamento"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Status do Pagamento</label>
                            <input type="text" name="statusPagamento" value="<?php echo $editar["statusPagamento"] ?? ''; ?>" required>
                        </div>
                        <div class="organForm" style="grid-column: 1 / -1;">
                            <label>Data do Pagamento</label>
                            <input type="date" name="dataPagamento" value="<?php echo $editar["dataPagamento"] ?? ''; ?>" required style="width: 25%;">
                        </div>

                        <div class="acoes-form">
                            <button type="submit">Salvar Edição</button>
                            <a href="pagamentos.php">Cancelar</a>
                        </div>
                    </form>
                <?php } ?>

                <hr>
                <div class="gerenciar">
                    <h1>Lista de Pagamentos</h1>
                    <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                    <form action="../relatorios/gerarPDF.php" method="get" class="formPDF">
                        <input type="hidden" name="tipo" value="pagamentos">
                        <button type="submit">Relatório de Pagamentos</button>
                    </form>

                    <!--Método de pesquisa por ID-->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo ID" value="<?php echo htmlspecialchars($busca ?? ''); ?>">
                        <button type="submit">Pesquisar</button>
                        <?php if(!empty($busca)) { ?>
                            <a href="pagamentos.php" style="margin-left: 10px;">Limpar Filtro</a>
                        <?php } ?>
                    </form>

                    <!-- Tabela de pagamentos -->
                    <table border="1">
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