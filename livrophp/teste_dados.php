<html>
<head>CADASTRANDO...</head>
<body>
<?php
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("bdcliente") or die (mysql_error());

$strSQL = "INSERT INTO  cadcli(Nome, endereco)VALUES('DANIEL', 'Mangabeira')";
mysql_query($strSQL) or die (mysql_error());

if ($strSQL) {

echo "Inserido!";
}
else{
echo "N�o foi poss�vel inserir";
echo "<br>Dados sobre o erro: " .mysql_error();
}

?>
</body>

</html>