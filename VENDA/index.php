<?php

include("../functions.php");

//Verificação se os dados do formlário foram enviados
if(isset($_REQUEST["codP"]) && isset($_REQUEST["qtd"])){

    $codP = $_REQUEST["codP"];
    $qtd = $_REQUEST["qtd"];

    //Verificação se os dados do formalário não estão vazios
    if($codP != "" && $qtd != ""){

        $result = selectProdutoWhere($codP);
        //Verificando se a tabela produtos não está vazia
        if(mysqli_num_rows($result) != 0){

            foreach ($result as $r) {
                
                $PRC_VENDA = $r["PRECO_VENDA"];
                $QTD = $r["QUANTIDADE"];

                if($qtd < $QTD){

                    $tot = $qtd * $PRC_VENDA;

                    $result = insertVenda($codP, $qtd, $tot);

                    //Atualizando a coluna quantidade da tabela produtos, removendo a quantidade vendida da coluna
                    vendeProduto();

                    header("location: ./?msg=insertTrue");  

                }else{
                    header("location: ./?msg=qtdInsufficient");
                }

            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas - Gerenciador</title>

    <link rel="stylesheet" href="../ASSETS/CSS/style.css">

    <link rel="stylesheet" href="../LIBS/jquery-nice-select-1.1.0/css/nice-select.css">

</head>
<body>

    <header class="header">



    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--forms">

                <div class="box__form box__form--login">

                    <form action="" method="post" class="form form--login">

                        <legend class="form__legend"></legend>

                        <div class="form__campo form__campo--1">
                            <label for="codP" class="form__label">Código de produto</label>
                            <select name="codP" id="codP" class="form__input form__input--select">

                                <?php
                                
                                $result = selectProduto();
                                //Verificando se a tabela produtos não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $COD = $r["CODIGO_PRODUTO"];
                                        //Exibindo a informação em formato de opção de um elemento HTML select
                                        echo "<option class='form__option' value='$COD'>$COD</option>";

                                    }

                                }
                                
                                ?>

                            </select>                            
                        </div>

                        <div class="form__campo form__campo--2">
                            <label for="qtd" class="form__label">Quantidade</label>
                            <input type="text" name="qtd" id="qtd" class="form__input">                            
                        </div>
                    
                        <input type="submit" value="Iniciar Sessão" class="form__input form__input--submit">

                    </form>

                    <?php
                    //Verificando se existe a variável para a exibição de uma mensagem
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "insertTrue"){
                            echo "Venda cadastrada com Sucesso";
                        }else if($msg = "qtdInsufficient"){
                            echo "Não pode vender mais produtos do que tem no estoque";
                        }

                    }
                    ?>

                </div>

            </section>

            <a href="../" class="box__ancor box__ancor--back">Voltar</a>

        </article>

    </main>

    <footer class="footer">



    </footer>

    <script src="../LIBS/jquery-nice-select-1.1.0/js/jquery.js"></script> 
    <script src="../LIBS/jquery-nice-select-1.1.0/js/jquery.nice-select.js"></script>

    <script>

        $(document).ready(function() {
        $('select').niceSelect();
        });

    </script>
    
</body>
</html>