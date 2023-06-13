<?php

include("../functions.php");

//Verificação se os dados do formlário foram enviados
if(isset($_REQUEST["nome"]) && isset($_REQUEST["cnpj"])){

    $nome = $_REQUEST["nome"];
    $cnpj = $_REQUEST["cnpj"];

    //Verificação se os dados do formalário não estão vazios
    if($nome != "" && $cnpj != ""){

        insertFornecedor($nome, $cnpj);

        header("location: ./?msg=insertTrue");

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores - Gerenciador</title>

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
                            <label for="nome" class="form__label">Nome do Fornecedor</label>
                            <input type="text" name="nome" id="nome" class="form__input">                            
                        </div>

                        <div class="form__campo form__campo--2">
                            <label for="cnpj" class="form__label">CNPJ do Fornecedor</label>
                            <input type="text" name="cnpj" id="cnpj" class="form__input">                            
                        </div>

                        <input type="submit" value="Iniciar Sessão" class="form__input form__input--submit">

                    </form>

                    <?php
                    //Verificando se a variável existe para a exbição e uma mensagem
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "insertTrue"){
                            echo "Fornecedor cadastrado com Sucesso";
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