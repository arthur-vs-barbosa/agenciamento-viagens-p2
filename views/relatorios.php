<?php
    include "../sql/crudClientes.php";
    include "../sql/crudPacotes.php";
    include "../sql/crudPagamentos.php";
    include "../sql/crudReservas.php";
    include "../sql/crudViagens.php";

    //Joins de Tabelas
    $sql="SELECT 
                cliente.nome AS nomeCliente,
                viagem.destino,
                viagem.dtIda,
                viagem.dtVolta,
                reserva.id AS idReserva,
                pagamento.valor AS valorPago,
                pagamento.statusPagamento
            FROM reserva
            INNER JOIN cliente ON reserva.idCliente = cliente.id
            INNER JOIN pacote ON reserva.idPacote = pacote.id
            INNER JOIN viagem ON pacote.idViagem = viagem.id
            LEFT JOIN pagamento ON pagamento.idReserva = reserva.id
            ORDER BY reserva.id DESC";

    $resultado = $conexao->query($sql);
?>          

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Relatórios</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../css/styleRelatorio.css">
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
            <?php include 'lateralsite.php'; ?>
            <div class="meioRelatorio">
                <div class="cadastrar">
                    <h1>Relatórios</h1>

                    <!--Botão gerar relatório-->
                    <form action="../relatorios/gerarPDF.php" method="get">
                        <input type="hidden" name="tipo" value="geral">
                        <button type="submit">Relatório Geral</button>
                    </form>

                    <!--Tabela-->
                    <table class="tabelaRelatorio">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Destino</th>
                                <th>Data Ida</th>
                                <th>Data Volta</th>
                                <th>Reserva</th>
                                <th>Total pago</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($rel = $resultado->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $rel['nomeCliente']; ?></td>
                                    <td><?php echo $rel['destino']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($rel['dtIda'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($rel['dtVolta'])); ?></td>
                                    <td>#<?php echo $rel['idReserva']; ?></td>
                                    <!--Impede o espaço em branco caso retorne vazio-->
                                    <td>R$ <?php echo number_format(!empty($rel['valorPago']) ? $rel['valorPago'] : 0, 2, ',', '.'); ?></td>
                                    <!--Impede o espaço em branco caso retorne vazio-->
                                    <td><?php echo !empty($rel['statusPagamento']) ? $rel['statusPagamento'] : 'Pendente'; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
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