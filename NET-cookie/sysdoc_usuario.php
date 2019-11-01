<?php

if (($_COOKIE['Est_logado'] !== "sim") || ($_COOKIE['Id_logado'] <> 3)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
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


<title>**USUÁRIO**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>


</head>

<body>

<nav>
<ul class="menuhorizontal">
<li><a href="#">ARQUIVAR &#9660 </a>
	<ul>
	<li><a href="sysdoc_usuario.php">ARQUIVAR POSTO</a></li>
	<li><a href="#">ARQUIVAR DOCUMENTO DIVERSO</a></li>
	</ul>
	</li>
<li><a href="busca_posto.php">PESQUISAR </a></li>
<li><a href="sair.php">SAIR</a></li>

</ul>
</nav>

<br><br><br>
<h1>Sysdoc do usuário</h1>
<br/><br/>
	<form name="enviar_arquivo"method="post" action="upload_posto.php" enctype="multipart/form-data" id="formuser">
<label>Originador:
<input name="originador" type="text" tabindex="1" size="15" Use readonly="true" value="<?php echo $_COOKIE['Id_usuario']?>">
</label><br/><br/>
<label>Data de origem:
<input name="data_originador" type="text" tabindex="2" size="16" value="<?php echo date("d/m/Y", time()); ?>" Use readonly="true">
</label><br/><br/>
<label>Arquivo:
<input name="arquivo" type="file" tabindex="1" size="15" required>
</label><br/><br/>
<label>Posto Responsável:

<?php
//conexão ao BD para pegar informações do combobox
mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

$StringSQL = "SELECT * FROM tbllog WHERE log_identificador = 2";

$consulta_combobox = mysql_query("$StringSQL") or die("Não foi possível se conectar ao Banco de dados do sistema. Contato o Administrador!");

echo "<select size='1' name='posto_responsavel'>";
echo "<option selected value='Selecione'>Selecione um posto!</option>";
	
	while ($StringSQL = mysql_fetch_array($consulta_combobox))
	{
		echo "<option value='".$id_posto = $StringSQL['id_log']."'>".$nome_posto = $StringSQL['log_nome']."</option>";
	}
	
	echo "</select>";
	
	mysql_free_result($consulta_combobox );
?>


</label><br/><br/>
<p>Voucher's do arquivo:</p>
<textarea name="voucher" rows="10" cols="40" resize="none" placeholder="Digite os vouchers do posto aqui... (SEPARADO SOMENTE POR VÍRGULAS) É altamente recomendado que você coloque os valores aqui para facilitar buscas posteriores." required></textarea>
</label><br/><br/>

<p><input type="submit" name="Submit" value="Enviar" tabindex="3" id="enviar"></P>
</form>



</body>

</html>