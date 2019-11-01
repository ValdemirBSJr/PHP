<?php
if ($_COOKIE['Est_logado'] !== "sim" || ($_COOKIE['Id_logado'] <> 2)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

 die( "Sua seção expirou.");
setcookie("Est_logado"); //condição para estar logado
//setcookie("registro"); // armazena o momento em que autenticado 
//setcookie("limite"); // armazena o tempo limite sem atividade 
setcookie("Id_logado"); //aqui é o perfil
setcookie("Id_usuario"); //aqui é o login unico


}
if (isset($_COOKIE['Est_logado'])) //Verifica se a session está ativa
{
setcookie("Est_logado", $_COOKIE['Est_logado'], time() + 60 * 15);
setcookie("Id_logado", $_COOKIE['Id_logado'], time() + 60 * 15); //aqui é o perfil
setcookie("Id_usuario", $_COOKIE['Id_usuario'], time() + 60 * 15); //aqui é o login unico
}
}

else
{ 
setcookie("Est_logado"); //condição para estar logado
setcookie("Id_logado"); //aqui é o perfil
setcookie("Id_usuario");

 die( "Sua seção expirou.");

echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>**POSTO**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>
<script language=javascript> 

function atualizar() 

//{alert('Você clicou no botão de alerta');} 

{window.location=window.location};//atualiza a página

</script> 

</head>

<body>


<ul class="menuhorizontal">
<li><a href="#">HOME</a></li>
<li><a href="#">ARQUIVAR DOCUMENTO DIVERSO</a></li>
<li><a href="busca_posto.php">PESQUISAR</a></li>
<li><a href="sair.php">SAIR</a></li>

</ul>

<br><br>
<h1>Sysdoc do posto</h1>

<?php
//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());	



//abaixo o script conta quantos registros não foram tratados pelo posto
$contador_pendencias = mysql_query("SELECT COUNT(*) FROM tbluploadposto WHERE posto_tratado = 0 AND posto_demanda_tratad = ".$_COOKIE['Id_usuario']) or die("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");

//Agora temos abaixo os registros que estão pendentes
$query_sql_select = "SELECT * FROM tbluploadposto WHERE posto_tratado = 0 AND posto_demanda_tratad = ".$_COOKIE['Id_usuario'];
$registros_pendentes = mysql_query("$query_sql_select") or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");


$result_contador = mysql_result($contador_pendencias,0); //aqui dou o resultado onde coloco de onde vem os dados e o número da linha retornada. como é um contador, iremos querer só a primeira linha

if ($result_contador == 0)
{
echo "Não há postos pendentes de serem tratados no momento!";
}
else
{
//texto com o número de pendencias e o botão de atualizar acima temos o código javascript
echo "<p>Pendencias em aberto: <strong><font color='red' size='12'>" .$result_contador."</font></strong>. Visualize abaixo os postos.</p><p><input type='submit' name='Atualizar' value='Atualizar' tabindex='3' onClick='atualizar()' id='atualizar'></p><br><br>";

	//Abaixo temos os dados das pendencias é feito um loop para exibir as que estão em aberto.
	
	$linhas_pendencias = 0;
	

	echo "<table height='180' width='75%' style='border-collapse: collapse;  border-top: 4px solid #000000; border-bottom: 4px solid #000000'>";
	echo "<tr>";
	
	echo "<td><strong>Tratar posto?</strong></td>";
	echo "<td><strong>ID do Processo</strong></td>";
	echo "<td><strong>Originador</strong></td>";
	echo "<td><strong>Data da origem</strong></td>";
	echo "<td><strong>Arquivo</strong></td>";
	echo "<td><strong>Descritivo</strong></td>";
	
	echo "</tr>";
	
	/* while ($linhas_pendencias < $result_contador)
	{
		echo "<tr>";
	
		 echo "<td><form action='trata_posto.php' method='post' name='form".$linhas_pendencias."'><input type='submit' value = 'Marcar como tratado?' name='botao".$linhas_pendencias."'></td>";
		echo "<td><input type='text' size='11' name='txt' value='".@mysql_result($registros_pendentes, $linhas_pendencias, "posto_id")."' Use readonly='true'></form></td>";
		echo "<td>". @mysql_result($registros_pendentes, $linhas_pendencias, "posto_originador")."</td>";
		echo "<td>". @mysql_result($registros_pendentes,$linhas_pendencias, "posto_data_orig")."</td>";
		echo "<td>". @mysql_result($registros_pendentes,$linhas_pendencias, "posto_arquivo")."</td>";
		echo "<td>". @mysql_result($registros_pendentes,$linhas_pendencias, "posto_descritivo")."</td>";
		
		
		echo "</tr>";
		
		$linhas_pendencias = $linhas_pendencias + 1; 
		
	} */
	
	while ($query_sql_select = mysql_fetch_array($registros_pendentes))
	{
		if ($linhas_pendencias/2 == 0) //aqui testamos se a linha é par, se for, colore o fundo da tabela com azul
			{
				echo "<tr bgcolor='#ADD8E6' style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}
		else
			{
			
				echo "<tr style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}	
			$data_originado = $query_sql_select["posto_data_orig"]; //aqui fazemos a conversão tbm para que a data apareça dd/mm/aaaa e não formato SQL. usamos a funcao strtotime pra tal
			$data_convertida = strtotime($data_originado);
			
			$originador_posto = $query_sql_select["posto_originador"]; //Aqui pegamos o ID do originador e buscamos para realizar uma consulta para achar seu nome
			$miniConsulta = mysql_query("SELECT log_nome FROM tbllog WHERE id_log = '$originador_posto'") or die (mysql_error());
			$miniresultadonome = mysql_result($miniConsulta,0,'log_nome');
	
		 echo "<td><form action='trata_posto.php' method='post' name='form".$linhas_pendencias."'><input type='submit' value = 'Marcar como tratado?' name='botao".$linhas_pendencias."'></td>";
		echo "<td><input type='text' size='11' name='txt' value='".$id_posto = $query_sql_select["posto_id"]."' Use readonly='true'></form></td>";
		echo "<td><a href='originador_posto.php' target='_blank' title='Clique para visualizar lista de originadores'>".$miniresultadonome."</a></td>";
		echo "<td>". date('d/m/Y', $data_convertida)."</td>"; //aqui imputamos a data já convertida
		echo "<td><a href='http://www.psiti.w.pw/uploads/". $arquivo_posto = $query_sql_select["posto_arquivo"]."' target='_blank' title='Clique no link para visualizar o documento'>CLIQUE AQUI</a></td>";
		echo "<td>". $descritivo_posto = $query_sql_select["posto_descritivo"]."</td>";
		
		
		echo "</tr>";
		$linhas_pendencias = $linhas_pendencias + 1; //contador das linhas para atribuir nomes aos forms
	}
	
	echo "</table>";
	
	
	mysql_free_result($registros_pendentes);
}



	
?>


</body>

</html>