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



/*################# FUN��ES DE TRATAMENTO DE STRINGS ####################

Removendo s�mbolos de uma string (caracteres n�o alfa-num�ricos):

$string = "String com numeros 123456789 e s�mbolos !@#$%�&*()_+";
$nova_string = preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
echo $nova_string;

Removendo s�mbolos e n�meros:

$string = "String com numeros 123456789 e s�mbolos !@#$%�&*()_+";
$nova_string = preg_replace("/[^a-zA-Z\s]/", "", $string);
echo $nova_string;


Removendo letras e s�mbolos:

$string = "String com numeros 123456789 e s�mbolos !@#$%�&*()_+";
$nova_string = preg_replace("/[^0-9\s]/", "", $string);
echo $nova_string;

Removendo s�mbolos de uma string (caracteres n�o alfa-num�ricos, incluindo espa�o):

$string = "String com numeros 123456789 e s�mbolos !@#$%�&*()_+";
$nova_string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
echo $nova_string;


*/
?>