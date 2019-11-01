<?
/************************************************************************
ARQUIVO .........: Carrinho de compras simples: usando arrays e session
BY ..............: Júlio César Martini
DATA ............: 16/03/2004
************************************************************************/

//INICIALIZA A SESSÃO
session_start();

//RECEBE AS VARIÁVEIS
$v_prod  =  $_POST["txtprod"];

//PEGA A CHAVE DO ARRAY
$chave  =  array_keys($v_prod);

//EXIBE
for($i=0; $i<sizeof($chave); $i++) {
   $indice  =  $chave[$i];
   
   //VERIFICA
   if(!empty($v_prod[$indice][QTDE]) ) {
      
	  //GRAVA NO ARRAY CESTA
	  $cesta[$indice][ARTISTA]  =    $v_prod[$indice][ARTISTA];
	  $cesta[$indice][ALBUM]    =    $v_prod[$indice][ALBUM];
	  $cesta[$indice][PRECO]    =    $v_prod[$indice][PRECO];
	  $cesta[$indice][QTDE]     =    $v_prod[$indice][QTDE];
   }//FECHA IF
}//FECHA FOR

//GRAVA NA SESSÃO
$_SESSION[cesta]        =   $cesta;
?>

<html>
<head>
<title>89º artigo PHP</title>
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
-->
</style></head>

<body>
<table width="773"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="topo.gif" width="773" height="100"></td>
  </tr>
  <tr>
    <td><br>
    <br>
    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align='center'><font face='Arial' size='4'><b>Carrinho de compras utilizando arrays e session</b></font></td>
      </tr>
    </table>
    <br>
    <br>
    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><font size="2" face="Arial">Carrinho de Compras: </font></td>
      </tr>
    </table>
    <br>
    <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <td width="6%">&nbsp;</td>
        <td width="11%"><span class="style2">Qtde</span></td>
        <td width="58%"><span class="style2">Produto</span></td>
        <td width="25%"><span class="style2">Valor</span></td>
      </tr>
	  <?
	  //PEGA A CHAVE
      $chave_cesta  =  array_keys($_SESSION[cesta]);

	  //EXIBE OS PRODUTOS DA CESTA
	  for($i=0; $i<sizeof($chave_cesta); $i++) { 
	     $indice   =   $chave_cesta[$i]; 
	  ?>
      <tr>
        <td height="25">&nbsp;</td>
        <td height="25"><font face='Arial' size='2'><? echo $_SESSION[cesta][$indice][QTDE]; ?></font></td>
        <td height="25"><font face='Arial' size='2'><? echo $_SESSION[cesta][$indice][ARTISTA]; ?> - <? echo $_SESSION[cesta][$indice][ALBUM]; ?></font></td>
        <td height="25"><font face='Arial' size='2'>R$ <? echo $_SESSION[cesta][$indice][PRECO]; ?></font></td>
      </tr>
	  <?
	  }//FECHA FOR ?>
    </table>    
    <br>
    <table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align='center'><font face='Arial' size='2'><a href="javascript: history.back();">&lt;&lt; Voltar </a></font></td>
      </tr>
    </table>
    <br>    <br></td>
  </tr>
  <tr>
    <td><img src="rodape.gif" width="773" height="20"></td>
  </tr>
</table>
</body>
</html>
