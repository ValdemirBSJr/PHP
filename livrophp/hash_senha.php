
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>**SYSTEM DOC**</title>

</head>

<body>
<?php
//encriptação de mão unica com o sha1
$Texto ="val.2015";
$codificacaosha1 = sha1($Texto);
echo "O resultado para val.2014 com sha1 é: ".$codificacaosha1;

//encriptacao de mão dupla com o base64
$Texto64 = "n5669203";
$codificacao64 = base64_encode($Texto64);
echo "<br/>O resultado da codificação de n5669203 em BASE64 foi: ".$codificacao64;

$decodificacao64 = base64_decode($codificacao64);

echo "<br/>O resultado da decodificacao: ".$decodificacao64;

/*
$usuario = 'thiago'; // Nome do usuario (digitado pelo usuario)
04	$senha = '12345'; // Senha (digitada pelo usuario)
05	 
06	// Encripta a senha utilizando Whirlpool
07	$whirlpool = hash('whirlpool', $senha);
08	 
09	$sql = "SELECT * FROM `usuarios` WHERE `usuario` = '{$usuario}' AND BINARY `senha` = '{$whirlpool}'";
*/


?>

</body>

</html>