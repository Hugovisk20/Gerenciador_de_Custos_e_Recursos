<?php

include("../functions.php");

if(isset($_REQUEST["name"]) && isset($_REQUEST["psw"])){

    $name = $_REQUEST["name"];
    $psw = $_REQUEST["psw"];

    if($name != "" && $psw != ""){

        $result = verificaUser($name, $psw);

        if(mysqli_num_rows($result) != 0){

            session_start();
            $_SESSION["USER"] = $name;

            header("location: ../");
            
        }else{

            $errorLogin = "Login mal Sucedido";

            header("location: ./?msg=errorlogin");

        }

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

                        <label for="name" class="form__label">Nome do Usuário</label>
                        <input type="text" name="name" id="name" class="form__input">
                        
                        <label for="psw" class="form__label">Senha</label>
                        <input type="text" name="psw" id="psw" class="form__input">

                        <input type="submit" value="Iniciar Sessão" class="form__input--submit">

                    </form>

                    <?php 
                    if(isset($_REQUEST["msg"])){

                        $msg = $_REQUEST["msg"];

                        if($msg == "errorlogin"){
                            echo "Login mal Sucedido";
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