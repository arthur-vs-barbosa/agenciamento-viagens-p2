<!--!!SITE FEITO POR ARTHUR VINICIUS DE SOUZA BARBOSA E ROBERTA MENDES FERNANDES!!-->
<?php
    include "../sql/crudClientes.php";
    include "../sql/crudPacotes.php";
    include "../sql/crudPagamentos.php";
    include "../sql/crudReservas.php";
    include "../sql/crudViagens.php";

    //Contagem de Clientes
    $resCountC=$conexao->query("SELECT * FROM cliente");
    $totalClientes=$resCountC->num_rows;

    //Contagem de Pagamentos
    $resCountP=$conexao->query("SELECT SUM(valor) AS totalValor FROM pagamento");
    $linhaPagamentos=$resCountP->fetch_assoc();
    $totalPagamentos=$linhaPagamentos['totalValor'] ?? 0;

    //Contagem de Pacotes
    $resCountT=$conexao->query("SELECT * FROM pacote");
    $totalPacotes=$resCountT->num_rows;

    //Lista de Viagens (DESC LIMIT PEGA OS 5 PRIMEIROS RESULTADOS DA TABELA)
    $resViagens=$conexao->query("SELECT destino, dtIda, dtVolta, vagas FROM viagem ORDER BY id DESC LIMIT 6");

    //Lista de Reservas
    $resReservas=$conexao->query("SELECT cliente.nome AS nomeCliente,
                                         pacote.nome AS nomePacote,
                                         reserva.dataReserva,
                                         reserva.status FROM reserva
                                  INNER JOIN cliente ON reserva.idCliente = cliente.id
                                  INNER JOIN pacote ON reserva.idPacote = pacote.id
                                  ORDER BY reserva.id DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agência de Turismo</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/styleTabela.css">
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

        <!--Meio do site-->
        <div class="meio">
            <h3>Bem-vindo funcionário</h3>
            <div class="clientes">
                <img src="../Icones/person-fill.svg" alt="person">
                <h2>Clientes</h2>
                <p><?php echo $totalClientes;?></p><!--Colocar o count total de clientes cadastrado aonde está a tag 'p'-->
                <a href="clientes.php">Ver mais</a>
            </div> 
            <div class="pagamento">
                <img src="../Icones/currency-dollar.svg" alt="money">
                <h2>Lucro Total</h2>
                <p><?php echo 'R$'.number_format($totalPagamentos,2,',','.');;?></p><!--Colocar o count do valor total de pagamentos recebidos aonde está a tag 'p'-->
                <a href="pagamentos.php">Ver mais</a>
            </div>
            <div class="pacotesTurist">
                <img src="../Icones/suitcase2-fill.svg" alt="clipboard">
                <h2>Pacotes Turisticos</h2>
                <p><?php echo $totalPacotes;?></p><!--Colocar o count do valor total de pacotes aonde está a tag 'p'-->
                <a href="pacotes.php">Ver mais</a>
            </div>
            <div class="viagens">
                <a href="viagens.php">Ver mais</a>
                <h2>Organizar Viagens</h2>
                <p>Organizar os próximos destinos</p>
                <hr>
                <!--Colocar as 3 viagens cadastradas mais recentes (se não conseguir, me avisa que eu do um jeito)-->
                <!--Fiquei meio confuso com o método que você usou pra fazer a parte de busca então juntei o método que
                eu tinha usado pra fazer com o css da página pra nn ficar encucado perguntando 30 coisas diferentes pra IA
                de como mexer ali se der algum problema-->
                <table class="tabelaMenu">
                    <tr>
                        <th>Destino</th>
                        <th>Data Ida</th>
                        <th>Data Volta</th>
                        <th>Vagas</th>
                    </tr>
                <?php while($v = $resViagens->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $v['destino']; ?></td>
                        <td><?php echo $v['dtIda']; ?></td>
                        <td><?php echo $v['dtVolta']; ?></td>
                        <td><?php echo $v['vagas']; ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <div class="reservas">
                <a href="reservas.php">Ver mais</a>
                <h2>Realizar Reservas</h2>
                <p>Faça novas reservas</p>
                <hr>
                <!--Colocar as 3 reservas cadastradas mais recentes (se não conseguir, me avisa que eu do um jeito)-->
                <table class="tabelaMenu">
                    <tr>
                        <th>Cliente</th>
                        <th>Pacote</th>
                        <th>Data Reserva</th>
                        <th>Status</th>
                    </tr>
                <?php while($r = $resReservas->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $r['nomeCliente']; ?></td>
                        <td><?php echo $r['nomePacote']; ?></td>
                        <td><?php echo $r['dataReserva']; ?></td>
                        <td><?php echo $r['status']; ?></td>
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