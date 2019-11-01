<?php
$pegavalor = $_POST['valor'];

setcookie("cuqui", $pegavalor, time() + 60 * 1); //cookie vive por um minuto

echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.psiti.w.pw/testenet/mostra.php">';
?>