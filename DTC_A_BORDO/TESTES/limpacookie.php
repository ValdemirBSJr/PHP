<?php

//A��o de limpeza de cookie ou qualquer outra coisa
setcookie("Cookie_countdown");

if($_COOKIE['Cookie_countdown']=="")
{
   echo "<p>Cookie limpo!</p>"; 
    
}
else
{
    echo "<p>Cookie ainda existe. Seu valor �: " .$_COOKIE['Cookie_countdown'];
}
?>