<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Desenvolvimento com Ajax</title>
<link rel="stylesheet" type="text/css" href="html5.css">
</head>
<body onload="document.getElementById('result').style.display = 'none';">
<script type="text/javascript" src="../js/func.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet">
	
<div id="container">
	<header>
    	<h1>Iniciando com o desenvolvimento com ajax</h1>
    </header>
	<h2>Carregar dados:</h2>
    <div id="readData">
		<div id="label_id">Carregar id:</div>
		<input name="id" id="id" type="text" />
		<input value="Ok" onclick="getById()" type="button" />
    </div>
	<hr>
	<h2>Inserir dados:</h2>
	<form action="index.php">
		<div id="label_nome">Nome:</div>
		<input name="nome" type="text" />
		<div id="label_email">E-mail:</div>
		<input name="email" type="text" />
		<div id="label_telefone">Telefone:</div>
		<input name="telefone" type="text" />
		<input value="Ok" onclick="insertData()" type="button" />
	</form>
	<hr>
	<h2>Registros:</h2>
	<div id="result"><img src="../img/loading36.gif"></div>
</div>
</body>
</html>