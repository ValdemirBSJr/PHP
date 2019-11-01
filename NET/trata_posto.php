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



//abaixo pego quem está tratando o posto via session e os demais dados para inputar nos dados tratados
$Posto_tratador = $_SESSION['Id_logado'];
$Id_posto = $_POST['txt'];

//echo "Tratador: ". $_SESSION['Id_usuario']. ". ID mandado: ".   $_POST['txt'];

//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());	

if (empty($Id_posto))
{
echo "<p>O botão clicado não pertence a um posto válido! Os postos válidos tem número de ID e informações que a acompanham na tabela.</p>";
echo"<p>Você será redirecionado em breve ou clique abaixo:</p>";
echo "<a href='sysdoc_posto.php'><p>Voltar a tela de tratamento.</p></a>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/sysdoc_posto.php">';
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
echo "<a href='sysdoc_posto.php'><p>Voltar a tela de tratamento.</p></a>";
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/sysdoc_posto.php">';
}

?>