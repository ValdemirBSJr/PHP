<?php
session_start("Esta_Logado");
$_SESSION['Est_logado'] = "nao";
unset($_SESSION['registro']);
unset($_SESSION['limite']);
$_SESSION['atualizou'] ="nao";
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/index.html">';

?>