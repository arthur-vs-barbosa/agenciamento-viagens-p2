<?php include '../sql/crudViagens.php'?>
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
                <h1>Organizar Viagem</h1>
                <form method="post" class="cadastrar">
                    <input type='hidden' name='acao' value='criar'>
                    <div class="organForm">
                        <label>Destino</label>
                        <input type="text" name="destino">
                    </div>
                    <div class="organForm">
                        <label>Ida</label>
                        <input type="date" name="dtIda">
                    </div>
                    <div class="organForm">
                        <label>Volta</label>
                        <input type="date" name="dtVolta">
                    </div>
                    <div class="organForm">
                        <label>Preço Base</label>
                        <input type="number" name="precoBase" step="0.01" min="0">
                    </div>
                    <div class="organForm">
                        <label>Vagas</label>
                        <input type="number" name="vagas">
                    </div>
                    <button type="submit">Salvar</button>
                </form>
                <hr>
                <div class="gerenciar">
                    <h1>Viagens Marcadas</h1>
                </div>

<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->
<h2>Pesquisar viagem</h2>
<form method="get">
    <input type="text" name="buscar" placeholder="Pesquisar destino">
    <button type="submit">Pesquisar</button>
</form>

<h2>Viagens cadastradas</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Destino</th>
        <th>Data de ida</th>
        <th>Data de volta</th>
        <th>Preço</th>
        <th>Vagas</th>
        <th>Ações</th>
    </tr>

    <?php while($viagem = $resultado->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $viagem['id']; ?></td>
            <td><?php echo $viagem['destino']; ?></td>
            <td><?php echo $viagem['dtIda']; ?></td>
            <td><?php echo $viagem['dtVolta']; ?></td>
            <td><?php echo $viagem['precoBase']; ?></td>
            <td><?php echo $viagem['vagas']; ?></td>
            <td>
                <a href="?editar=<?php echo $viagem['id']; ?>">Editar</a> |
                <a href="?excluir=<?php echo $viagem['id']; ?>" onclick="return confirm('Excluir viagem?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if($editar != null){ ?>
    <h2>Alterar viagem</h2>
    <form method="post">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $editar['id']; ?>">

        Destino:
        <input type="text" name="destino" value="<?php echo $editar['destino']; ?>">

        Data de ida:
        <input type="date" name="dtIda" value="<?php echo $editar['dtIda']; ?>">

        Data de volta:
        <input type="date" name="dtVolta" value="<?php echo $editar['dtVolta']; ?>">

        Preço:
        <input type="number" name="precoBase" step="0.01" value="<?php echo $editar['precoBase']; ?>">

        Vagas:
        <input type="number" name="vagas" value="<?php echo $editar['vagas']; ?>">

        <button type="submit">Salvar</button>
    </form>
<?php } ?>
<!--CAMPOS GERADOS PARA TESTAR O CRUD DOS CAMPOS DO BANCO DE DADOS-->

            </div>
        </div>
        <!--Rodapé-->
        <div class="rodape">
            <p>Site realizado para o projeto proposto na disciplina de Desenvolvimento Web II</p>
        </div>
    </body>
</html>