<?php
session_start();
 if(!isset($_SESSION['NAMECLI']))
             {
              die("Para que voc&ecirc possa visualizar pedidos, verifique se foi realizado um pedido ou que voc&ecirc seja um cliente v&aacutelido");
             }
             
             else
             {
                
 echo '<div class="modal-content">';
      
  echo '    <h1 class="statusDelivery">Verifique aqui o status da sua entrega!</h1>';
 
     
  if($_SESSION['NAMECLI'])
  {
      
      try {
      
	
	$DB_Host= "mysql.hostinger.com.br"; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "u662939396_vicia";
	$DB_User = "u662939396_us3rr";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_ClienteID = :clienteID AND pedidos_Status <= :statusPedido");
    $stmt -> bindValue(':clienteID', $_SESSION['IDCLI']);
    $stmt -> bindValue(':statusPedido', "3");

    // Executa query
    $stmt->execute();
 
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
      
      
       if ($obj[9] == 0)
      {
            
            $retornaArray = explode(';', $obj[6]);
            
            echo '<h5>Pedido: ';
            
            foreach($retornaArray as $rotulo => $informacao)
            {
                echo $informacao." ";  
            }
	
    echo '.</h5>';
    echo 'Valor: R$ '.number_format($obj[7], 2, ',', '.');
    
    echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
    
    echo '<li class="active">Pedido Realizado</li>';
    echo '<li class="">Sushi sendo preparado </li>';
    echo '<li class="">Sushi pronto! </li>';
    echo '<li class="">Em entrega! </li>';
    echo '<li class="">Entregue </li>';
    
     echo    '</ul>';
echo '</div><br><br><br><br>';
      }
      
         if ($obj[9] == 1)
      {
           $retornaArray = explode(';', $obj[6]);
            
            echo '<h5>Pedido: ';
            
            foreach($retornaArray as $rotulo => $informacao)
            {
                echo $informacao." ";  
            }
            
       echo '.</h5>';
      echo 'Valor: R$ '.number_format($obj[7], 2, ',', '.');
	
    echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
    
    echo '<li class="visited first">Pedido Realizado</li>';
    echo '<li class="active">Sushi sendo preparado </li>';
    echo '<li class="">Sushi pronto! </li>';
    echo '<li class="">Em entrega! </li>';
    echo '<li class="">Entregue </li>';
    
     echo    '</ul>';
echo '</div><br><br><br><br>';
      }
      
         if ($obj[9] == 2)
      {
         
         $retornaArray = explode(';', $obj[6]);
            
            echo '<h5>Pedido: ';
            
            foreach($retornaArray as $rotulo => $informacao)
            {
                echo $informacao." ";  
            }   
    echo '.</h5>';
    echo 'Valor: R$ '.number_format($obj[7], 2, ',', '.');
	
    echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
    
    echo '<li class="visited first">Pedido Realizado</li>';
    echo '<li class="previous visited">Sushi sendo preparado </li>';
    echo '<li class="active">Sushi pronto! </li>';
    echo '<li class="">Em entrega! </li>';
    echo '<li class="">Entregue </li>';
    
     echo    '</ul>';
echo '</div><br><br><br><br>';
      }
      
      
      if ($obj[9] == 3)
      {
        
        $retornaArray = explode(';', $obj[6]);
            
            echo '<h5>Pedido: ';
            
            foreach($retornaArray as $rotulo => $informacao)
            {
                echo $informacao." ";  
            }    
    echo '.</h5>';
    echo 'Valor: R$ '.number_format($obj[7], 2, ',', '.').'<br>';
	echo 'Tempo estimado de entrega: '.$obj[10];
    
    
    echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
    
    echo '<li class="visited first">Pedido Realizado</li>';
    echo '<li class="previous visited">Sushi sendo preparado </li>';
    echo '<li class="previous visited">Sushi pronto! </li>';
    echo '<li class="active">Em entrega!</li>';
    echo '<li class="">Entregue </li>';
    
     echo    '</ul>';
echo '</div><br><br><br><br>';
      }
      
      

    }
    
    	if ($stmt -> rowCount() < 1)
	{
      
      echo '<h5>Voc&ecirc não possui pedidos no momento.</h5>';
		 echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
  
    echo '<li class="">Pedido Realizado</li>';
    echo '<li class="">Sushi sendo preparado </li>';
    echo '<li class="">Sushi pronto! </li>';
    echo '<li class="">Em entrega! </li>';
    echo '<li class="">Entregue </li>';
    
  echo    '</ul>';
echo '</div>';
	}
   
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
     


  }
  else
  {
       echo'<div class="checkout-wrap">';
  echo'<ul class="checkout-bar">';
  
    echo '<li class="">Pedido Realizado</li>';
    echo '<li class="">Sushi sendo preparado </li>';
    echo '<li class="">Sushi pronto! </li>';
    echo '<li class="">Em entrega! </li>';
    echo '<li class="">Entregue </li>';
    
  echo    '</ul>';
echo '</div>';
  }
           
           

 
       



 echo '   </div>';
 echo '   <div class="modal-footer">';
 echo '     <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable" onclick="$(\'#modalCostumers\').closeModal();">OK!</a>';
 echo '   </div>';


			 }
?>
