<?php
include("./functions.php");

session_start();

if(!isset($_SESSION["USER"])){

    header("location: ./LOGIN");

}

if(isset($_REQUEST["enserrarSessão"])){
    session_destroy();

    header("location: ./");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Gerenciador</title>

</head>
<body>

    <header class="header">

        <nav class="nav">

            <ul class="nav_list">

                <li class="nav_item"><a href="./?enserrarSessão">Enserrar Sessão</a></li>

            </ul>

        </nav>

    </header>

    <main class="main">

        <article class="main--container">

            <section class="box box--tabelas">

                <div class="box__contains box__contains--produtos">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Código</th>
                            <th class="box__th">Nome</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Preço da Venda</th>
                            <th class="box__th">Preço Total de Venda</th>

                        </thead>

                        <tbody>



                        </tbody>

                    </table>

                </div>

                <div class="box__contains box__contains--compras">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Produto</th>
                            <th class="box__th">Fornecedor</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Total da Venda</th>

                        </thead>

                        <tbody>

                            

                        </tbody>

                    </table>

                </div>

                <div class="box__contains box__contains--vendas">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Produto</th>
                            <th class="box__th">Quantidade</th>
                            <th class="box__th">Total da Venda</th>

                        </thead>

                        <tbody>

                            

                        </tbody>

                    </table>

                </div>

                <div class="box__contains box__contains--fornecedores">

                    <table class="box__table">

                        <thead class="box__thead">

                            <th class="box__th">Nome</th>
                            <th class="box__th">CNPJ</th>

                        </thead>

                        <tbody>

                            

                        </tbody>

                    </table>

                </div>

            </section>

        </article>

    </main>

    <footer class="footer">



    </footer>
   
</body>
</html>