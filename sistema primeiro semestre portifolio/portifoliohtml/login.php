<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>LOGIN</title>
<link href="conf2.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("bdcliente") or die (mysql_error());

//Aqui puxamos os valores digitados nos campos da p�gina inicial para as variaveis
$Login = $_POST['user'];
$Senha = $_POST['password'];

//Aqui fazemos a consulta SQL no BD

$logar = mysql_query("SELECT * FROM cadcli WHERE Nome = '$Login' AND Senha = '$Senha'") or die("Erro na consulta ao banco de dados. Erro ao selecionar");

//Aqui � feita uma verifica��o na lista gerada pela consulta. Se n�o for encontrado resultado, direciona para a p�gina de bloqueio, se funciona, leva para a�p�gina dos livros

if (strlen($Senha)<1){

	echo "N�o foi poss�vel logar, verifique se a senha e o nome do usu�rio conferem.";
	//REDIRECIONA PARA OUTRA P�GINA:    header ("location: logue.html");
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	echo "<a href='cadastro.html'><p>Cadastre-se</p></a>";
}
elseif (mysql_num_rows($logar)>0){
//REDIRECIONA PARA OUTRA P�GINA:  header("location:livros.html");
echo "Voc� est� logado!";
echo "<a href='livros.html'><p>Clique aqui para ir para a locadora</p></a>";

}
else {

echo "N�o foi poss�vel logar, verifique se a senha e o nome do usu�rio conferem.";
	//REDIRECIONA PARA OUTRA P�GINA:    header ("location: logue.html");
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	echo "<a href='cadastro.html'><p>Cadastre-se</p></a>";
}

		
		
		
?>		

</body>

</html>