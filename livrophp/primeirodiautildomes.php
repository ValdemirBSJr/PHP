<?php

$mes = date("m");
  $ano = date("y");
  $primeiro = mktime(0, 0, 0, $mes, 1, $ano); 
  $dia = date("j", $primeiro);
  $dia_semana = date("w", $primeiro);
  $dia_de_hoje = mktime(0,0,0, $mes, date("d"), $ano);
  
  // domingo = 0;
  // s�bado = 6;
  // verifica s�bado e domingo
  if($dia_semana == 0){
    $dia++;
  }
  if($dia_semana == 6){
    $dia++;
	$dia++;
  }
  $primeiro = mktime(0, 0, 0, $mes, $dia, $ano);
  /*echo "O primeiro dia �til para o m�s informado 
     �: " . date("d/m/Y", $primeiro);
	 echo "<p>A data de hoje � :" .date("d/m/y", $dia_de_hoje)."</p>";
	 */
	 
	 if ($primeiro == $dia_de_hoje)
	 {
	 echo "Hoje � o primeiro dia util do mes!";
	 }
	 
	 ?>