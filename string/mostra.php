<?php
if (isset($_COOKIE['cookie']))
{
 setcookie ("cookie", $_COOKIE['cookie'], time() + 1 * 60);
}
else
{
die ("sua sessão expirou");
} 

$resultado = $_COOKIE['cookie'];
echo $resultado."<br/>";

list($texto1, $texto2) = explode(".", $resultado);

echo $texto1."<br/>";
echo $texto2."<br/>";

echo "COOKIE: ".$_COOKIE['cookie'];
?>