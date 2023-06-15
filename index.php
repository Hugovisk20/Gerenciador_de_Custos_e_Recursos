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

if(isset($_REQUEST["exV"])){
    $ID = $_REQUEST["exV"];

    adicionaProdutoQtd($ID);

    deletaVenda("ID", $ID);

    header("location: ./");
}

if(isset($_REQUEST["exC"])){
    $ID = $_REQUEST["exC"];

    removeProdutoQtd($ID);

    deletaCompra("ID", $ID);

    header("location: ./");
}

if(isset($_REQUEST["exF"])){
    $ID = $_REQUEST["exF"];

    deletaFornecedor($ID);

    header("location: ./");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Gerenciador</title>

    <link rel="stylesheet" href="./ASSETS/CSS/style.css">

    <link rel="stylesheet" href="./LIBS/jquery-nice-select-1.1.0/css/nice-select.css">

</head>
<body>

    <header class="header">

        <nav class="nav">

            <ul class="nav__list">

                <li class="nav_item"><a href="./?enserrarSessão">Enserrar Sessão</a></li>

            </ul>

        </nav>

    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--tabelas">

                <div class="box__contains box__contains--produtos">

                    <a class='box__ancor box__ancor--form' href='./PRODUTO'>Cadastrar Produto</a>

                    <div class="box__container">

                        <table class="box__table">

                            <thead class="box__thead">

                                <th class="box__th">Código</th>
                                <th class="box__th">Nome</th>
                                <th class="box__th">Unidade de Produto</th>
                                <th class="box__th">Quantidade</th>
                                <th class="box__th">Preço de Venda</th>
                                <th class="box__th">Preço Total da Mercadoria</th>

                            </thead>

                            <tbody class="box__tbody">

                                <?php
                                
                                $result = selectProduto();
                                //verifica se a tabela produtos não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $ID = $r["ID"];
                                        $COD = $r["CODIGO_PRODUTO"];
                                        $NOME = $r["NOME"];
                                        $UNIDADE = $r["UNIDADE"];
                                        $QUANTIDADE = $r["QUANTIDADE"];
                                        $PRC_VENDA = $r["PRECO_VENDA"];

                                        if($QUANTIDADE < 0){
                                            $link = conectaBanco();

                                            $sql = "DELETE FROM vendas WHERE CODIGO_PRODUTO = '$COD'";
                                            $result = mysqli_query($link, $sql);
                                        }
                    
                                        //Atualiza na tabela produtos o preço total de venda da mercadoria
                                        atuaizaPrecoTotalProduto($QUANTIDADE, $PRC_VENDA, $COD);

                                        $PRC_TOTAL = $r["PRECO_TOTAL"];

                                        //Mostra a informação na tela em formato HTML
                                        echo "<tr> <td> $COD </td> <td> $NOME </td> <td> $UNIDADE </td> <td> $QUANTIDADE </td> <td> $PRC_VENDA </td> <td> $PRC_TOTAL </td> <td> <a class='box__ancor box__ancor--ex' href='?exP=$COD'>Excluir</a> </td> <td> <a class='box__ancor box__ancor--al' href='./PRODUTO?alP=$ID'>Alterar</a> </td> </tr>";                            

                                    }

                                }
                                
                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="box__contains box__contains--compras">

                    <a class='box__ancor box__ancor--form' href='./COMPRA'>Cadastrar Compra</a>

                    <div class="box__container">

                        <table class="box__table">

                            <thead class="box__thead">

                                <th class="box__th">Produto</th>
                                <th class="box__th">Fornecedor</th>
                                <th class="box__th">Preço da Compra</th>
                                <th class="box__th">Quantidade</th>
                                <th class="box__th">Total da Compra</th>

                            </thead>

                            <tbody class="box__tbody">

                                <?php
                                    
                                    $result = selectCompra();
                                    //Verifica se a tabela vendas não está vazia
                                    if(mysqli_num_rows($result) != 0){

                                        foreach($result as $r){

                                            $ID = $r["ID"];
                                            $COD = $r["FK_COD_PRODUTO"];
                                            $NOME_FORNECEDOR = $r["FK_NOME_FORNECEDOR"];
                                            $PRC_COMPRA = $r["PRECO_COMPRA"];
                                            $QUANTIDADE = $r["QUANTIDADE"];
                                            $TOTAL_COMPRA = $r["TOTAL_COMPRA"];

                                            //Mostra na tela a informação em formato HTML
                                            echo "<tr> <td> $COD </td> <td> $NOME_FORNECEDOR </td> <td> $PRC_COMPRA </td> <td> $QUANTIDADE </td> <td> $TOTAL_COMPRA </td> <td> <a class='box__ancor box__ancor--ex' href='?exC=$ID'>Excluir</a> </td> </tr>";

                                        }

                                    }
                                    
                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="box__contains box__contains--vendas">

                    <a class='box__ancor box__ancor--form' href='./VENDA'>Cadastrar Venda</a>

                    <div class="box__container">

                        <table class="box__table">

                            <thead class="box__thead">

                                <th class="box__th">Produto</th>
                                <th class="box__th">Preço de Venda do Produto</th>
                                <th class="box__th">Quantidade</th>
                                <th class="box__th">Total da Venda</th>

                            </thead>

                            <tbody class="box__tbody">

                                <?php
                                    
                                    $result = selectVenda();
                                    //Verifica se a tabela vendas não está vazia
                                    if(mysqli_num_rows($result) != 0){

                                        foreach($result as $r){

                                            $ID = $r["ID"];
                                            $COD = $r["FK_COD_PRODUTO"];
                                            $PRC_VENDA = $r["FK_PRCV_PRODUTO"];
                                            $QUANTIDADE = $r["QUANTIDADE"];
                                            $TOTAL_VENDA = $r["TOTAL_VENDA"];

                                            //Mostra na tela a informação em formato HTML
                                            echo "<tr> <td> $COD </td> <td> $PRC_VENDA </td> <td> $QUANTIDADE </td> <td> $TOTAL_VENDA </td> <td> <a class='box__ancor box__ancor--ex' href='?exV=$ID'>Excluir</a> </td> </tr>";

                                        }

                                    }
                                    
                                ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="box__contains box__contains--fornecedores">

                    <a class='box__ancor box__ancor--form' href='./FORNECEDOR'>Cadastrar Fornecedor</a>

                    <div class="box__container">

                        <table class="box__table">

                            <thead class="box__thead">

                                <th class="box__th">Nome do Fornecedor</th>
                                <th class="box__th">CNPJ do Fornecedor</th>

                            </thead>

                            <tbody class="box__tbody">

                                <?php
                                    
                                    $result = selectFornecedor();
                                    //Verifica se a tabela vendas não está vazia
                                    if(mysqli_num_rows($result) != 0){

                                        foreach($result as $r){

                                            $ID = $r["ID"];
                                            $NOME = $r["NOME"];
                                            $CNPJ = $r["CNPJ"];
                                            
                                            //Mostra na tela a informação em formato HTML
                                            echo "<tr> <td> $NOME </td> <td> $CNPJ </td> <td> <a class='box__ancor box__ancor--ex' href='?exF=$ID'>Excluir</a> </td> <td> <a class='box__ancor box__ancor--al' href='./FORNECEDOR?alF=$ID'>Alterar</a> </td> </tr>";

                                        }

                                    }
                                    
                                ?>

                            </tbody>

                        </table>

                    </div> 

                </div>

            </section>

        </article>

    </main>

    <footer class="footer">



    </footer>
   
</body>
</html>