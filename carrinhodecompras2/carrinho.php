<?php

//INICIALIZA A SESSÃO
session_start();

//VERIFICA SE A OPÇÃO ATUALIZAR FOI SELECIONADA
if($_POST[opc_atualizar]) {

//RECEBE OS PRODUTOS CHECADOS PARA ATUALIZAÇÃO
$v_atualiza = $_POST[a_prod];

//PEGA A CHAVE DO ARRAY
$chave = array_keys($v_atualiza);

//EXIBE
for($i=0; $i<sizeof($chave); $i++) {
//PEGA O INDICE DO PRODUTO
$indice = $chave[$i];

//ALTERA A QUANTIDADE DO PRODUTO SELECIONADO
$_SESSION[cesta][$indice][QTDE] = $v_atualiza[$indice][QTDE];
}//FECHA FOR
}//FECHA IF


//VERIFICA SE A OPÇÃO EXCLUIR FOI SELECIONADA
elseif($_POST[opc_excluir]) {

//RECEBE OS PRODUTOS CHECADOS PARA EXCLUSÃO
$excluir = $_POST[check];

//EXIBE
for($i=0; $i<sizeof($excluir); $i++) {
//PEGA O INDICE DO PRODUTO
$indice = $excluir[$i];
//DESTRÓI A VARIÁVEL ESPECIFICADA
unset($_SESSION[cesta][$indice]);
}//FECHA FOR
}//FECHA IF

//RECEBE O PEDIDO DO USUÁRIO
elseif($_POST[opc_efetivar]) {
//RECEBE AS VARIÁVEIS
$v_prod = $_POST[txtprod];

//PEGA A CHAVE DO ARRAY
$chave = array_keys($v_prod);

//EXIBE
for($i=0; $i<sizeof($chave); $i++) {
$indice = $chave[$i];

//VERIFICA
if(!empty($v_prod[$indice][QTDE]) ) {

//GRAVA NO ARRAY CESTA
$cesta[$indice][ARTISTA] = $v_prod[$indice][ARTISTA];
$cesta[$indice][ALBUM] = $v_prod[$indice][ALBUM];
$cesta[$indice][preço] = $v_prod[$indice][preço];
$cesta[$indice][QTDE] = $v_prod[$indice][QTDE];
}//FECHA IF
}//FECHA FOR

//GRAVA NA SESSÃO
$_SESSION[cesta] = $cesta;
}//FECHA ELSE
?>

<html>
<head>
<title>.:: WebMaster.PT :: Carrinho de Compras Personalizado ::.</title>
<style type="text/css">
<!--
body {
margin-left: 0px;
margin-top: 0px;
margin-right: 0px;
margin-bottom: 0px;
}
.style2 {
color: #000000;
font-weight: bold;
}
.style5 {color: #FFFFFF; font-weight: bold; }
-->
</style>

<script language="JavaScript">
<!--
function enviar(opcao) {
//OPÇÃO EXCLUIR SELECIONADA
if(opcao == 'E') {
document.forms[0].opc_excluir.value = 1;
document.forms[0].submit();
}//FECHA IF

//OPÇÃO ATUALIZAR SELECIONADA
if(opcao == 'A') {
document.forms[0].opc_atualizar.value = 1;
document.forms[0].submit();
}//FECHA IF

//OPÇÃO FINALIZAR SELECIONADA
if(opcao == 'F') {
document.forms[0].opc_finalizar.value = 1;
document.forms[0].action = "finalizar.php";
document.forms[0].submit();
}//FECHA IF

}//FECHA FUNCTION
//-->
</script>

</head>

<body>
<table width="773" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><br>
<br>
<br>
<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><font size="2" face="Arial">Carrinho de Compras: </font></td>
</tr>
</table>

<?php
//EXIBE O CARRINHO SE TIVER PRODUTOS
if(count($_SESSION[cesta]) > 0) { ?>

<form name="frmCarrinho" method="post">
<input type="hidden" name="opc_excluir">
<input type="hidden" name="opc_atualizar">
<input type="hidden" name="opc_finalizar">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr bgcolor="#CCCCCC">
<td width="4%"> </td>
<td width="8%"><span class="style2">Qtde</span></td>
<td width="51%"><span class="style2">Produto</span></td>
<td width="19%"><span class="style2">Valor</span></td>
<td width="18%"><span class="style2">Subtotal</span></td>
</tr>
<?php
//PEGA A CHAVE
$chave_cesta = @array_keys($_SESSION[cesta]);

//EXIBE OS PRODUTOS DA CESTA
for($i=0; $i<sizeof($chave_cesta); $i++) {
$indice = $chave_cesta[$i];

//SUBTOTAIS DE CADA PRODUTO
$subtotal = $_SESSION[cesta][$indice][QTDE] * ereg_replace(",",".",$_SESSION[cesta][$indice][preço]);

//TOTAL GERAL
$total += $subtotal;
?>
<tr>
<td height="25"><input name="check[]" type="checkbox" value="<?php echo $indice; ?>"></td>
<td height="25"><font face='Arial' size='2'>
<input type="text" name="a_prod[<?php echo $indice; ?>][QTDE]" value="<?php echo $_SESSION[cesta][$indice][QTDE]; ?>" size="3"></font></td>
<td height="25"><font face='Arial' size='2'><?php echo $_SESSION[cesta][$indice][ARTISTA]; ?> - <?php echo $_SESSION[cesta][$indice][ALBUM]; ?></font></td>
<td height="25"><font face='Arial' size='2'>R$ <?php echo $_SESSION[cesta][$indice][preço]; ?></font></td>
<td width="18%" height="25"><font face='Arial' size='2'> R$ <?php echo number_format($subtotal,2,',','.'); ?></font></td>
</tr>
<?php
}//FECHA FOR ?>
<tr>
<td height="25" colspan="3">
<input type="image" name="btnExcluir" src="imagens/excluir.gif" onClick="enviar('E');">
<input type="image" name="btnAtualiza" src="imagens/atualizar.gif" onClick="enviar('A');"></td>
<td height="25" bgcolor="#FF0000"><span class="style5"> Total à pagar: </span></td>
<td height="25" bgcolor="#FFF0F0" class="style2"> R$ <b><?php echo number_format($total,2,',','.'); ?></b></td>
</tr>
<tr>
<td height="25" colspan="3"> </td>
<td height="40" colspan="2"><div align="center">
<input type="image" name="btnFinaliza" src="imagens/continuar.gif" onClick="enviar('F');"></div></td>
</tr>
</table>
</form>
<?php
}//FECHA IF(count)
else { ?><br><br><br>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align='center'><font face='Arial' size='2' color="#006666"><b>Desculpe, mas no momento você não possui nenhumm produto.</b></td>
</tr>
</table><br><br>
<?php
}//FECHA ELSE (count)?>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align='center'><font face='Arial' size='2'><a href="index.php"><< Voltar </a></font></td>
</tr>
</table>
<br>
</td>
</tr>
</table>
</body>
</html>
