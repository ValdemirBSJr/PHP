<?php
if ($_COOKIE['Est_logado'] !== "sim") //aqui verifico se a session de acesso est� ativa e se o perfil � o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

 die( "Sua se��o expirou.");
setcookie("Est_logado"); //condi��o para estar logado
//setcookie("registro"); // armazena o momento em que autenticado 
//setcookie("limite"); // armazena o tempo limite sem atividade 
setcookie("Id_logado"); //aqui � o perfil
setcookie("Id_usuario"); //aqui � o login unico


}
if (isset($_COOKIE['Est_logado'])) //Verifica se a session est� ativa
{
setcookie("Est_logado", $_COOKIE['Est_logado'], time() + 60 * 15);
setcookie("Id_logado", $_COOKIE['Id_logado'], time() + 60 * 15); //aqui � o perfil
setcookie("Id_usuario", $_COOKIE['Id_usuario'], time() + 60 * 15); //aqui � o login unico
}
}

else
{ 
setcookie("Est_logado"); //condi��o para estar logado
setcookie("Id_logado"); //aqui � o perfil
setcookie("Id_usuario");

 die( "Sua se��o expirou.");

echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

}




mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

	$StringSQL = "SELECT * FROM tbllog WHERE log_identificador = 3";
	
	$conectarSQL = mysql_query($StringSQL) or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");
	
	echo "<h1 align='center'>Originador do Posto</h1>";
	
	echo "<table width='75%' align='center' style='border-collapse: collapse;  border-top: 4px solid #000000; border-bottom: 4px solid #000000'>";
	echo "<tr>";
	
	echo "<td><strong>ID do originador</strong></td>";
	echo "<td><strong>Nome do Originador</strong></td>";
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