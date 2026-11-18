<?php include '../sql/crudPacotes.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Pacotes</title>
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
                <h1>Cadastrar Pacote</h1>
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    
                    <div class="organForm">
                        <label>ID Viagem</label>
                        <input type="number" name="idViagem" placeholder="ID da viagem associada" required>
                    </div>
                    <div class="organForm">
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Ex: Pacote turístico para Mimami na Flórida" required>
                    </div>
                    <div class="organForm">
                        <label>Descrição</label>
                        <input type="text" name="descricao" placeholder="Ex: Um pacote turístico pra Miami com ótimos benefícios" required>
                    </div>
                    <div class="organForm">
                        <label>Preço</label>
                        <input type="number" step="0.01" name="preco" placeholder="Ex: 999,99" required>
                    </div>
                    <!-- Benefícios ocupa a largura inteira das duas colunas... é, dá p fz style sem o arquivo css-->
                    <div class="organForm" style="grid-column: 1 / -1;">
                        <label>Benefícios</label>
                        <input type="text" name="beneficios" placeholder="Ex: Café da manhã e Almoço incluso, guia de turismo" required style="width: 100%;">
                    </div>

                    <div class="acoes-form">
                        <button type="submit">Cadastrar</button>
                    </div>
                </form>

            <?php } else { ?>
                <!-- TELA DE EDIÇÃO -->
                <h1>Editar Pacote</h1>
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php echo $editar["id"] ?? ''; ?>">

                    <div class="organForm">
                        <label>ID Viagem</label>
                        <input type="number" name="idViagem" value="<?php echo $editar["idViagem"] ?? ''; ?>" required>
                    </div>
                    <div class="organForm">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $editar["nome"] ?? ''; ?>" required>
                    </div>
                    <div class="organForm">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php echo $editar["descricao"] ?? ''; ?>" required>
                    </div>
                    <div class="organForm">
                        <label>Preço</label>
                        <input type="number" step="0.01" name="preco" value="<?php echo $editar["preco"] ?? ''; ?>" required>
                    </div>
                    <!-- Benefícios ocupa a largura inteira das duas colunas -->
                    <div class="organForm" style="grid-column: 1 / -1;">
                        <label>Benefícios</label>
                        <input type="text" name="beneficios" value="<?php echo $editar["beneficios"] ?? ''; ?>" required style="width: 100%;">
                    </div>

                    <div class="acoes-form">
                        <button type="submit">Salvar Edição</button>
                        <a href="pacotes.php">Cancelar</a>
                    </div>
                </form>
            <?php } ?>
                
                <hr>
                <div class="gerenciar">
                    <h1>Lista de Pacotes</h1>
                    <!--Aqui colocar uma lista dos pacotes já cadastrados e um método de pesquisa-->
                    <!-- Pesquisa de pacotes -->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo nome">
                        <button type="submit">Pesquisar</button>
                    </form>

                    <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                    <form action="../relatorios/gerarPDF.php" method="get" class="formPDF">
                        <input type="hidden" name="tipo" value="pacotes">
                        <button type="submit">Relatório de Pacotes</button>
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