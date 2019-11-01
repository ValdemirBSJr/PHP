<?php

if (isset($_POST['arquivo']))
{
$arquivo = $_POST['arquivo'];
echo "<p>O arquivo carregado foi: ".$arquivo."</p>";
}
else
{
echo "<p>Nenhum arquivo carregado</p>";
}
?>