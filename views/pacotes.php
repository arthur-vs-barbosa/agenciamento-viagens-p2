<?php include '../sql/crudPacotes.php'; ?>
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
                <h1>Pacotes</h1>
                <!--Formulário-->
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    <div class="organForm">
                        <label>ID Viagem</label>
                        <input type="number" name="idViagem">
                    </div>
                    <div class="organForm">
                        <label>Nome</label>
                        <input type="text" name="nome">
                    </div>
                    <div class="organForm">
                        <label>Descrição</label>
                        <input type="text" name="descricao">
                    </div>
                    <div class="organForm">
                        <label>Preço</label>
                        <input type="number" name="preco" step="0.01">
                    </div>
                    <div class="organForm">
                        <label>Beneficios</label>
                        <input type="text" name="beneficios">
                    </div>
                    <button type="submit">Enviar</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Lista de Pacotes</h1>
                    <!--Aqui colocar uma lista dos pacotes já cadastrados e um método de pesquisa-->
                    <!-- Pesquisa de clientes -->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo nome">
                        <button type="submit">Pesquisar</button>
                    </form>

                    <!-- Tabela de pacotes -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>ID Viagem</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Benefícios</th>
                            <th>Ações</th>
                        </tr>
                    <!--Procura pela associtaiva-->
                    <?php while($pacote = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $pacote['id']; ?></td>
                            <td><?php echo $pacote['idViagem']; ?></td>
                            <td><?php echo $pacote['nome']; ?></td>
                            <td><?php echo $pacote['descricao']; ?></td>
                            <td><?php echo $pacote['preco']; ?></td>
                            <td><?php echo $pacote['beneficios']; ?></td>
                            <td>
                                <a href="?editar=<?php echo $pacote['id']; ?>">Editar</a> |
                                <a href="?excluir=<?php echo $pacote['id']; ?>" onclick="return confirm('Excluir pacote?')">Excluir</a>
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