<?php

include("../functions.php");

//Verificação se os dados do formlário foram enviados
if(isset($_REQUEST["codP"]) && isset($_REQUEST["nome"]) && isset($_REQUEST["prcV"])){

    $codP = $_REQUEST["codP"];
    $nome = $_REQUEST["nome"];
    $prcV = $_REQUEST["prcV"];
    //Verificação se os dados do formalário não estão vazios
    if($codP != "" && $nome != "" && $prcV != ""){

        $result = insertProduto($codP, $nome, $prcV);

        var_dump($result);

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
                        <input type="text" name="codP" id="codP" class="form__input">
                        
                        <label for="nome" class="form__label">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" class="form__input">

                        <label for="prcV" class="form__label">Preço de Venda do Produto</label>
                        <input type="ranger" name="prcV" id="prcV" class="form__input" step="any">

                        <input type="submit" value="Iniciar Sessão" class="form__input--submit">

                    </form>

                    <?php
                    //Veridicando se existe a variável
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "insertTrue"){
                            echo "Produto cadastrado com Sucesso";
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