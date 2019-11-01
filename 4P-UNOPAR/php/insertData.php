
<?php

//pega tumb no site: http://youtubethumbnailgenerator.blogspot.com.br/
//http://www.scriptbrasil.com.br/forum/topic/157099-contar-resultados-com-pdo/
session_start();
  if(empty($_SESSION['LOGIN_STATUS'])){
      header('location:../index.html');
  }
  
  //echo "Bem-vindo! " .$_SESSION['LOGIN_NOME']. "<br/>";;
  //echo "Loque! Valor: " .$_SESSION['LOGIN_STATUS'] . "<br/>";
  //echo "<a href='sair.php'>sair</a>";


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
sleep(2);
header('Content-Type: text/plain');

$nomeFilme     = $_POST['form-name-filme'];
$urlFilme    = $_POST['form-name-url'];
$valorFilme = $_POST['form-name-valor'];
$thumbFilme = $_POST['form-name-thumb'];

$filmeExpirado = $_POST['expirado'];
$filmeLiberado = $_POST['liberado'];

if ($filmeExpirado == "0")
{
	$expirado = 0;
}
else
{
$expirado = 1;	
}

if ($filmeLiberado == "0")
{
	$liberado = 0;
}
else
{
$liberado = 1;	
}


$filmeSinopse = $_POST['form-sinopse-filme'];



$sql = "INSERT INTO filme (filme_ID, filme_NOME, filme_SINOPSE, filme_URL, filme_THUMBNAIL, filme_LIBERADO, filme_EXPIRADO, valor_FILME) VALUES ('', '$nomeFilme', '$filmeSinopse', '$urlFilme', '$thumbFilme', '$liberado', '$expirado', '$valorFilme')";

$user = "root";
$pass = "";
$host = "localhost";
$base = "4p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);

if($result = mysql_query($sql)){
	
	echo '<h2>Resultado do cadastro:</h2>';
	
	echo '<div class="alert alert-success" role="alert">O filme '.$nomeFilme.' foi cadastrado com sucesso! Segue abaixo:</div>';

	echo' <div class="panel panel-success">';
			echo '<div class="panel-body">';
	
		echo '<div class="media">';
		echo '	<a class="media-left media-middle"  target="_blank" href="'.$urlFilme.'">';
			echo '	 <img src="'.$thumbFilme.'" alt="'.$nomeFilme.'">';
		echo '	</a>';
		echo '	<div class="media-body">';
		echo '		<h4 class="media-heading">'.$nomeFilme.' - Pre&ccedilo: R$ '.$valorFilme.'</h4>';
				echo $filmeSinopse;
		echo '	</div>';
		echo '</div>';
		
			
			echo'</div>';
	echo '</div>';
		
		echo "<hr>";
	
}
else{
	$return = "Erro ao inserir o registro no banco de dados.";
	echo $return;
}



?>
</body>
</html>