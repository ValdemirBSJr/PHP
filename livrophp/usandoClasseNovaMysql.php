<?php
//neste simples script eu testo o acesso ao banco de dados mysql pela forma nova. O mysql_query vai ser descontinuado

$conectar = mysqli_connect('localhost', 'root', '', 'dtc_abordo' ); //nesta linha tiro a necessidade de usar o mysql_select_db pois o ultimo parametro é o nome do banco


//checa a conexao abaixo

if (mysqli_connect_errno())
{
	echo "<p>Falha na conexão: ". mysqli_connect_error();
	exit();
}

$query = "SELECT * FROM usuario WHERE usuario_id = n0";

$resultado = mysqli_query($conectar, $query);

/* 

ABAIXO FORMAS DE ACESSO RECOMENDADOS
numeric array 
$row = mysqli_fetch_array($result, MYSQLI_NUM);
printf ("%s (%s)\n", $row[0], $row[1]);

 associative array 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);

 associative and numeric array 
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

*/

while ($query = mysqli_fetch_array($resultado, MYSQLI_NUM)) //aqui uso o tipo de busca por array numerico. se ligar no exemplo acima que é facil de usar
{
echo "<p>O login resgatado no BD: ".$query[1]."</p>";
echo "<p>A senha resgatada no BD: ". $query[2]."</p>";
}

//abaixo libero a memoria

mysqli_free_result($resultado);

//abaixo fecho o acesso

mysqli_close($conectar);








?>