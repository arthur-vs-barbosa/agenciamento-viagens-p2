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

            <!--Form Criação-->
            <div class="meioForm">
                <h1>Cadastrar Cliente</h1>
                <!--Formulário-->
                <form method="post" class="cadastrar">
                    <input type="hidden" name="acao" value="criar">
                    <div class="organForm">
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Nome do cliente">
                    </div>
                    <div class="organForm">
                        <label>CPF</label>
                        <input type="number" name="cpf" maxlength="11" placeholder="111.222.333-44">
                    </div>
                    <div class="organForm">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email.cliente@gmail.com">
                    </div>
                        <div class="organForm">
                        <label>Celular</label>
                        <input type="tel" name="telefone" placeholder="11 22222-3333">
                    </div>
                    <button type="submit">Cadastrar</button>
                </form>

                <!--Esse botão vai ser responsável por gerar o PDF da página cliente-->
                <form action="../relatorios/gerarPDF.php" method="get" class="relatorioForm">
                    <input type="hidden" name="tipo" value="clientes">
                    <button type="submit">Relatório de Clientes</button>
                </form>

                </form>
                <!--Formulário de edição-->

                <hr>
                <div class="gerenciar">
                    <h1>Clientes Cadastrados</h1>
                    <!--Aqui colocar uma lista dos clientes já cadastrados e um método de pesquisa-->
                    <!-- Pesquisa de clientes -->
                    <form method="get">
                        <input type="text" name="buscar" placeholder="Pesquisar pelo nome" >
                        <button type="submit">Pesquisar</button>
                    </form>

                    <!-- Tabela de clientes -->
                    <table>
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