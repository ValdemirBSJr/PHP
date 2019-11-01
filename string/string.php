<?php
$valor = $_POST['valor'];
$login = $_POST['login'];

$login_corrigido = preg_replace("/[^a-zA-Z0-9]/", "", $login); //aqui se retira todos os caracteres especiais. 
$stringjunta = $login_corrigido.".".$valor;

list ($login_resgatado, $valor_resgatado) = explode(".", $stringjunta);
 
 echo $stringjunta."<br/>";
 echo $login_resgatado."<br/>";
 echo $valor_resgatado."<br/>";

setcookie("cookie", $stringjunta, time() + 60 * 1);
 
 echo $_COOKIE['cookie'];

//echo '<meta HTTP-EQUIV="Refresh" CONTENT="4; URL=http://www.psiti.w.pw/mostra.php">';

echo '<meta HTTP-EQUIV="Refresh" CONTENT="4; URL=http://localhost/string/mostra.php">';



/*################# FUNÇÕES DE TRATAMENTO DE STRINGS ####################

Removendo símbolos de uma string (caracteres não alfa-numéricos):

$string = "String com numeros 123456789 e símbolos !@#$%¨&*()_+";
$nova_string = preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
echo $nova_string;

Removendo símbolos e números:

$string = "String com numeros 123456789 e símbolos !@#$%¨&*()_+";
$nova_string = preg_replace("/[^a-zA-Z\s]/", "", $string);
echo $nova_string;


Removendo letras e símbolos:

$string = "String com numeros 123456789 e símbolos !@#$%¨&*()_+";
$nova_string = preg_replace("/[^0-9\s]/", "", $string);
echo $nova_string;

Removendo símbolos de uma string (caracteres não alfa-numéricos, incluindo espaço):

$string = "String com numeros 123456789 e símbolos !@#$%¨&*()_+";
$nova_string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
echo $nova_string;


*/
?>