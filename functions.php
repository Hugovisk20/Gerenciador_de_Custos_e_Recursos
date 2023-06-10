<?php

//Função para se conectar com o banco de dados
function conectaBanco()
{
    
    $host = "localhost";
    $user = "porti668_Admin";
    $password = "admin@@dmin#2oo5";
    $database = "porti668_gerenciador_custo_recurso";

    $link = mysqli_connect($host , $user , $password , $database);

    return $link;

}

//Função para verificar os dados do formulário com o banco 'users'
function verificaUser($nome, $senha){

    $link = conectaBanco();

    $sql = "SELECT ID FROM users WHERE NOME = '$nome' and SENHA = '$senha'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo ta tabela 'produtos'
function selectProduto(){

    $link = conectaBanco();

    $sql = "SELECT * FROM produtos";
    $result = mysqli_query($link, $sql);

    return $link;

}



//
function setTimeout($cod, $time){
    usleep(1000000 * $time);
    $cod();
}

?>