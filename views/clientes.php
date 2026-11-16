<?php include '../sql/crudClientes.php'; ?>
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

            <!--Form Criação ou Edição-->
            <div class="meioForm">
                
                <?php if (empty($editar)) { ?>
                    <!-- TELA DE CADASTRO -->
                    <h1>Cadastrar Cliente</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="criar">
                        
                        <div class="organForm">
                            <label>Nome</label>
                            <input type="text" name="nome" required>
                        </div>
                        <div class="organForm">
                            <label>CPF</label>
                            <input type="number" name="cpf" maxlength="11" required>
                        </div>
                        <div class="organForm">
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="organForm">
                            <label>Celular</label>
                            <input type="tel" name="telefone" required>
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>

                <?php } else { ?>
                    <!-- TELA DE EDIÇÃO -->
                    <h1>Editar Cliente</h1>
                    <form method="post" class="cadastrar">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $editar["id"]; ?>">

                        <div class="organForm">
                            <label>Nome</label>
                            <input type="text" name="nome" value="<?php echo $editar["nome"]; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>CPF</label>
                            <input type="number" name="cpf" maxlength="11" value="<?php echo $editar["cpf"]; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $editar["email"]; ?>" required>
                        </div>
                        <div class="organForm">
                            <label>Celular</label>
                            <input type="tel" name="telefone" value="<?php echo $editar["telefone"]; ?>" required>
                        </div>

                        <div class="acoes-form">
                            <button type="submit">Salvar Edição</button>
                            <a href="clientes.php">Cancelar</a>
                        </div>
                    </form>
                    <!-- O FORMULÁRIO DE EDIÇÃO TERMINA EXATAMENTE AQUI -->
                <?php } ?>

                <hr>
                <div class="gerenciar">
                    <h1>Clientes Cadastrados</h1>
                    <!--Aqui colocar uma lista dos clientes já cadastrados e um método de pesquisa-->
                    <!-- Pesquisa de clientes -->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo nome">
                        <button type="submit">Pesquisar</button>
                    </form>

                     <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                    <form action="../relatorios/gerarPDF.php" method="get" class="formPDF">
                            <input type="hidden" name="tipo" value="clientes">
                            <button type="submit">Relatório de Clientes</button>
                    </form>

                    <!-- Tabela de clientes -->
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    <!--Procura pela associtaiva-->
                    <?php while($cliente = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['cpf']; ?></td>
                            <td><?php echo $cliente['email']; ?></td>
                            <td><?php echo $cliente['telefone']; ?></td>
                            <td>
                                <a href="?editar=<?php echo $cliente['id']; ?>">Editar</a> |
                                <a href="?excluir=<?php echo $cliente['id']; ?>" onclick="return confirm('Excluir cliente?')">Excluir</a>
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