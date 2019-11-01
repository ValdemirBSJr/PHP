<?php
session_start();
 if(!isset($_SESSION['NAMECLI']))
             {
              die("Para que você possa realizar estes pedidos, tem que primeiro selecionar um cliente válido");
             }
             
             else
             {
              
              

$clienteId	= $_SESSION['IDCLI'];
$clienteNome =  $_SESSION['NAMECLI'];
$clienteSobrenome = $_SESSION['CLISOBRENOME'];
$clienteTelefone1 = $_SESSION['TEL1'];
$clienteTelefone2 = $_SESSION['TEL2'];
$clienteEndereco   =   $_SESSION['ENDCLI'];
$clienteNumeroEndereco = $_SESSION['ENDNUMCLI'];
$clienteEmail = $_SESSION['EMAILCLI'];
$clienteReferencia   =   $_SESSION['COMPLENDCLI'];    
$clienteDataCadastro   =   $_SESSION['DATACADCLI'];    

		


$pedidoQtde = $_POST['Qtde'];
$idPedido = $_POST['IdPedido'];
$valorTotal = $_POST['PedidoTotal'];
$pedidoDescritivo = $_POST['Descricao'];
$valorIndividual = $valorTotal / $pedidoQtde;

//$valorPedidoDescritivo = explode("-", $pedidoTamanhoValor);
//$tamanhoIndividual = trim($valorPedidoDescritivo[0]);
//$valoreIndividual = trim($valorPedidoDescritivo[1]);
//$valorTotal = $valoreIndividual * $pedidoQtde;

$valoresaConsolidar = array($idPedido, $pedidoQtde, $valorIndividual, $valorTotal, $pedidoDescritivo);
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
