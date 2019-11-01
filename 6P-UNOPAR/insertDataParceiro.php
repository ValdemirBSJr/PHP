
<?php

//pega tumb no site: http://youtubethumbnailgenerator.blogspot.com.br/
//http://www.scriptbrasil.com.br/forum/topic/157099-contar-resultados-com-pdo/
//session_start();
 // if(empty($_SESSION['LOGIN_STATUS'])){
 //     header('location:../index.html');
 // }
  
  //echo "Bem-vindo! " .$_SESSION['LOGIN_NOME']. "<br/>";;
  //echo "Loque! Valor: " .$_SESSION['LOGIN_STATUS'] . "<br/>";
  //echo "<a href='sair.php'>sair</a>";


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

header('Content-Type: text/plain');

$parceiroNome    = $_POST['parceiroNome'];
$parceiroCnpj    = $_POST['parceiroCnpj'];
$parceiroEndereco = $_POST['parceiroEndereco'];
$parceiroTelefone = $_POST['parceiroTelefone'];
$parceiroEmail = $_POST['parceiroEmail'];




$sql = "INSERT INTO terceirizada (terceirizadaId, terceirizadaNome, terceirizadaCnpj, terceirizadaEndereco, terceirizadaTelefone, terceirizadaEmail) VALUES ('', '$parceiroNome', '$parceiroCnpj', '$parceiroEndereco', '$parceiroTelefone', '$parceiroEmail')";

$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);

if($result = mysql_query($sql)){
	
	echo '<div class="col s12 m4">';
	
	echo '<ul class="collection with-header">';
     echo '<li class="collection-header"><h4>DADOS DO CADASTRO</h4></li>';
        echo utf8_encode('<li class="collection-item">Nome: '.$parceiroNome.'</li>');
        echo utf8_encode('<li class="collection-item">Cnpj: '.$parceiroCnpj.'</li>');
        echo utf8_encode('<li class="collection-item">Endereco: '.$parceiroEndereco.'</li>');
       echo utf8_encode(' <li class="collection-item">Fone: '.$parceiroTelefone .'</li>');
	   echo utf8_encode(' <li class="collection-item">Email: '.$parceiroEmail.'</li>');
      echo '</ul>';
	
	echo '</div>';
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