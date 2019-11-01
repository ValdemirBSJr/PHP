<?php
session_start();
 if(!isset($_SESSION['CLIENTENOME']))
             {
              die("Para que você possa realizar estes pedidos, tem que primeiro selecionar um cliente válido");
             }
             
             else
             {
              
              

$clienteId	=	$_SESSION['CLIENTEID'];
$clienteNome =  $_SESSION['CLIENTENOME'];
$clienteTelefone =  $_SESSION['CLIENTETELEFONE'];
$clienteEndereco   =        $_SESSION['CLIENTEENDERECO'];
$clienteReferencia   =        $_SESSION['CLIENTEREFERENCIA'];
$clienteNascimento   =        $_SESSION['CLIENTENASCIMENTO'];


$pedidoQtde = $_POST['idqtde'];
$pedidoTamanhoValor = $_POST['idtamanho_valor'];
$formaPagamento = $_POST['idpagamento'];
$idPedido = $_POST['idformpassar'];

$valorPedidoDescritivo = explode("-", $pedidoTamanhoValor);
$tamanhoIndividual = trim($valorPedidoDescritivo[0]);
$valoreIndividual = trim($valorPedidoDescritivo[1]);
$valorTotal = $valoreIndividual * $pedidoQtde;

$valoresaConsolidar = array($idPedido, $tamanhoIndividual, $valoreIndividual, $pedidoQtde, $formaPagamento);
$valoresConsolidados = implode(';', $valoresaConsolidar);

//$arrayPedidos = array($idPedido => $valoresConsolidados);


if (!isset($_SESSION['CARRINHO']) ){

//$_SESSION['CARRINHO'] = array($idPedido => $valoresConsolidados);
$_SESSION['CARRINHO'] = array();
array_push($_SESSION['CARRINHO'], $valoresConsolidados);


}
else{
// $arrayNovo = array($idPedido => $valoresConsolidados);
//$arrayJunto =  array_merge($_SESSION['CARRINHO'], $arrayNovo);
//$_SESSION['CARRINHO'] = $arrayJunto;
array_push($_SESSION['CARRINHO'], $valoresConsolidados);
//$_SESSION['CARRINHO'] = array($idPedido => $valoresConsolidados);
}



//echo "Pedido: " .$pedidoTamanhoValor.". Quantidade: ".$pedidoQtde.". Forma de pagamento: ".$formaPagamento.". ID do pedido: ".$idPedido."<br>";
//echo $tamanhoIndividual." Agora total: ".$valorTotal."<br>";
//echo "ARRAY:".$_SESSION['CARRINHO'];

//usa esse foreach para amarrar ao indice do carrinho
//foreach ($_SESSION['CARRINHO'] as $rotulo => $informacao)
//{
// echo $rotulo."=>".$informacao."<br>";
//}


			 }
?>
