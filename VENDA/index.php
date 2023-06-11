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

</head>
<body>

    <header class="header">



    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--forms">

                <div class="box__form--login">

                    <form action="" method="post" class="form--login">

                        <legend class="form__legend"></legend>

                        <label for="codP" class="form__label">Código de produto</label>
                        <select name="codP" id="codP" class="form__input">

                            <?php
                            
                            $result = selectProduto();
                            //Verificando se a tabela produtos não está vazia
                            if(mysqli_num_rows($result) != 0){

                                foreach($result as $r){

                                    $COD = $r["CODIGO_PRODUTO"];
                                    //Exibindo a informação em formato de opção de um elemento HTML select
                                    echo "<option value='$COD'>$COD</option>";

                                }

                            }
                            
                            ?>

                        </select>
                        
                        <label for="qtd" class="form__label">Quantidade</label>
                        <input type="text" name="qtd" id="qtd" class="form__input">

                        <input type="submit" value="Iniciar Sessão" class="form__input--submit">

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

        </article>

    </main>

    <footer class="footer">



    </footer>
    
</body>
</html>