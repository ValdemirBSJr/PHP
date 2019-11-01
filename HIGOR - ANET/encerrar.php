<?php
session_start();
unset($_SESSION['IDCLI']);
unset($_SESSION['NAMECLI']);
unset($_SESSION['CLISOBRENOME']);
unset($_SESSION['TEL1']);
unset($_SESSION['TEL2']);
unset($_SESSION['ENDCLI']);
unset($_SESSION['ENDNUMCLI']);
unset($_SESSION['EMAILCLI']);
unset($_SESSION['COMPLENDCLI']);
unset($_SESSION['DISTANCIAENTREGACLI']);
unset($_SESSION['TEMPOENTREGACLI'] );
unset($_SESSION['ENDGOOGLECLI']);
unset($_SESSION['DATACADCLI']);


		header("Location: administraCpanel.php");

?>