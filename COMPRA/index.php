<?php

include("../functions.php");

//Verificação se os dados do formlário foram enviados
if(isset($_REQUEST["codP"]) && isset($_REQUEST["codF"]) && isset($_REQUEST["qtd"])){

    $codP = $_REQUEST["codP"];
    $codF = $_REQUEST["codF"];
    $qtd = $_REQUEST["qtd"];

    //Verificação se os dados do formalário não estão vazios
    if($codP != "" && $codF != "" && $qtd != ""){

        $result = selectProdutoWhere($codP);

        //Verificando se a tabela produtos não está vazia
        if(mysqli_num_rows($result) != 0){

            foreach ($result as $r) {
                
                $PRC_VENDA = $r["PRECO_VENDA"];

            }

        }

        //Calculando total do compra e armazenando na variável, adicionando quantidade comprada a coluna
        $tot = $qtd * $PRC_VENDA;

        $result = insertCompra($codP, $codF, $qtd, $tot);

        //Atulazizando coluna quantidade da tabela produtos
        compraProduto();

        header("location: ./?msg=insertTrue");

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras - Gerenciador</title>

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
                            //Veridicando se a tabela produtos ão está vazia
                            if(mysqli_num_rows($result) != 0){

                                foreach($result as $r){

                                    $COD = $r["CODIGO_PRODUTO"];
                                    //Exibindo a informação na forma de uma opção de um elemento HTML select
                                    echo "<option value='$COD'>$COD</option>";

                                }

                            }
                            
                            ?>

                        </select>

                        <label for="codF" class="form__label">Código do Fornecedor</label>
                        <select name="codF" id="codF" class="form__input">
                            <option value="Sem Fornecedor">Sem Fornecedor</option>
                            <?php
                                
                                $result = selectFornecedor();
                                //Verificando se a taela dornecedores não está vazia
                                if(mysqli_num_rows($result) != 0){

                                    foreach($result as $r){

                                        $NOME = $r["NOME"];
                                        //Exibindo a informação na forma e uma opção de um elemento HTMl select
                                        echo "<option value='$NOME'>$NOME</option>";

                                    }

                                }
                                
                            ?>

                        </select>
                        
                        <label for="qtd" class="form__label">Quantidade</label>
                        <input type="text" name="qtd" id="qtd" class="form__input">

                        <input type="submit" value="Iniciar Sessão" class="form__input--submit">

                    </form>

                    <?php 
                    //Veridicando se existe a variável para a exibição de uma mensagem
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "insertTrue"){
                            echo "Venda cadastrada com Sucesso";
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