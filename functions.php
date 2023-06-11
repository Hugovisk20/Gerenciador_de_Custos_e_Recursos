<?php

//Função para se conectar com o banco de dados
function conectaBanco()
{
    
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "gerenciador_custo_recurso";

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

//Função para inserir dados ao banco 'produtos'
function insertProduto($COD, $NOME, $PRC_VENDA){

    $link = conectaBanco();

    $sql = "INSERT INTO produtos (CODIGO_PRODUTO, NOME, PRECO_VENDA) VALUES ('$COD', '$NOME', '$PRC_VENDA')";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para inserir dados ao banco 'compras'
function insertCompra($PRODUTO, $FORNECEDOR, $QTD, $TOTAL_COMPRA){

    $link = conectaBanco();

    $sql = "INSERT INTO compras (FK_COD_PRODUTO, FK_ID_FORNECEDOR, QUANTIDADE, TOTAL_COMPRA) VALUES ('$PRODUTO', '$FORNECEDOR', '$QTD', '$TOTAL_COMPRA')";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para inserir dados ao banco 'vendas'
function insertVenda($PRODUTO, $QTD, $TOTAL_VENDA){

    $link = conectaBanco();

    $sql = "INSERT INTO vendas (FK_COD_PRODUTO, QUANTIDADE, TOTAL_VENDA) VALUES ('$PRODUTO', '$QTD', '$TOTAL_VENDA')";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para inserir dados ao banco 'fornrcedores'
function insertFornecedor($NOME, $CNPJ){

    $link = conectaBanco();

    $sql = "INSERT INTO fornecedores (NOME, CNPJ) VALUES ('$NOME', '$CNPJ')";
    $result = mysqli_query($link, $sql);

    return $result;

}



//Função para selecionar tudo da tabela 'produtos'
function selectProduto(){

    $link = conectaBanco();

    $sql = "SELECT * FROM produtos";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo da tabela 'produtos' onde o codigo se iguala ao parametro
function selectProdutoWhere($COD){

    $link = conectaBanco();

    $sql = "SELECT * FROM produtos WHERE CODIGO_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo da tabela 'compras'
function selectCompra(){

    $link = conectaBanco();

    $sql = "SELECT * FROM compras";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo da tabela 'compras' onde o código se iguala ao parametro
function selectCompraWhere($COD){

    $link = conectaBanco();

    $sql = "SELECT * FROM compras WHERE FK_COD_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para seecionar sudo da tabela 'vendas'
function selectVenda(){

    $link = conectaBanco();

    $sql = "SELECT * FROM vendas";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo da tabela 'produtos' onde o codigo se iguala ao parametro
function selectVendaWhere($COD){

    $link = conectaBanco();

    $sql = "SELECT * FROM vendas WHERE FK_COD_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para selecionar tudo da tabela 'fornecedores'
function selectFornecedor(){

    $link = conectaBanco();

    $sql = "SELECT * FROM fornecedores";
    $result = mysqli_query($link, $sql);

    return $result;

}



//
function updateProduto($COL, $COD, $DADO){

    $link = conectaBanco();

    $sql = "UPDATE produtos SET $COL = $DADO WHERE CODIGO_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}



//Função para deletar dado da tabela 'produtos'
function deletaProduto($COD){

    $link = conectaBanco();

    $sql = "DELETE FROM produtos WHERE CODIGO_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaCompra($COD){

    $link = conectaBanco();

    $sql = "DELETE FROM compras WHERE FK_COD_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaVenda($ID){

    $link = conectaBanco();

    $sql = "DELETE FROM vendas WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaFornecedor($NOME){

    $link = conectaBanco();

    $sql = "DELETE FROM fornecedores WHERE NOME = '$NOME'";
    $result = mysqli_query($link, $sql);

    return $result;

}

?>