<html>
<head>CADASTRANDO...</head>
<body>
<?php
//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("bdcliente") or die (mysql_error());

$strSQL = "INSERT INTO  cadcli(Nome, Endereco, Telefone, Email, Senha)VALUES('".$_POST["cadastraUsuario"]."', '".$_POST["endereco"]."', '".$_POST["tel"]."', '".$_POST["email"]."', '".$_POST["senhaUsuario"]."' )";
mysql_query($strSQL) or die (mysql_error());

if ($strSQL) {

echo "Inserido!";
}
else{
echo "Não foi possível inserir";
echo "<br>Dados sobre o erro: " .mysql_error();
}

?>
</body>

</html>