<?php

if (isset($_GET['arquivo']))
{
$arquivo = $_GET['arquivo'];
echo "<p>O arquivo copiado foi: ".$arquivo."</p>";
}
else
{
echo "<p>Nenhum arquivo carregado</p>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>**SYSTEM DOC**</title>

</head>

<body>

<form action="enviando_arquivos.php" method="get"  enctype="multipart/form-data">
	<input type="file" name="arquivo"><br>
	<input type="submit" value="enviar">
	
</form>

</body>

</html>