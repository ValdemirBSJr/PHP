<?php
session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if ($_SESSION['Est_logado'] !== "sim")
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/index.html">';
}
if ($registro) //Verifica se a session está ativa
{
$segundos = time() - $registro; //se tiver ativa atualiza em quanto tempo está
}

/* verifica abaixo o tempo de inatividade 
se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
se não ele renova o tempo e ai é contado mais 900 segundos*/

if($segundos>$limite)
{
 session_destroy();
 die( "Sua seção expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://localhost/NET/index.html">';

}
else{
 $_SESSION['registro'] = time();
}


mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

	$StringSQL = "SELECT * FROM tbllog WHERE log_identificador = 2";
	
	$conectarSQL = mysql_query($StringSQL) or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");
	
	echo "<h1 align='center'>Tratador do Posto</h1>";
	
	echo "<table width='75%' align='center' style='border-collapse: collapse;  border-top: 4px solid #000000; border-bottom: 4px solid #000000'>";
	echo "<tr>";
	
	echo "<td><strong>ID do Tratador</strong></td>";
	echo "<td><strong>Nome do Posto Tratador</strong></td>";
	echo "<td><strong>Email</strong></td>";
	echo "</tr>";
		
	$contador_para_colorir_tabela = 0;
	
	while ($StringSQL = mysql_fetch_array($conectarSQL))
	
	{
		if ($contador_para_colorir_tabela/2 == 0 )
			{
				echo "<tr bgcolor='#ADD8E6' style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}
		else
			{
				echo "<tr style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}
			
		echo "<td>".$ID = $StringSQL['id_log']."</td>";
		echo "<td>". $Nome = $StringSQL['log_nome']."</td>";
		echo "<td>".$Email = $StringSQL['log_email']. "</td>";
		
		$contador_para_colorir_tabela = $contador_para_colorir_tabela + 1;
		
	}
	echo "</tr></table>";

	mysql_free_result($conectarSQL);

?>