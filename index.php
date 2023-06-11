<?php

include("./functions.php");

session_start();

//Validação para o redirecionamento paa a página de login
if(!isset($_SESSION["USER"])){

    header("location: ./LOGIN");

}

//Validação para e exclusão da variável de sessão
if(isset($_REQUEST["enserrarSessão"])){
    session_destroy();

    header("location: ./");
}

//Valiações para a exclusão de dados

if(isset($_REQUEST["exP"])){
    $COD = $_REQUEST["exP"];

    deletaProduto($COD);

    deletaCompra("FK_COD_PRODUTO", $COD);

    deletaVenda("FK_COD_PRODUTO", $COD);

    header("location: ./");
}

if(isset($_REQUEST["alP"])){
    $COD = $_REQUEST["alP"];

    header("location: ./");
}

if(isset($_REQUEST["exV"])){
    $ID = $_REQUEST["exV"];

    adicionaProdutoQtd($ID);

    deletaVenda("ID", $ID);

    header("location: ./");
}

if(isset($_REQUEST["alV"])){
    $ID = $_REQUEST["alV"];

    header("location: ./");
}

if(isset($_REQUEST["exC"])){
    $ID = $_REQUEST["exC"];

    removeProdutoQtd($ID);

    deletaCompra("ID", $ID);

    header("location: ./");
}

if(isset($_REQUEST["alC"])){
    $COD = $_REQUEST["alC"];

    header("location: ./");
}

if(isset($_REQUEST["exF"])){
    $ID = $_REQUEST["exF"];

    deletaFornecedor($ID);

    header("location: ./");
}

if(isset($_REQUEST["alF"])){
    $COD = $_REQUEST["alF"];

    header("location: ./");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Gerenciador</title>

</head>
<body>

    <header class="header">

        <nav class="nav">

            <ul class="nav_list">

                <li class="nav_item"><a href="./?enserrarSessão">Enserrar Sessão</a></li>

            </ul>

        </nav>

    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--tabelas">

                <div class="box__contains box__contains--produtos">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Código</th>
                            <th class="box__th">Nome</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Preço da Venda</th>
                            <th class="box__th">Preço Total de Venda</th>

                        </thead>

                        <tbody>

                            <?php
                            
                            $result = selectProduto();
                            //verifica se a tabela produtos não está vazia
                            if(mysqli_num_rows($result) != 0){

                                foreach($result as $r){

                                    $COD = $r["CODIGO_PRODUTO"];
                                    $NOME = $r["NOME"];
                                    $QUANTIDADE = $r["QUANTIDADE"];
                                    $PRC_VENDA = $r["PRECO_VENDA"];
                
                                    //Atualiza na tabela produtos o preço total de venda da mercadoria
                                    atuaizaPrecoTotalProduto($QUANTIDADE, $PRC_VENDA, $COD);

                                    $PRC_TOTAL = $r["PRECO_TOTAL"];

                                    //Mostra a informação na tela em formato HTML
                                    echo "<tr> <td> $COD </td> <td> $NOME </td> <td> $QUANTIDADE </td> <td> $PRC_VENDA </td> <td> $PRC_TOTAL </td> <td> <a href='?exP=$COD'>Excluir</a> </td> <td> <a href='?alP=$COD'>Alterar</a> </td> </tr>";                            

                                }

                            }
                            
                            ?>

                        </tbody>

                    </table>

                    <a href="./PRODUTO">Cadastrar Produto</a>

                </div>

                <div class="box__contains box__contains--compras">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Produto</th>
                            <th class="box__th">Fornecedor</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Total da Venda</th>

                        </thead>

                        <tbody>

                            <?php
                                
                                $result = selectCompra();
                                //Verifica se a tabela vendas não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $ID = $r["ID"];
                                        $COD = $r["FK_COD_PRODUTO"];
                                        $NOME_FORNECEDOR = $r["FK_NOME_FORNECEDOR"];
                                        $QUANTIDADE = $r["QUANTIDADE"];
                                        $TOTAL_COMPRA = $r["TOTAL_COMPRA"];

                                        //Mostra na tela a informação em formato HTML
                                        echo "<tr> <td> $COD </td> <td> $NOME_FORNECEDOR </td> <td> $QUANTIDADE </td> <td> $TOTAL_COMPRA </td> <td> <a href='?exC=$ID'>Excluir</a> </td> <td> <a href='?alC=$ID'>Alterar</a> </td> </tr>";

                                    }

                                }
                                
                            ?>

                        </tbody>

                    </table>

                    <a href="./COMPRA">Cadastrar Compra</a>

                </div>

                <div class="box__contains box__contains--vendas">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Produto</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Total da Venda</th>

                        </thead>

                        <tbody>

                            <?php
                                
                                $result = selectVenda();
                                //Verifica se a tabela vendas não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $ID = $r["ID"];
                                        $COD = $r["FK_COD_PRODUTO"];
                                        $QUANTIDADE = $r["QUANTIDADE"];
                                        $TOTAL_VENDA = $r["TOTAL_VENDA"];

                                        //Mostra na tela a informação em formato HTML
                                        echo "<tr> <td> $COD </td> <td> $QUANTIDADE </td> <td> $TOTAL_VENDA </td> <td> <a href='?exV=$ID'>Excluir</a> </td> <td> <a href='?alV=$ID'>Alterar</a> </td> </tr>";

                                    }

                                }
                                
                            ?>

                        </tbody>

                    </table>

                    <a href="./VENDA">Cadastrar Venda</a>

                </div>

                <div class="box__contains box__contains--fornecedores">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Nome do Fornecedor</th>
                            <th class="box__th">CNPJ do Fornecedor</th>

                        </thead>

                        <tbody>

                            <?php
                                
                                $result = selectFornecedor();
                                //Verifica se a tabela vendas não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $ID = $r["ID"];
                                        $NOME = $r["NOME"];
                                        $CNPJ = $r["CNPJ"];
                                        
                                        //Mostra na tela a informação em formato HTML
                                        echo "<tr> <td> $NOME </td> <td> $CNPJ </td> <td> <a href='?exF=$ID'>Excluir</a> </td> <td> <a href='?alF=$ID'>Alterar</a> </td> </tr>";

                                    }

                                }
                                
                            ?>

                        </tbody>

                    </table>

                    <a href="./FORNECEDOR">Cadastrar Fornecedor</a>

                </div>

            </section>

        </article>

    </main>

    <footer class="footer">



    </footer>
   
</body>
</html>