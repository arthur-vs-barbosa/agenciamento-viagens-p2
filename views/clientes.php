<?php include '../sql/crudClientes.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Cliente</title>
        <link rel="stylesheet" href="../CSS/stylesheet.css">
        <link rel="stylesheet" href="../CSS/styleForm.css">
    </head>
    <body>
        <div id="main">
            <!--Lateral do site-->
            <?php include 'lateralsite.php';?>

            <!--Cadastro de Cliente-->
            <div class="meioForm">
                    <h1>Cadastrar Cliente</h1>
                    <form method="post" class="cadastrar">
                        <!--Input escondido pra ação-->
                        <input type="hidden" name="acao" value="criar">

                        <div class="organForm">
                            <label>Nome</label>
                            <input type="text" name="nome">
                        </div>
                        <div class="organForm">
                            <label>CPF</label>
                            <input type="number" name="cpf" maxlength='11' required>
                        </div>
                        <div class="organForm">
                            <label>Email</label>
                            <input type="email" name="email">
                        </div>
                        <div class="organForm">
                            <label>Celular</label>
                            <input type="tel" name="telefone">
                        </div>
                        <button type="submit">Cadastrar</button>
                    </form>
                <hr>
                <div class="gerenciar">
                    <h1>Lista de Clientes</h1>
                </div>

<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
<h2>Pesquisar cliente</h2>

<form method="get">
    <input type="text" name="buscar" placeholder="Pesquisar por nome">
    <button type="submit">Pesquisar</button>
</form>

<h2>Clientes cadastrados</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>

    <?php while($cliente = $resultado->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $cliente['id']; ?></td>
            <td><?php echo $cliente['nome']; ?></td>
            <td><?php echo $cliente['cpf']; ?></td>
            <td><?php echo $cliente['email']; ?></td>
            <td><?php echo $cliente['telefone']; ?></td>
            <td>
                <a href="?editar=<?php echo $cliente['id']; ?>">Editar</a>
                |
                <a href="?excluir=<?php echo $cliente['id']; ?>" onclick="return confirm('Excluir cliente?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if($editar != null){ ?>
    <h2>Alterar cliente</h2>

    <form method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">

        <input type="text" name="nome" value="<?php echo $editar['nome']; ?>">
        <input type="text" name="cpf" value="<?php echo $editar['cpf']; ?>">
        <input type="email" name="email" value="<?php echo $editar['email']; ?>">
        <input type="text" name="telefone" value="<?php echo $editar['telefone']; ?>">

        <button type="submit">Salvar alterações</button>
    </form>
<?php } ?>
<!--FIM DOS CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
            </div>
            
        </div>
        <!--Rodapé-->
        <div class="rodape">
            <p>Site realizado para o projeto proposto na disciplina de Desenvolvimento Web II</p>
        </div>
    </body>
</html>