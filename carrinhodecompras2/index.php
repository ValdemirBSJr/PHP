<?php
//MONTA O ARRAY DE PRODUTOS
$produto[1][CODIGO] = "1";
$produto[1][ARTISTA] = "Produto 01";
$produto[1][ALBUM] = "Descrição do Produto 01";
$produto[1][PRECO] = "10,15";
$produto[1][IMAGEM] = "imgens/semimagem.jpg";

$produto[2][CODIGO] = "2";
$produto[2][ARTISTA] = "Produto 02";
$produto[2][ALBUM] = "Descrição do Produto 02";
$produto[2][PRECO] = "15,25";
$produto[2][IMAGEM] = "imgens/semimagem.jpg";

$produto[3][CODIGO] = "3";
$produto[3][ARTISTA] = "Produto 03";
$produto[3][ALBUM] = "Descrição do Produto 03";
$produto[3][PRECO] = "20,10";
$produto[3][IMAGEM] = "imgens/semimagem.jpg";

$produto[4][CODIGO] = "4";
$produto[4][ARTISTA] = "Produto 04";
$produto[4][ALBUM] = "Descrição do Produto 04";
$produto[4][PRECO] = "25,60";
$produto[4][IMAGEM] = "imgens/semimagem.jpg";


//TOTAL DE PRODUTOS POR LINHA
$total = 2;

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
-->
</style></head>

<body>
<table width="773" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><br><br><br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><font face='Arial' size='2'>Confira abaixo, os produtos disponíveis no site:</font> </td>
</tr>
</table>
<br>

<form action="carrinho.php" method="post" name="frmcarrinho">
<input type="hidden" name="opc_efetivar" value="1">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<?php
//PEGA A CHAVE DO ARRAY
$chave = array_keys($produto);

//EXIBE OS PRODUTOS
for($i=0; $i<sizeof($chave); $i++) {
$indice = $chave[$i];
$codigo = $produto[$indice][CODIGO];
$artista = $produto[$indice][ARTISTA];
$album = $produto[$indice][ALBUM];
$preço = $produto[$indice][PRECO];
$imagem = $produto[$indice][IMAGEM];

//VERIFICA
if($total == $atual) {
echo "</tr><tr>";
$atual = 0;
} ?>

<td width="14%" height="100"><img src="imagens/<?= $imagem; ?>" width="80" height="80" border="1"></td>
<td width="36%">

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><font face='Arial' size='2'><?php echo $artista; ?></font></td>
</tr>

<tr>
<td><font face='Arial' size='2'><?php echo $album; ?></font></td>
</tr>

<tr>
<td><font face='Arial' size='2'>R$ <?php echo $preço; ?></font></td>
</tr>

<tr>
<td>
<input type="hidden" name="txtprod[<?php echo $indice;?>][CODIGO]" value="<?php echo $codigo; ?>">
<input type="hidden" name="txtprod[<?php echo $indice;?>][ARTISTA]" value="<?php echo $artista; ?>">
<input type="hidden" name="txtprod[<?php echo $indice;?>][ALBUM]" value="<?php echo $album; ?>">
<input type="hidden" name="txtprod[<?php echo $indice;?>][preço]" value="<?php echo $preço; ?>">
<input type="text" name="txtprod[<?php echo $indice;?>][QTDE]" size="3" maxlength="3">
<input type="image" src="imagens/carrinho.gif" onClick="java script: document.forms[0].submit();"></td>
</tr>
</table></td>
<?php
//SOMA 1 A VARIÁVEL CONTROLADORA
$atual++;
}//FEHA FOR ?>
</tr>
</table>
</form></td>
</tr>
</table>
</body>
</html>
