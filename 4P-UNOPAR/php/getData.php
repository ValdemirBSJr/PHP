<!DOCTYPE HTML>
<html lang="pt/br">
	<head>
	   	<meta charset="UTF-8">
   	<link rel="shortcut icon" href="../img/favicon.ico"type="image/x-icon"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../css/jquery-ui.css" rel="stylesheet" />	
	</head>
	
<body>	

<?php


sleep(1);
$sql  = "";

	$type = "all"; 
	$sql = "SELECT * FROM filme";



$user = "root";
$pass = "";
$host = "localhost";
$base = "4p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$return = "";



$result = mysql_query($sql);


if($type == "all"){
	$return = "";
	
	echo '<h2>Resultado da busca:</h2>';
	
	while($data = mysql_fetch_array($result)){
		
		
		
		echo '<div class="alert alert-success" role="alert">';
		
		//echo' <div class="panel panel-success">';
			//echo '<div class="panel-body">';
		
		echo '<div class="media">';
		echo '	<a class="media-left media-middle"  target="_blank" href="'.$data['filme_URL'].'">';
			echo '	 <img src="'.$data['filme_THUMBNAIL'].'" alt="'.utf8_encode($data['filme_NOME']).'">';
		echo '	</a>';
		echo '	<div class="media-body">';
		echo '		<h4 class="media-heading">'.utf8_encode($data['filme_NOME']).' - Preço: R$ '.$data['valor_FILME'].'</h4>';
				echo utf8_encode($data['filme_SINOPSE']);
		echo '	</div>';
		echo '</div>';
		
		
		
		echo'</div>';
echo '</div>';
echo "<hr>";
	}
}
else{
	//abaixo codigo inutil de outro projeto. tava com pressa rsrsrsrs
	if($data = mysql_fetch_array($result)){
		$return .= "Nome: " .     $data['nome'] .     "<br>";
		$return .= "E-mail: " .   $data['email'] .    "<br>";
		$return .= "Telefone: " . $data['telefone'] . "<br>";
	}
	else{
		
		$return .= "Não foi possível listar o registro com id: " . $id;
	}
}

echo $return;



?>

</body>

</html>