<?php include '../sql/crudPacotes.php'?>
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
            <?php include 'lateralsite.php' ?>

            <div class="meioForm">
                <h1>Pacotes</h1>
                <form method="post" class="cadastrar">
                    <input type='hidden' name='acao' value='criar'>
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
                        <input type="number" name="precoPacote" step="0.01" min="0">
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
                </div>

<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
<h2>Pesquisar pacote</h2>
<form method="get">
    <input type="text" name="buscar" placeholder="Pesquisar pacote">
    <button type="submit">Pesquisar</button>
</form>

<h2>Pacotes cadastrados</h2>
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

<?php if($editar != null){ ?>
    <h2>Alterar pacote</h2>
    <form method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">

        ID Viagem:
        <input type="number" name="idViagem" value="<?php echo $editar['idViagem']; ?>">

        Nome:
        <input type="text" name="nome" value="<?php echo $editar['nome']; ?>">

        Descrição:
        <textarea name="descricao"><?php echo $editar['descricao']; ?></textarea>

        Preço:
        <input type="number" name="preco" step="0.01" value="<?php echo $editar['preco']; ?>">

        Benefícios:
        <textarea name="beneficios"><?php echo $editar['beneficios']; ?></textarea>

        <button type="submit">Salvar</button>
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