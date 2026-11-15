<?php include '../sql/crudViagens.php'; ?>
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
                <h1>Organizar Viagem</h1>
                <!--Formulário-->
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    <div class="organForm">
                        <label>Destino</label>
                        <input type="text" name="destino" required>
                    </div>
                    <div class="organForm">
                        <label>Ida</label>
                        <input type="date" name="dtIda" required>
                    </div>
                    <div class="organForm">
                        <label>Volta</label>
                        <input type="date" name="dtVolta" required>
                    </div>
                    <div class="organForm">
                        <label>Preço Base</label>
                        <input type="number" name="precoBase" step="0.01" min="0" required>
                    </div>
                    <div class="organForm">
                        <label>Vagas</label>
                        <input type="number" name="vagas" required>
                    </div>
                    <button type="submit">Salvar</button>
                </form>
                <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                <form action="../relatorios/gerarPDF.php" method="get">
                    <input type="hidden" name="tipo" value="viagens">
                    <button type="submit">Relatório de Viagens</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Viagens Marcadas</h1>
                    <!--Aqui colocar uma lista das viagens já marcadas e um método de pesquisa-->
                    <!-- Tabela de viagens -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Destino</th>
                            <th>Data Ida</th>
                            <th>Data Volta</th>
                            <th>Preço Base</th>
                            <th>Vagas</th>
                            <th>Ações</th>
                        </tr>
                        <?php while($viagem = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $viagem['id']; ?></td>
                            <td><?php echo $viagem['destino']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($viagem['dtIda'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($viagem['dtVolta'])); ?></td>
                            <td>R$ <?php echo number_format($viagem['precoBase'], 2, ',', '.'); ?></td>
                            <td><?php echo $viagem['vagas']; ?></td>
                            <td>
                                <a href="?editar=<?php echo $viagem['id']; ?>">Editar</a> |
                                <a href="?excluir=<?php echo $viagem['id']; ?>" onclick="return confirm('Excluir viagem?')">Excluir</a>
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