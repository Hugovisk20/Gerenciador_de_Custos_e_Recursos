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
                            <input type="text" name="codP" id="codP" class="form__input">
                        </div>

                        <div class="form__campo form__campo--2">
                            <label for="nome" class="form__label">Nome do Produto</label>
                            <input type="text" name="nome" id="nome" class="form__input">                            
                        </div>
                        
                        <div class="form__campo form__campo--3">
                            <label for="prcV" class="form__label">Preço de Venda do Produto</label>
                            <input type="ranger" name="prcV" id="prcV" class="form__input" step="any">                            
                        </div>

                        <input type="submit" value="Iniciar Sessão" class="form__input form__input--submit">

                    </form>

                    <?php
                    //Verificando se a variável existe para a exibição de uma mensagem
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "insertTrue"){
                            echo "Produto cadastrado com Sucesso";
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