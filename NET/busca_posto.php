<?php
session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if ($_SESSION['Est_logado'] !== "sim") //aqui verifico se a session de acesso est� ativa e se o perfil � o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/index.html">';
session_destroy();
 die( "Sua se��o expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
}
if ($registro) //Verifica se a session est� ativa
{
$segundos = time() - $registro; //se tiver ativa atualiza em quanto tempo est�
}

/* verifica abaixo o tempo de inatividade 
se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
se n�o ele renova o tempo e ai � contado mais 900 segundos*/

if($segundos>$limite)
{
 session_destroy();
 die( "Sua se��o expirou.");
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

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>


<title>**BUSCAR**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>


<script type="text/javascript">
function valor () //funcao para exibir e ocultar campos
{

var indice = document.getElementById("select_perfil").value; //aqui obtemos o indice do combobox
//alert(indice); 
if (indice == 4) //busca por ID
{
document.getElementById("busca_ID").style.display = "block";

}
else
{
document.getElementById("busca_ID").style.display = "none";

}

if (indice == 1) //busca por data
{
document.getElementById("busca_data").style.display = "block";
}
else
{
document.getElementById("busca_data").style.display = "none";
}

if (indice == 2) //busca por intervalo de data
{
document.getElementById("busca_inter_data").style.display = "block";
}
else
{
document.getElementById("busca_inter_data").style.display = "none";
}

if (indice == 3) //busca por voucher
{
document.getElementById("busca_voucher").style.display = "block";
}
else
{
document.getElementById("busca_voucher").style.display = "none";
}

if (indice == 5) //busca por voucher
{
document.getElementById("busca_criador").style.display = "block";
}
else
{
document.getElementById("busca_criador").style.display = "none";
}

if (indice == 6) //busca por voucher
{
document.getElementById("busca_tratador").style.display = "block";
}
else
{
document.getElementById("busca_tratador").style.display = "none";
}



}
</script>

<script type="text/javascript">
function dateMask(inputData, e){ //fun��o para tratar os campos data

var tecla;

if(document.all) // Internet Explorer
tecla = event.keyCode;
else //Outros Browsers
tecla = e.which;

if(tecla >= 48 && tecla < 58){ // numeros de 0 a 9 e '/'
var data = inputData.value;

//validar o dia do m�s
if (data.length == 2){
if(inputData.value >= 1 && inputData.value <= 31) {
data += '/';
inputData.value = data;
return true;
}
else
return false;
}

//validar o m�s (de 1 a 12)
if (data.length == 5){
mes = data[3]+""+data[4];
if(mes >= 1 && mes <= 12) {
data += '/';
inputData.value = data;
return true;
}
else
return false;
}

//validar o ano (de 1900 a 2100)
if (data.length == 8){
ano = data[6]+""+data[7];
if(ano >= 19 && ano <= 21){
inputData.value = data;
return true;
}
else
return false;
}

}else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
return true;
else
return false;
}

</script>

</head>

<body>


<br><br><br>
<h1>Busca de documenta��o</h1><br><br>

	<form name="buscar_processos" method="post" action="posto_query.php">

	
	<label>Selecione o tipo de busca que deseja fazer:
<select name="perfil"   id="select_perfil" size="1" onchange="valor()">
<option selected value="selecione">Selecione um dos perfis abaixo</option>
<option value="1">Busca por data de cria��o</option>
<option value="2">Busca por intervalo de data</option>
<option value="3">Busca por voucher</option>
<option value="4">Busca por ID</option>
<option value="5">Busca por Originador</option>
<option value="6">Busca por Tratador</option>
</select>
</label>


<br/><br/>

<div id="busca_ID" style="display:none">
<p><label>Digite o n�mero do ID do processo:
<input type="text" name="id_busca">
</label></p>
</div>

<div id="busca_data" style="display:none">

<p><label>Digite a data do(s) processo(s) (Adotar dd/mm/aaaa):
<input type="text" name="data" size="7" onkeypress="return dateMask(this, event)" maxlength="10";>
</label></p>

<label>Tratamento do(s) posto(s):
<select name="tratamento_pos_data"    size="1">
<option value="1" selected>Postos Tratados</option>
<option value="2">Postos n�o tratados</option>
<option value="3">Tudo</option>
</select>
</label>

</div>

<div id="busca_inter_data" style="display:none">

<p><label>Digite a data inicial dos processos (Adotar dd/mm/aaaa):
<input type="text" name="dataini" size="7" onkeypress="return dateMask(this, event)" maxlength="10">
</label></p>

<p><label>Digite a data final dos processos (Adotar dd/mm/aaaa):
<input type="text" name="datafin" size="7" onkeypress="return dateMask(this, event)" maxlength="10">
</label></p>

</div>

<div id="busca_voucher" style="display:none">
<p><label>Digite o n�mero do voucher:
<input type="text" name="voucher" size="13">
</label></p>
</div>

<div id="busca_criador" style="display:none">

<p><label>Digite o ID do criador do posto:
<input type="text" name="id_criador" size="9">
<a href='originador_posto.php' target='_blank' title='Clique para visualizar lista de originadores'>Clique aqui para ver o originador</a>
</label></p>
<p><label>Digite uma data:
<input type="text" name="data_criador" size="7" onkeypress="return dateMask(this, event)" maxlength="10">

</label></p>

</div>


<div id="busca_tratador" style="display:none">

<p><label>Digite o ID do tratador do posto:
<input type="text" name="id_tratador" size="9">
<a href='tratador_posto.php' target='_blank' title='Clique para visualizar lista de postos fiscais.'>Clique aqui para ver o tratador</a>
</label></p>
<p><label>Digite uma data:
<input type="text" name="data_tratador" size="7" onkeypress="return dateMask(this, event)" maxlength="10">


</div>

<br><br><br><br>
<label>
<p><input type="submit" name="Submit" value="Come�ar" tabindex="3" id="busca_comeca"></p>

</label>



</form>

<?php
		 $Identificador_resgatado = $_SESSION['Id_logado']; //aqui � o perfil
echo "<br><br>";
 
// fim das configura��es de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usu�rio, e envio para uma p�gina de acordo com ele
{
echo "<a href='http://localhost/NET/sysdoc_usuario.php'>Voltar</a>"; //redireciona para outra pasta
}
elseif ($Identificador_resgatado == 2)
{
echo "<a href='http://localhost/NET/sysdoc_posto.php'>Voltar</a>";
}

elseif ($Identificador_resgatado == 1)
{
echo "<a href='http://localhost/NET/sysdoc_admin.php'>Voltar</a>";
}

?>


</body>

</html>