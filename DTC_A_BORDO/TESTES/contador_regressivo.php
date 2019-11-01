<html>


<?php
//Contador regressivo que salva o tempo em cookie. Caso reinicie, fica onde parou sem reiniciar.

$tempo_atual =  @mktime(date("Y/m/d H:i:s"));;
$tempo_permitido = 30; // tempo em segundos até redirecionar e ir a outra pagin/ fazer outra açao
$fim = "";

if($_COOKIE['Cookie_countdown']=="") //se o cookie tiver zerado, ele pega o tempo atual. Mudar para não aparecer mais
{
$tempo_entrada =  @mktime(date("Y/m/d H:i:s"));;
$tempo_cookie = '3600'; // em segundos
setcookie("Cookie_countdown", "$tempo_entrada", time()+($tempo_cookie));
} else {
$tempo_gravado = $_COOKIE['Cookie_countdown'];
$tempo_gerado = $tempo_atual-$tempo_gravado;
$fim = $tempo_permitido-$tempo_gerado;
if($fim <= 0) {
//echo "tempo esgotado";
} else {
//echo $fim;
}
}
?>

<head>
    <title>Contador REGRESSIVO</title>
    
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    
 <script language="JavaScript">
var contador = '<?php if($fim=="") { echo $tempo_permitido+1; } else { echo "$fim"; } ?>';

//O código abaixo efetua um contador sem formatação de relógio que chama corretamente uma página em php para limpar o cookie/fazer ação

//function conta() {
//if(contador <= 0) {
//location.href='limpacookie.php'; //abre o arquivo que limpa o cookie. Pode ser formulado uma ação
//return false;
//}
//contador = contador-1;
//setTimeout("conta()", 1000);
//document.getElementById("valor").innerHTML = contador;
//}


  var YY = 2014;
        var MM = 07;
        var DD = 26;
        var HH = 18;
        var MI = 09;
        //var SS = contador; exemplo de como usar variavel php
        var SS = 30;
                
  function conta() {
  var hoje = new Date();
  var futuro = new Date(YY,MM-1,DD,HH,MI,SS); 

  var ss = parseInt((futuro - hoje) / 1000);
  var mm = parseInt(ss / 60);
  var hh = parseInt(mm / 60);
  var dd = parseInt(hh / 960); 

  ss = ss - (mm * 60);
  mm = mm - (hh * 60);
  hh = hh - (dd * 24); 

  var faltam = '';
  faltam += (toString(hh).length) ? hh+'<span style=\"font-size:12px;\">H</span>&nbsp;&nbsp;' : '';
  faltam += (toString(mm).length) ? mm+'<span style=\"font-size:12px;\">M</span>&nbsp;&nbsp;' : '';
  faltam += ss+'<span style=\"font-size:12px;\">S</span>&nbsp;&nbsp;'; 

  if (dd+hh+mm+ss > 0) {
    document.getElementById('valor').innerHTML = faltam;
    setTimeout(conta,0);
  } else {
    document.getElementById('valor').innerHTML = 'ACABOU';
    //setTimeout(conta,0);
    location.href='limpacookie.php'; //abre o arquivo que limpa o cookie. Pode ser formulado uma ação
  }
}


window.onload = function()
{
 conta();   
}
</script>
    
</head>

<body >
<div id="valor"></div>
    
    
</body>


</html>