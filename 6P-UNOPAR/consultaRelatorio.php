<!DOCTYPE HTML>
<html lang="pt/br">
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
//echo "OLA<br>";

$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];

list($diaini,$mesini,$anoini) = explode("/",$dataInicial); //aqui explodimos a string pra reorganizar no formato padrão MYSQL
	list($diafin,$mesfin,$anofin) = explode("/",$dataFinal);
	
	$datainSQL = $anoini."-".$mesini."-".$diaini;
	$datafiSQL = $anofin."-".$mesfin."-".$diafin;
	
	//echo $datainSQL."<br>";
	//echo $datafiSQL."<br>";
//	
	if (strtotime($datafiSQL) < strtotime($datainSQL)) //aqui verificamos se a data final é maior que a inicial
		{
		//$sql = "SELECT * FROM pedido WHERE pedidoData BETWEEN '$datainSQL' AND '$datafiSQL'";
			echo "<h4>&nbspData Inválida! A data final tem que ser maior que a inicial. Favor verificar!</h4>";
			
		}
		else
		{
		$sql = "SELECT * FROM pedido WHERE pedidoData BETWEEN '$datainSQL' AND '$datafiSQL' AND pedidoStatus >= '2'";
		

	  echo '<table class="responsive-table">';
        echo '<thead>';
          echo '<tr>';
              echo '<th data-field="pedido">ID do pedido</th>';
              echo '<th data-field="cliente">Resumo do Pedido</th>';
			  echo '<th data-field="total">Total</th>';
			  echo '<th data-field="entregador">Entregador</th>';
			  echo '<th data-field="status">Status</th>';
			  echo '<th data-field="terceira">Terceirizada</th>';
          echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
//        
//		 
//		  
//		  
//		  
//			//echo $rotulo."=>".$informacao."<br>";
//
$type = "all";			
//			//$sql = "SELECT * FROM pedido WHERE pedidoStatus < '2'"; //busca tudo que não tiver entregue ou cancelado
//    
$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$result = mysql_query($sql) or die(mysql_error());


if($type == "all"){//if type geral
	$return = "";
 if (mysql_num_rows($result) > 0)
    { //if mysqlnum geral
    
	while($data = mysql_fetch_array($result)){ //consulta geral
	  
		echo '<tr id="linha'.$data['pedidoId'].'">';
		
		//ID DO PEDIDO
		 echo '<td id="'.$data['pedidoId'].'">'.$data['pedidoId'].'</td>';
//		 
//		 //RETORNA DADOS DOS PEDIDOS
//		 $cliente = $data['pedidoClienteId'];
//		 $sqlCli = "SELECT * FROM cliente WHERE clienteId = '$cliente'";
//
//$typeCli = "all";		 
//$userCli = "root";
//$passCli = "";
//$hostCli = "localhost";
//$baseCli = "6p";
//mysql_connect($hostCli, $userCli, $passCli);
//mysql_select_db($baseCli);
//$resultCli = mysql_query($sqlCli) or die(mysql_error());
//		 
////		 if($typeCli == "all"){
////	$return = "";
//// if (mysql_num_rows($resultCli) > 0)
////    {
////    
////	while($dataCliente = mysql_fetch_array($resultCli)){
////		
////		 echo '<td id="'.$dataCliente['clienteId'].'"><p>Nome: '.$dataCliente['clienteNome'].'</p>';
////		 echo '<p>Endere&ccedilo: '.utf8_encode($dataCliente['clienteEndereco']).'</p>';
////		 echo '<p>Telefone: '.$dataCliente['clienteTelefone'].'</p></td>';
////		 
////	}
////    
////    }
////}
//		 
//		 //FIM DOS CLIENTES
//		 
		 //COMEÇO PEDIDO
//		 
		 $retornaArrayPedido = explode(";", $data['pedidoProdutoId']); //recebe os ids dos produtos comprados
		 
		 echo '<td>';
		 
		 foreach ($retornaArrayPedido as $rotulo => $informacao)
		{
		 
$sqlProd = "SELECT * FROM produto WHERE produtoId = '$informacao'";

$typeProd = "all";		 
$userProd = "root";
$passProd = "";
$hostProd = "localhost";
$baseProd = "6p";
mysql_connect($hostProd, $userProd, $passProd);
mysql_select_db($baseProd);
$resultProd = mysql_query($sqlProd) or die(mysql_error());
		 
		 if($typeProd == "all"){
	$return = "";
 if (mysql_num_rows($resultProd) > 0)
    {
    
	while($dataProd = mysql_fetch_array($resultProd)){
		
		 echo '<p>Pedido: '.$dataProd['produtoNome'].'</p>';
		  
		 
	}
    
    }
}
	
		}
	
		echo '<p>Tamanhos: '.$data['pedidoTamanho'].'</p>';
		  echo '<p>Qtde.: '.$data['pedidoQtde'].'</p></td>';
		  
			//FIM PEDIDO
//			
			//VALOR
           //echo'<td>R$ '.$data['pedidoValor'].'</td>';
		   
		   if (($data['pedidoEntrega'] == 0) && ($data['PedidoTroco'] == 0)) //se não tiver taxa de entrega e nem troco mostra só o valor do pedido
			{
				echo'<td>Pedido: R$ '.$data['pedidoValor'].'</td>';  
			}
			if (($data['PedidoTroco'] > 0) && ($data['pedidoEntrega'] > 0))
			{
				  $trocoTotal = $data['PedidoTroco'] - ($data['pedidoValor'] + $data['pedidoEntrega']);
				  
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].' / Entrega: R$ '.$data['pedidoEntrega'].'</p>';
				 echo '<p>Troco solicitado: R$ '.$data['PedidoTroco'].'</p>';
				 echo'<p>Troco a devolver: R$ '.$trocoTotal.'</p></td>';
			}
			if (($data['PedidoTroco'] == 0) && ($data['pedidoEntrega'] > 0))
			{
				  $total = $data['pedidoValor'] + $data['pedidoEntrega'];
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].' / Entrega: R$ '.$data['pedidoEntrega'].'</p>';
				 echo'<p>Total: R$ '.$total.'</p></td>';
			}
			if (($data['PedidoTroco'] > 0) && ($data['pedidoEntrega'] == 0))
			{
				  $trocoadevolver = $data['PedidoTroco'] - $data['pedidoValor'];
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].'</p>';  
				 echo'<p>Troco a devolver: R$ '.$trocoadevolver.'</p></td>';
			}
		   
			//FIM VALOR
//			
//			//ENTREGADOR

		

$typeEntregador = "all"; 


$userEntregador = "root";
$passEntregador = "";
$hostEntregador = "localhost";
$baseEntregador = "6p";
mysql_connect($hostEntregador, $userEntregador, $passEntregador);
mysql_select_db($baseEntregador);
$return = "";

$informacaoEntregador = $data['pedidoEntregadorId'];

$sqlEntregador = "SELECT * FROM entregador WHERE entregadorId = '$informacaoEntregador'";

$resultEntregador = mysql_query($sqlEntregador);

if($typeEntregador == "all"){
	$return = "";
	
	  
	while($dataentregador = mysql_fetch_array($resultEntregador))
	{
			
      echo '<td><p>ID: '.$data['pedidoEntregadorId'].'</p>';
		  echo '<p>Nome: '.$dataentregador['entregadorNome'].'</p></td>';
		  $entregadorEmpresa = $dataentregador['entregadorEmpresa'];
  
	}
	
	
	
	
	
}
		

			//FIM ENTREGADOR
//			
			//STATUS
		echo '<td>';
			
			 if ($data['pedidoStatus'] == 0)
	  {

	  echo 'Pendente';
	  }
	  if ($data['pedidoStatus'] == 1)
	  {

	  echo 'Em transito';
	  }
	   if ($data['pedidoStatus'] == 2)
	  {

	  echo 'Cancelado';
	  }
	   if ($data['pedidoStatus'] == 3)
	  {

	  echo 'Entregue';
	  }
	  
	  echo '</td>';
//			
//			//FIM DO STATUS
//			
//			//TERCEIRIZADA

		

$typeTerceira = "all"; 


$userTerceira = "root";
$passTerceira = "";
$hostTerceira = "localhost";
$baseTerceira = "6p";
mysql_connect($hostTerceira, $userTerceira, $passTerceira);
mysql_select_db($baseTerceira);
$return = "";

$informacaoTerceira = $entregadorEmpresa;

$sqlTerceira = "SELECT * FROM terceirizada WHERE terceirizadaId = '$informacaoTerceira'";

$resultTerceira = mysql_query($sqlTerceira);

if($typeTerceira == "all"){
	$return = "";
	
	  
	while($dataTerceira = mysql_fetch_array($resultTerceira))
	{
			
      echo '<td><p>ID: '.utf8_encode($dataTerceira['terceirizadaId']).'</p>';
		  echo '<p>Nome: '.utf8_encode($dataTerceira['terceirizadaNome']).'</p></td>';
  
	}
	
	
	
	
	
}
		

			//FIM TERCEIRIZADA



	  echo'</tr>';
//
//
//		
//		 
	} //fim da consulta geral
    
    } //if mysqlnum geral
}//if type geral
	  
		
		
		
        echo '</tbody>';
      echo '</table>';
	  echo '<div class="divider"></div>';
//	  
//
		}

?>









<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/material.js"></script>

</body>

</html>