<?php

include("../functions.php");

//Verificação se os dados do formlário de cadastro de produto foram enviados
if(isset($_REQUEST["codP"]) && isset($_REQUEST["nome"]) && isset($_REQUEST["uni"]) && isset($_REQUEST["prcV"])){

    $codP = $_REQUEST["codP"];
    $nome = $_REQUEST["nome"];
    $uni = $_REQUEST["uni"];
    $prcV = $_REQUEST["prcV"];
    //Verificação se os dados do formalário não estão vazios
    if($codP != "" && $nome != "" && $uni != "" && $prcV != ""){

        $result = insertProduto($codP, $nome, $uni, $prcV);

        header("location: ./?msg=insertTrue");

    }

}

//Verificação se os dados do formlário foram enviados
if(isset($_REQUEST["codPal"]) && isset($_REQUEST["nomeal"]) && isset($_REQUEST["unial"]) && isset($_REQUEST["prcVal"])){

    $ID = $_REQUEST["alP"];
    $codPal = $_REQUEST["codPal"];
    $nomeal = $_REQUEST["nomeal"];
    $unial = $_REQUEST["unial"];
    $prcVal = $_REQUEST["prcVal"];
    //Verificação se os dados do formalário não estão vazios
    if($codPal != "" && $nomeal != "" && $unial != "" && $prcVal != ""){

        //$result = updateProdutoID("CODIGO_PRODUTO", $codPal, "NOME", $nomeal, "PRECO_VENDA", $prcVal, $ID);

        $link = conectaBanco();

        $sql = "UPDATE produtos SET CODIGO_PRODUTO = '$codPal', NOME = '$nomeal', UNIDADE = '$unial', PRECO_VENDA = '$prcVal' WHERE ID = '$ID'";
        $result = mysqli_query($link, $sql);

        //header("location: ./?msg=insertTrue");
        header("location: ../");

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

        <nav class="nav">

            <ul class="nav__list">

                <li class="nav_item"><a href="./?enserrarSessão">Enserrar Sessão</a></li>

            </ul>

        </nav>

    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--forms">

                <div class="box__form box__form--login">

                    <?php
                    if(!isset($_REQUEST["alP"])){
                    ?>

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
                            <label for="uni" class="form__label">Unidade do Produto</label>
                            <input type="text" name="uni" id="uni" class="form__input">                            
                        </div>
                        
                        <div class="form__campo form__campo--4">
                            <label for="prcV" class="form__label">Preço de Venda do Produto</label>
                            <input type="ranger" name="prcV" id="prcV" class="form__input" step="any">                            
                        </div>

                        <input type="submit" value="Iniciar Sessão" class="form__input form__input--submit">

                    </form>

                    <?php
                    }else{

                        $ID = $_REQUEST["alP"];
                        
                        $link = conectaBanco();

                        $sql = "SELECT * FROM produtos WHERE ID = '$ID'";
                        $result = mysqli_query($link, $sql);

                        if(mysqli_num_rows($result) != 0){

                            foreach($result as $r){

                                $COD = $r["CODIGO_PRODUTO"];
                                $NOME = $r["NOME"];
                                $PRC_VENDA = $r["PRECO_VENDA"];

                            }

                        }

                    ?>

                    <form action="" method="post" class="form form--alterar">

                        <legend class="form__legend"></legend>

                        <div class="form__campo form__campo--1">
                            <label for="codPal" class="form__label">Código de produto</label>
                            <input type="text" value=<?php echo $COD; ?> name="codPal" id="codPal" class="form__input">
                        </div>

                        <div class="form__campo form__campo--2">
                            <label for="nomeal" class="form__label">Nome do Produto</label>
                            <input type="text" value=<?php echo $NOME; ?> name="nomeal" id="nomeal" class="form__input">                            
                        </div>

                        <div class="form__campo form__campo--3">
                            <label for="unial" class="form__label">Unidade do Produto</label>
                            <input type="text" name="unial" id="unial" class="form__input">                            
                        </div>
                        
                        <div class="form__campo form__campo--3">
                            <label for="prcVal" class="form__label">Preço de Venda do Produto</label>
                            <input type="ranger" value=<?php echo $PRC_VENDA; ?> name="prcVal" id="prcVal" class="form__input" step="any">                            
                        </div>

                        <input type="submit" value="Iniciar Sessão" class="form__input form__input--submit">

                    </form>

                    <?php
                        }
                    ?>

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