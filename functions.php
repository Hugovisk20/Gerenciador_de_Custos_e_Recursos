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

//-----Funções para inserir dados ao banco-----//

//Função para inserir dados ao banco 'produtos'
function insertProduto($COD, $NOME, $UNIDADE, $PRC_VENDA){

    $link = conectaBanco();

    $sql = "INSERT INTO produtos (CODIGO_PRODUTO, NOME, UNIDADE, PRECO_VENDA) VALUES ('$COD', '$NOME', '$UNIDADE', '$PRC_VENDA')";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para inserir dados ao banco 'compras'
function insertCompra($PRODUTO, $FORNECEDOR, $PRC_COMPRA, $QTD, $TOTAL_COMPRA){

    $link = conectaBanco();

    $sql = "INSERT INTO compras (FK_COD_PRODUTO, FK_NOME_FORNECEDOR, PRECO_COMPRA, QUANTIDADE, TOTAL_COMPRA) VALUES ('$PRODUTO', '$FORNECEDOR', '$PRC_COMPRA', '$QTD', '$TOTAL_COMPRA')";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para inserir dados ao banco 'vendas'
function insertVenda($PRC_VENDA, $PRODUTO, $QTD, $TOTAL_VENDA){

    $link = conectaBanco();

    $sql = "INSERT INTO vendas (FK_PRCV_PRODUTO, FK_COD_PRODUTO, QUANTIDADE, TOTAL_VENDA) VALUES ('$PRC_VENDA', '$PRODUTO', '$QTD', '$TOTAL_VENDA')";
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

//-----Funções para selecionar dados do banco-----//

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

//-----Funções para fazer update de dados no banco-----//

//Função para atualizar os dados da tabela produtos
function updateProduto($COL, $DADO, $COD){

    $link = conectaBanco();

    $sql = "UPDATE produtos SET $COL = $DADO WHERE CODIGO_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para atualizar os dados da tabela produtos
function updateProdutoID($COL1, $COL2, $COL3, $D1, $D2, $D3, $ID){

    $link = conectaBanco();

    $sql = "UPDATE produtos SET $COL1 = '$D1', $COL2 = '$D2', $COL3 = '$D3' WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para atualizar os dados da tabela produtos
function updateCompra($COL, $DADO, $ID){

    $link = conectaBanco();

    $sql = "UPDATE compras SET $COL = $DADO WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para atualizar os dados da tabela produtos
function updateVenda($COL, $DADO, $ID){

    $link = conectaBanco();

    $sql = "UPDATE vendas SET $COL = $DADO WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para atualizar os dados da tabela produtos
function updateFornecedor($COL, $DADO, $ID){

    $link = conectaBanco();

    $sql = "UPDATE fornecedores SET $COL = '$DADO' WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Atualiza os dados na coluna 'PRECO_TOTAL' da tabela produtos
function atuaizaPrecoTotalProduto($QTD, $PRC_VENDA, $COD){

    $PRC_TOTAl = $QTD * $PRC_VENDA;

    updateProduto("PRECO_TOTAL", $PRC_TOTAl, $COD);

}

//Função para atualizar dados da tabela produtos de acordo com os dados da tabela compras
function compraProduto(){

    $resultP = selectProduto();

    if(mysqli_num_rows($resultP) != 0){
    
        foreach($resultP as $rp){
    
            $COD = $rp["CODIGO_PRODUTO"];
            $QUANTIDADE_P = $rp["QUANTIDADE"];
    
            $resultC = selectCompraWhere($COD);
    
            if(mysqli_num_rows($resultC) != 0){
                $NEWQUANTIDADE_C = 0;
                foreach($resultC as $rc){
    
                    $QUANTIDADE_C = $rc["QUANTIDADE"];
    
                    $NEWQUANTIDADE_C = $QUANTIDADE_P + $QUANTIDADE_C;
    
                    updateProduto("QUANTIDADE", $NEWQUANTIDADE_C, $COD);
    
                }
    
            }
    
        }
    
    }

}

//Função para atualizar dados da tabela produtos de acordo com os dados da tabela vendas
function vendeProduto(){

    $resultP = selectProduto();

    if(mysqli_num_rows($resultP) != 0){
    
        foreach($resultP as $rp){
    
            $COD = $rp["CODIGO_PRODUTO"];
            $QUANTIDADE_P = $rp["QUANTIDADE"];
    
            $resultV = selectVendaWhere($COD);
    
            if(mysqli_num_rows($resultV) != 0){
                $NEWQUANTIDADE_V = 0;
                foreach($resultV as $rV){
    
                    $QUANTIDADE_V = $rV["QUANTIDADE"];
    
                    $NEWQUANTIDADE_V = $QUANTIDADE_P - $QUANTIDADE_V;
    
                    updateProduto("QUANTIDADE", $NEWQUANTIDADE_V, $COD);
    
                }
    
            }
    
        }
    
    }

}

//Função para adicionar os dados na tabela produtos se uma venda for excluida
function adicionaProdutoQtd($ID){

    $link = conectaBanco();

    $sql = "SELECT * FROM vendas WHERE ID = '$ID'";
    $resultV = mysqli_query($link, $sql);

    if(mysqli_num_rows($resultV) != 0){
    
        foreach($resultV as $rV){
    
            $COD = $rV["FK_COD_PRODUTO"];
            $QUANTIDADE_V = $rV["QUANTIDADE"];
    
        }


    
    }    

    $sql = "SELECT * FROM produtos WHERE CODIGO_PRODUTO = '$COD'";
    $resultP = mysqli_query($link, $sql);

    if(mysqli_num_rows($resultP) != 0){
    
        foreach($resultP as $rP){
    
            $QUANTIDADE_P = $rP["QUANTIDADE"];
    
        }

        $NEWQUANTIDADE_P = $QUANTIDADE_P + $QUANTIDADE_V;
        echo $NEWQUANTIDADE_P;
        updateProduto("QUANTIDADE", $NEWQUANTIDADE_P, $COD);        
    
    }    

}

//Função para remover os dados na tabela produtos se uma compra for excluida
function removeProdutoQtd($ID){

    $link = conectaBanco();

    $sql = "SELECT * FROM compras WHERE ID = '$ID'";
    $resultC = mysqli_query($link, $sql);

    if(mysqli_num_rows($resultC) != 0){
    
        foreach($resultC as $rC){
    
            $COD = $rC["FK_COD_PRODUTO"];
            $QUANTIDADE_V = $rC["QUANTIDADE"];
    
        }


    
    }    

    $sql = "SELECT * FROM produtos WHERE CODIGO_PRODUTO = '$COD'";
    $resultP = mysqli_query($link, $sql);

    if(mysqli_num_rows($resultP) != 0){
    
        foreach($resultP as $rP){
    
            $QUANTIDADE_P = $rP["QUANTIDADE"];
    
        }

        $NEWQUANTIDADE_P = $QUANTIDADE_P - $QUANTIDADE_V;
        if($NEWQUANTIDADE_P < 0){
            $NEWQUANTIDADE_P = 0;
            deletaVenda("FK_COD_PRODUTO", $COD);
        }
        echo $NEWQUANTIDADE_P;
        updateProduto("QUANTIDADE", $NEWQUANTIDADE_P, $COD);        
    
    }    

}

//-----Funções para deletar dados do banco-----//

//Função para deletar dado da tabela 'produtos'
function deletaProduto($COD){

    $link = conectaBanco();

    $sql = "DELETE FROM produtos WHERE CODIGO_PRODUTO = '$COD'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaCompra($COL, $DADO){

    $link = conectaBanco();

    $sql = "DELETE FROM compras WHERE $COL = '$DADO'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaVenda($COL, $DADO){

    $link = conectaBanco();

    $sql = "DELETE FROM vendas WHERE $COL = '$DADO'";
    $result = mysqli_query($link, $sql);

    return $result;

}

//Função para deletar dado da tabela 'compras'
function deletaFornecedor($ID){

    $link = conectaBanco();

    $sql = "DELETE FROM fornecedores WHERE ID = '$ID'";
    $result = mysqli_query($link, $sql);

    return $result;

}

?>