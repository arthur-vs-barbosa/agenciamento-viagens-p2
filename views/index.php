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
    $resCountP=$conexao->query("SELECT * FROM pagamento");//Trocar para o lucro total
    $totalPagamentos=$resCountP->num_rows;

    //Contagem de Pacotes
    $resCountT=$conexao->query("SELECT * FROM pacote");
    $totalPacotes=$resCountT->num_rows;

    //Define o total de informações recentes do viagens e reservas
    $totalRescentes=6;    
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
                <p><?php echo $totalClientes;?></p>
                <a href="clientes.php">Ver mais</a>
            </div> 
            <div class="pagamento">
                <img src="../Icones/currency-dollar.svg" alt="money">
                <h2>Pagamentos</h2>
                <p><?php echo $totalPagamentos;?></p><!--Colocar o lucro total-->
                <a href="pagamentos.php">Ver mais</a>
            </div>
            <div class="pacotesTurist">
                <img src="../Icones/suitcase2-fill.svg" alt="clipboard">
                <h2>Pacotes Turisticos</h2>
                <p><?php echo $totalPacotes;?></p>
                <a href="pacotes.php">Ver mais</a>
            </div>
            <div class="viagens">
                <a href="viagens.php">Ver mais</a>
                <h2>Organizar Viagens</h2>
                <p>Últimas viagens cadastradas</p>
                <hr>
                <!--Viagens rescentes-->
                <table class="tabelaMenu">
                    <tr>
                        <th>ID:</th>
                        <th>Destino:</th>
                        <th>Data Ida:</th>
                        <th>Vagas:</th>
                    </tr>
                    <?php
                    $stmt=$conexao->prepare("SELECT * FROM viagem ORDER BY id DESC LIMIT ?");
                    $stmt->bind_param("i",$totalRescentes);
                    $stmt->execute();
                    $ultimosV=$stmt->get_result();
                    while($linhaV=$ultimosV->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $linhaV["id"]?></td>
                        <td><?php echo $linhaV["destino"]?></td>
                        <td><?php echo $linhaV["dtIda"]?></td>
                        <td><?php echo $linhaV["vagas"]?></td>
                    </tr>        
                    <?php } ?>
                </table>
            </div>
            <div class="reservas">
                <a href="reservas.php">Ver mais</a>
                <h2>Realizar Reservas</h2>
                <p>Últimas reservas cadastradas</p>
                <hr>
                <!--Reservas rescentes-->
                <table>
                    <tr>
                        <th>ID:</th>
                        <th>ID Cliente:</th>
                        <th>Data Reserva:</th>
                        <th>Status:</th>
                    </tr>
                    <?php
                    $stmt=$conexao->prepare("SELECT * FROM reserva ORDER BY id DESC LIMIT ?");
                    $stmt->bind_param("i",$totalRescentes);
                    $stmt->execute();
                    $ultimosR=$stmt->get_result();
                    while($linhaR=$ultimosR->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $linhaR['id']?></td>
                        <td><?php echo $linhaR['idCliente']?></td>
                        <td><?php echo $linhaR['dataReserva']?></td>
                        <td><?php echo $linhaR['status']?></td>
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