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

            }

        }

        $tot = $qtd * $PRC_VENDA;

        $result = insertVenda($codP, $qtd, $tot);

        header("location: ./?msg=insertTrue");

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gerenciador</title>

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

                            if(mysqli_num_rows($result) != 0){

                                foreach($result as $r){

                                    $COD = $r["CODIGO_PRODUTO"];

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
                    //Veridicando se existe a variável
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