<?php
    //Implementação do DomPDF
    use Dompdf\Dompdf;
    require_once 'dompdf/autoload.inc.php';

    include '../sql/conexao.php';

    // Recebe o tipo de relatório enviado pelo botão
    $tipo = $_GET['tipo'] ?? '';

    // Define o tipo do relatório que será gerado
    switch($tipo){
        case 'clientes':
            //Título do PDF
            $titulo = "Relatório de Clientes";

            /* !!!IMPORTANTE!!! Aqui eu tive que salvar as colunas e campos do banco de acordo com suas respectivas
            tabelas pra pesquisa e geração através das variáveis pra otimizar a criação de vários arquivos
            e linhas de html, isso em cada uma das tabelas, se alguém estiver lendo isso... por favor me
            ajude, eu estou enlouquecendo*/

            $colunas = ['ID', 'Nome', 'CPF', 'Email','telefone'];
            $campos = ['id', 'nome', 'cpf', 'email','telefone'];

            // Busca os clientes
            $sql = "SELECT * FROM cliente";
            break;

        case 'viagens':
            $titulo = "Relatório de Viagens";

            $colunas = ['ID','Destino','Data Ida','Data Volta','Preço Base','Vagas'];
            $campos = ['id', 'destino', 'dtIda', 'dtVolta', 'precoBase', 'vagas'];

            // Busca as viagens
            $sql = "SELECT * FROM viagem";
            break;

        case 'pacotes':
            $titulo = "Relatório de Pacotes";

            $colunas = ['ID','Viagem','Nome','Descrição','Preço','Benefícios'];
            $campos = ['id', 'idViagem', 'nome', 'descricao', 'preco', 'beneficios'];

            // Busca os pacotes
            $sql = "SELECT * FROM pacote";
            break;

        case 'reservas':
            $titulo = "Relatório de Pacotes";

            $colunas = ['ID','Cliente','Pacote','Data Reserva', 'Status'];
            $campos = ['id', 'idCliente', 'idPacote', 'dataReserva', 'status'];

            // Busca os pacotes
            $sql = "SELECT * FROM reserva";
            break;

        case 'pagamentos':
            $titulo = "Relatório de Pacotes";

            $colunas = ['ID', 'Reserva', 'Valor Total', 'Forma de Pagamento', 'Status', 'Data'];
            $campos = ['id', 'idReserva', 'valor', 'formaPagamento', 'statusPagamento', 'dataPagamento'];

            // Busca os pacotes
            $sql = "SELECT * FROM pagamento";
            break;
        
        case 'geral':
            //Título do PDF Gerado
            $titulo = "Relatório Geral";

            /* !!!IMPORTANTE!!! Aqui eu tive que salvar as colunas e do banco pra pesquisa e geração através das variáveis,
            pra otimizar a criação de vários arquivos e linhas de html, e se estiver lendo isso... por favor me ajude, eu
            estou enlouquecendo*/

            $colunas = [];
            $campos = [];

            //Busca dados gerais do cadastro através de joins
            $sql = "";
            break;
        
        default:
            die("Relatório inválido!");
    }
    //Faz a busca no banco de dados através da conexão DEPOIS de verificar qual campo tá sendo selecionado
    $resultado = $conexao->query($sql);
    if(!$resultado){
        die("Erro na consulta: ".$conexao->error);
    }
    
/*A partir daqui muitas coisas importantes devem ser consideradas
O .= no $html serve para concatenar, o que é isso? adiciona mais campos na variável sem
substituir o que já tinha, e acredite, isso será muito usado no código abaixo*/

//Começo do código html principal que será salvo na variável
    $html = '
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">

            <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                    color: #5c5c5c;
                    font-size: 12px;
                    margin: 0;
                    padding: 0;
                }

                /* Cabeçalho da agência */
                .cabecalho {
                    text-align: center;
                    padding-bottom: 15px;
                    border-bottom: 3px solid #3cc4b2;
                }

                .cabecalho h1 {
                    color: #3cc4b2;
                    font-size: 24px;
                    margin: 0;
                }

                .cabecalho p {
                    color: #aaaaaa;
                    font-size: 11px;
                    margin-top: 5px;
                }

                /* Título do relatório */
                .tituloRelatorio {
                    text-align: center;
                    margin-top: 25px;
                    margin-bottom: 20px;
                }

                .tituloRelatorio h2 {
                    color: #5c5c5c;
                    font-size: 18px;
                    margin-bottom: 5px;
                }

                .tituloRelatorio p {
                    color: #aaaaaa;
                    font-size: 11px;
                }

                /* Tabela */
                .tabelaRelatorio {
                    width: 100%;
                    border-collapse: collapse;
                }

                .tabelaRelatorio th {
                    background-color: #3cc4b2;
                    color: #ffffff;
                    padding: 10px 6px;
                    text-align: center;
                    border: 1px solid #dfdfdf;
                }

                .tabelaRelatorio td {
                    padding: 9px 6px;
                    text-align: center;
                    border: 1px solid #dfdfdf;
                    background-color: #fcfcfc;
                }

                /* Rodapé */
                .rodapeRelatorio {
                    margin-top: 30px;
                    padding-top: 10px;
                    border-top: 1px solid #dfdfdf;
                    text-align: center;
                    color: #aaaaaa;
                    font-size: 10px;
                }
            </style>
        </head>

    <body>

        <!-- Cabeçalho da agência -->
        <div class="cabecalho">
            <h1>AGÊNCIA DE TURISMO</h1>
            <p>Relatórios administrativos</p>
        </div>

        <!-- Título e data -->
        <div class="tituloRelatorio">
            <h2>'.$titulo.'</h2>
            <p>Data de emissão: '.date("d/m/Y").'</p>
        </div>

        <!-- Campos de cada tabela -->
        <table class="tabelaRelatorio">
            <thead>';
            //Aqui ocorre a primeira quebra na estrutura html pra fz a lógica do php

            //Usa o foreach pra nomear cada coluna (também com campos html quebrados e remendados com superbonde)
                $html .='<tr>';
                foreach($colunas as $coluna){
                    $html.='<th>'.$coluna.'</th>';
                }
                $html .='</tr>';
            
            $html.='
            </thead>

            <tbody>
            <!-- As linhas serão adicionadas pelo PHP -->';

            //Usa o while pra percorrer os campos no banco de dados por associação antes de imprimir eles
            while($linha = $resultado->fetch_assoc()){
            $html .='<tr>';
            foreach($campos as $campo){
                $html.='<td>'.$linha[$campo].'</td>';
            }
            $html .='</tr>';
            }

            $html .='
            </tbody>
        </table>

        <!-- Rodapé -->
        <div class="rodapeRelatorio">
            Agência de Turismo - Documento gerado automaticamente pelo sistema.
        </div>

        </body>
    </html>
    ';

    //Comandos DomPDF
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html, 'UTF-8');

    // Paisagem porque temos seis colunas
    $dompdf->setPaper('A4', 'portrait');
    
    //Prepara o documento PDF
    $dompdf->render();

    // Limpa qualquer saída anterior
    if(ob_get_length()){
        ob_end_clean();
    }

    // Envia o PDF ao navegador
    //Extra!! O Attachment faz o navegador baixar o pdf ao invés de abrir diretamente
    //OUTRO EXTRA!!! dá p adicionar no próprio nome o tipo do pdf baixado, maravilha nn vou ter q gambiarriar
    $dompdf->stream("relatorio_{$tipo}.pdf", ['Attachment' => true]);
?>