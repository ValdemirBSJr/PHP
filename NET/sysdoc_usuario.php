<?php
session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if (($_SESSION['Est_logado'] !== "sim") || ($_SESSION['Id_logado'] <> 3)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
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


<title>**USUÁRIO**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>

<script language="javascript" type="text/javascript">
	function validar (enviarPosto) //confirma ao usuário o que ele setou. Se ele não concordar não faz nada
	{
	
	var nomePosto = document.getElementById('nomeposto').options[document.getElementById('nomeposto').selectedIndex].innerText; //pega texto do select do posto
	var arquivoEnviado = enviar_arquivo.arquivo.value; //aqui pego o caminho completo do arquivo e abaixo elimino e deico só o nome e a extensão
	var nomeIndice = arquivoEnviado.lastIndexOf("\\");
	var nomeArquivo = arquivoEnviado.substring(nomeIndice + 1);
	
		decisao = confirm("CONFIRME OS DADOS ABAIXO(CLIQUE EM CANCELAR SE ESTIVEREM INCORRETOS): \n POSTO RESPONSÁVEL: " + nomePosto + "\n NOME DO ARQUIVO ENVIADO: " +  nomeArquivo + "\n VOUCHER: " + enviar_arquivo.voucher.value);
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
	<form name="enviar_arquivo" method="post" action="upload_posto.php" enctype="multipart/form-data" id="enviarPosto" onsubmit="return validar(this)">
<label>Originador:
<input name="originador" type="text" tabindex="1" size="15" Use readonly="true" value="<?php echo $_SESSION['Id_usuario']?>">
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
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

$StringSQL = "SELECT * FROM tbllog WHERE log_identificador = 2";

$consulta_combobox = mysql_query("$StringSQL") or die("Não foi possível se conectar ao Banco de dados do sistema. Contato o Administrador!");

echo "<select size='1' name='posto_responsavel' id='nomeposto'>";
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