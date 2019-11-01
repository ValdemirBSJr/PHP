<?php
session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if ($_SESSION['Est_logado'] !== "sim" || $_SESSION['Id_logado'] <> 2) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/index.html">';
session_destroy();
 die( "Sua seção expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>**POSTO**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>

<script language=javascript TYPE="text/javascript"> 

function atualizar() 

//{alert('Você clicou no botão de alerta');} 

{window.location=window.location};//atualiza a página

</script> 

<script language="javascript" type="text/javascript">
	function validar (trataPosto) //confirma ao usuário o que ele setou. Se ele não concordar não faz nada
	{
	
		
	
		decisao = confirm("DESEJA MARCAR O POSTO DE ID COMO UM POSTO VISUALIZADO E TRATADO? CLIQUE EM \"CANCELAR\" PARA CANCELAR E OK PARA CONFIRMAR.");
			if (decisao)
			{
				return true;
			}
			else
			{
				return false;
			}
			
	}


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
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());	



//abaixo o script conta quantos registros não foram tratados pelo posto
$contador_pendencias = mysql_query("SELECT COUNT(*) FROM tbluploadposto WHERE posto_tratado = 0 AND posto_demanda_tratad = ".$_SESSION['Id_usuario']) or die("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");

//Agora temos abaixo os registros que estão pendentes
$query_sql_select = "SELECT * FROM tbluploadposto WHERE posto_tratado = 0 AND posto_demanda_tratad = ".$_SESSION['Id_usuario'];
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
		if (($linhas_pendencias/2 <> 0) && ($linhas_pendencias/2 <> 1)) //aqui testamos se a linha é ímpar, se for, colore o fundo da tabela com azul
			{
				echo "<tr bgcolor='#ADD8E6' style='border-collapse: collapse;  border-bottom: 2px solid #0000FF' class='hovercoluna'>";
			}
		else
			{
			
				echo "<tr style='border-collapse: collapse;  border-bottom: 2px solid #0000FF' class='hovercoluna'>";
			}	
			$data_originado = $query_sql_select["posto_data_orig"]; //aqui fazemos a conversão tbm para que a data apareça dd/mm/aaaa e não formato SQL. usamos a funcao strtotime pra tal
			$data_convertida = strtotime($data_originado);
			
			$originador_posto = $query_sql_select["posto_originador"]; //Aqui pegamos o ID do originador e buscamos para realizar uma consulta para achar seu nome
			$miniConsulta = mysql_query("SELECT log_nome FROM tbllog WHERE id_log = '$originador_posto'") or die (mysql_error());
			$miniresultadonome = mysql_result($miniConsulta,0,'log_nome');
	
		 echo "<td><form action='trata_posto.php' method='post' name='form".$linhas_pendencias."' onsubmit='return validar(this)' class='trataPosto'><input type='submit' value = 'Marcar como tratado?' name='botao".$linhas_pendencias."'></td>";
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