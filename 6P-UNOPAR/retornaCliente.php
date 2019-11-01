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


$numeroDigitado  = $_POST['clienteConsulta'];

if(empty($numeroDigitado)){
	$type = "all"; 
	$sql = "SELECT * FROM cliente";
     echo '<p>Não foi digitado um número válido</p>';
}

sleep(1);
$sql  = "";

	$type = "all";
    
    if (!empty($numeroDigitado))
    {
    
	$sql = "SELECT * FROM cliente WHERE clienteTelefone = '$numeroDigitado'";
    
   


$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$return = "";



$result = mysql_query($sql) or die(mysql_error());


if($type == "all"){
	$return = "";
	
	
echo '<div class="page-content">';
	
echo '<div class="row"> <!-- Essa row aqui organiza os cards distribuindo na tela! Todos os cards tem que estar aqui dentro-->';	
	
    if (mysql_num_rows($result) > 0)
    {
    
	while($data = mysql_fetch_array($result)){
		
$dataConvertidaSQL = explode('-',$data['clienteNascimento']);
$dataPronta = $dataConvertidaSQL[2].'/'.$dataConvertidaSQL[1].'/'.$dataConvertidaSQL[0];
        
      
      echo '<h5>Cliente: '.utf8_encode($data['clienteNome']).'</h5>';
      echo '<h5>Endereco: '.utf8_encode($data['clienteEndereco']).'</h5>';
      echo '<h5>Data de nascimento: '.utf8_encode($dataPronta).'</h5>';
    
		
		
            session_start();
            $_SESSION['CLIENTEID'] = $data['clienteId'];
            $_SESSION['CLIENTENOME'] = $data['clienteNome'];
            $_SESSION['CLIENTETELEFONE']= $data['clienteTelefone'];
            $_SESSION['CLIENTEENDERECO'] = $data['clienteEndereco'];
            $_SESSION['CLIENTEREFERENCIA'] = $data['clienteReferencia'];
            $_SESSION['CLIENTENASCIMENTO'] = $data['clienteNascimento'];
 
		


	}
    
    }
    if (mysql_num_rows($result) == 0)
    {
        echo utf8_encode('<p>Não encontramos nenhum cliente com este número! Clique em sair e cadastre ele!</p>');
    }
	
	echo '</div>';
	echo '</div>';	
	
}

    }



echo $return;



?>









<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/material.js"></script>

</body>

</html>