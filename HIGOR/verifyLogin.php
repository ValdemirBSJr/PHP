


<!DOCTYPE html>
<html>
<head>
	
	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
	  <script type="text/javascript" src="js/jss.js"></script>
	  
</head>
<body>
<?php

//sleep(3); //aguarda 3 segundos

$clienteEmail   = trim($_POST['clienteEmail']);
$clienteSenha    = trim($_POST['clienteSenha']);

$senhaCodificada = sha1($clienteSenha);

//$dataConvertidaSQL = explode('/',$clienteNascimento);
//$dataPronta = $dataConvertidaSQL[2].'-'.$dataConvertidaSQL[1].'-'.$dataConvertidaSQL[0];

try {
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE clientes_Email = :email AND clientes_Senha = :senha");
 
    $stmt -> bindValue(':email',$clienteEmail);
	$stmt -> bindValue(':senha',$senhaCodificada); 
    // Executa query
    $stmt->execute();
 
    // lembra do mysql_fetch_array?
    //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
    //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
    //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
    
	//$obj = $stmt -> fetch (PDO::FETCH_NUM);
	//abaixo temos dois jeitos de recuperar, pelo indice da coluna e pelo nome do campo como um objeto
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	//while ( $obj = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
 
        // Resultados podem ser recuperados atraves de seus atributos. 
		//Para ver como posso resgatar de todas as formas, ver: http://www.php.net/manual/pt_BR/pdostatement.fetch.php
        //echo "<b>Nome:</b> " . $obj->login . " - <b>Senha:</b> " . $obj->senhasc."</br>";
		//echo "<b>Nome: </b>". $obj[0]. " - <b>Senha: </b>" . $obj[2]."</br>";
		
		//if () {
		
		//echo "<b>Mensagem: </b>". $obj[1] . "</br>";
		echo "<INPUT type='hidden' id='resultName' value='".$obj[1]."'>";
		
		session_cache_expire(15); //tempo da session é 15 minutos
		session_start();
		session_name($_SERVER['REMOTE_ADDR'].$obj[1]);
		$_SESSION['IDCLI'] = $obj[0];
		$_SESSION['NAMECLI'] = $obj[1];
		$_SESSION['CLISOBRENOME'] = $obj[2];
		$_SESSION['TEL1'] = $obj[3];
		$_SESSION['TEL2'] = $obj[4];
		$_SESSION['ENDCLI'] = $obj[5];
		$_SESSION['ENDNUMCLI'] = $obj[6];
		$_SESSION['EMAILCLI'] = $obj[7];
		$_SESSION['COMPLENDCLI'] = $obj[8];
		$_SESSION['DISTANCIAENTREGACLI'] = $obj[10];
		$_SESSION['TEMPOENTREGACLI'] = $obj[11];
		$_SESSION['ENDGOOGLECLI'] = $obj[12];
		$_SESSION['DATACADCLI'] = $obj[13];
			//}
		

    }
		
	if ($stmt -> rowCount() < 1)
	{
		echo "<b>ERRO: Voc&ecirc n&atildeo tem cadastro ou alguma campo do login foi digitado incorretamente. Realize o seu cadastro ou tente novamente!</b><br>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
?>



<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/materialize.js"></script>
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
</body>
</html>