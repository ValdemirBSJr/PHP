
<?php

header('Content-Type: text/plain');

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

              $pedidoId = $_POST['idform'];
			  $statusPedido = $_POST['idStatusPedido'];
			  $entregador = $_POST['entregadorId'];
			  

$sql = "UPDATE pedido SET pedidoEntregadorId = '$entregador', pedidoStatus = '$statusPedido' WHERE pedidoId = '$pedidoId'";

$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);

if($result = mysql_query($sql)){
	
//	echo '<div class="col s12 m4">';
//	
//	echo '<ul class="collection with-header">';
//     echo '<li class="collection-header"><h4>DADOS DO PEDIDO</h4></li>';
//        echo utf8_encode('<li class="collection-item">CLIENTE: '.$_SESSION['CLIENTENOME'].'</li>');
//        echo utf8_encode('<li class="collection-item">ENDEREÇO: '.$_SESSION['CLIENTEENDERECO'].'</li>');
//       echo utf8_encode(' <li class="collection-item">VALOR TOTAL: R$ '.$valorTotal .'</li>');
//      echo '</ul>';
//	
//	echo '</div>';
	
	echo '.';

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