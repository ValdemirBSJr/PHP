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



//abaixo pego quem está tratando o posto via session e os demais dados para inputar nos dados tratados
$Posto_tratador = $_COOKIE['Id_logado'];
$Id_posto = $_POST['txt'];

//echo "Tratador: ". $_SESSION['Id_usuario']. ". ID mandado: ".   $_POST['txt'];

//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

if (empty($Id_posto))
{
echo "<p>O botão clicado não pertence a um posto válido! Os postos válidos tem número de ID e informações que a acompanham na tabela.</p>";
echo"<p>Você será redirecionado em breve ou clique abaixo:</p>";
echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_posto.php'><p>Voltar a tela de tratamento.</p></a>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://www.psiti.w.pw/testenet/sysdoc_posto.php">';
}
else {
$consulta = "SELECT * FROM tbluploadposto WHERE posto_id = '$Id_posto'";
$resgata_posto= mysql_query("$consulta") or die("Erro no acesso ao servidor/BD. Contate o ADMINISTRADOR.");

while ($consulta = mysql_fetch_array($resgata_posto))

	{
	$originador = $consulta['posto_originador'];
	$data_origem = $consulta['posto_data_orig'];
	$arquivo_posto = $consulta['posto_arquivo'];
	$descritivo_posto = $consulta['posto_descritivo'];
	$tratador_selecionado_originador = $consulta['posto_demanda_tratad'];
	
	}
$data_tratamento = date('Y-m-d'); // Formato DATETIME: 2009-03-12 03:39:57


$tratar_posto = mysql_query("UPDATE tbluploadposto SET posto_originador = '$originador', posto_demanda_tratad='$tratador_selecionado_originador', posto_data_orig = '$data_origem', posto_tratador = '$Posto_tratador', posto_tratado = 1, posto_data_tratado = '$data_tratamento', posto_arquivo = '$arquivo_posto', posto_descritivo = '$descritivo_posto'  WHERE posto_id = '$Id_posto'") or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");

echo "<p>Posto tratado com sucesso! Em poucos instantes você retornará a página de tratamento! Ou clique no link abaixo.</p>";
echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_posto.php'><p>Voltar a tela de tratamento.</p></a>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://www.psiti.w.pw/testenet/sysdoc_posto.php">';
}

?>