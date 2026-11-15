<?php include "../sql/conexao.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agência de Turismo</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
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
                <p>-</p><!--Colocar o count total de clientes cadastrado aonde está a tag 'p'-->
                <a href="cliente.html">Ver mais</a>
            </div> 
            <div class="pagamento">
                <img src="../Icones/currency-dollar.svg" alt="money">
                <h2>Pagamentos</h2>
                <p>-</p><!--Colocar o count do valor total de pagamentos recebidos aonde está a tag 'p'-->
                <a href="pagar.html">Ver mais</a>
            </div>
            <div class="relatorios">
                <img src="../Icones/clipboard-fill.svg" alt="clipboard">
                <h2>Relatórios</h2>
                <p>-</p><!--Aqui pode deixar em branco caso você não tenha ideia do que adicionar-->
                <a href="relatorios.html">Ver mais</a>
            </div>
            <div class="viagens">
                <a href="viagem.html">Ver mais</a>
                <h2>Organizar Viagens</h2>
                <p>Organizar os próximos destinos</p>
                <hr>
                <!--Colocar as 3 viagens cadastradas mais recentes (se não conseguir, me avisa que eu do um jeito)-->
            </div>
            <div class="reservas">
                <a href="reserva.html">Ver mais</a>
                <h2>Realizar Reservas</h2>
                <p>Faça novas reservas</p>
                <hr>
                <!--Colocar as 3 reservas cadastradas mais recentes (se não conseguir, me avisa que eu do um jeito)-->
            </div>
           
        </div>
        
    </div>
    <!--Rodapé-->
    <div class="rodape">
        <p>Site realizado para o projeto proposto na disciplina de Desenvolvimento Web II</p>
    </div>
</body>
</html>