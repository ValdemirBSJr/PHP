
<?php

header('Content-Type: text/plain');
session_start();
 if(!isset($_SESSION['CLIENTENOME']) || !isset($_SESSION['CARRINHO']))
             {
				echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/6P-UNOPAR/cliente.php">';
              die("Sem cliente escolhido ou sem pedido escolhido. Selecione um antes!");
             }


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="css/material.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
	  <!--Função do AJAX-->
      <script type="text/javascript" src="js/func-AJAX.js"></script>
</head>
<body>
<?php

              $clienteId = $_POST['clienteId'];
			  $valorTotal = $_POST['totalGeral'];
			  $trocoEnviado = $_POST['troco'];
			  $taxaEntrega = $_POST['entrega'];
			  $dataPedido = date("Y-m-d");
			  
			  if (empty($trocoEnviado))
			  {
			   $trocoEnviado = 0;
			  }
			  
			  if (empty($taxaEntrega))
			  {
			   $taxaEntrega = 0;
			  }
			  
			  //declaro os arrays de trabalho
			  $arrayIdProduto = array();
              $arrayQtdeProduto = array();
			  $arrayTamanhoProduto = array();
			  
				foreach ($_SESSION['CARRINHO'] as $rotulo => $informacao)
		{
					
					$retornaArray = explode(";", $_SESSION['CARRINHO'][$rotulo]); //recebe a array com os valores do carrinho
					
					array_push($arrayIdProduto, $retornaArray[0]);
					array_push($arrayQtdeProduto, $retornaArray[3]);
					array_push($arrayTamanhoProduto, $retornaArray[1]);

		}
		
		$idProdutoConsolidado = implode(';', $arrayIdProduto);
		$produtoQtdeConsolidado = implode(';', $arrayQtdeProduto);
		$produtoTamanhoConsolidado = implode(';', $arrayTamanhoProduto);
		
		//echo 'Array id pedido: '.$idProdutoConsolidado.'<br>';
		//echo 'Array qtde: '.$produtoQtdeConsolidado.'<br>';
		//echo 'Array Tamanho: '.$produtoTamanhoConsolidado.'<br>';
		//echo 'Cliente id: '.$clienteId.'<br>';
		//echo 'Valor total: '.$valorTotal.'<br>';
//		foreach ($arrayTamanhoProduto as $rotulo => $informacao)
//{
// echo $rotulo."=>".$informacao."<br>";
//}
$EntregadorId = 0;
$status = 0;


$sql = "INSERT INTO pedido (pedidoId, pedidoClienteId, pedidoProdutoId, pedidoQtde, pedidoTamanho, pedidoValor, pedidoEntregadorId, pedidoStatus, pedidoEntrega, pedidoTroco, pedidoData) VALUES ('', '$clienteId', '$idProdutoConsolidado', '$produtoQtdeConsolidado', '$produtoTamanhoConsolidado', '$valorTotal', '$EntregadorId', '$status', '$taxaEntrega', '$trocoEnviado', '$dataPedido')";

$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);

if($result = mysql_query($sql)){
	
	echo '<div class="col s12 m4">';
	
	echo '<ul class="collection with-header">';
     echo '<li class="collection-header"><h4>DADOS DO PEDIDO</h4></li>';
        echo utf8_encode('<li class="collection-item">CLIENTE: '.$_SESSION['CLIENTENOME'].'</li>');
        echo utf8_encode('<li class="collection-item">ENDEREÇO: '.$_SESSION['CLIENTEENDERECO'].'</li>');
       echo utf8_encode(' <li class="collection-item">VALOR TOTAL: R$ '.$valorTotal .'</li>');
      echo '</ul>';
	
	echo '</div>';
	
	//sleep(4); //deixo 3 segundos para mostrar o pedido
	
	session_destroy();

}
else{
	$return = "Erro ao inserir o registro no banco de dados.";
	echo $return;
}


			 
?>



<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/material.js"></script>
</body>
</html>