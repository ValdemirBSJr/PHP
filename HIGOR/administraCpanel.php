<?php
      session_start();
          if(!isset($_SESSION['NAMEADM'] ))
             {
              header("Location: administra.php"); //redirect page
              
             }
             
             else
             {
              $client = $_SESSION['NAMEADM'];
             
              
              }
			  
                       
              
             ?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
      
      <script   src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
       <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
       <script type="text/javascript" src="js/jquery.mask.min.js"></script>
       <script type="text/javascript" src="js/jquery.maskMoney.js"></script>
      <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
      
      <link rel="shortcut icon" href="img/favicon.ico"type="image/x-icon"/>

<link rel="stylesheet" href="css/magnific-popup.css">
<script src="js/jquery.magnific-popup.min.js"></script>

      <script type="text/javascript" async src="js/jss.js"></script>
	  <script type="text/javascript"  src="js/monitor.js"></script>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
      
    </head>
    

    <body>
      
      <!-- HEAD -->
          <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo">&nbspViciados em Sushi - ADMINISTRA</a>
      </div>
    </nav>
  </div>
      
      <!--END FIXED BAR -->        
    
      
        
        <!-- BODY -->
      
      <div class="page-content" id="cartPage">
     
     <div class="row">
     <div class="col m12 s12">
     
     
     <div id="resultLogin"></div>
	 <div id="audioum"></div>
     
     
    <div class="row"><!--BEGIN CONTAINER LOGIN-->
              
             <div class="conteiner">      
            <div class="card-panel grey lighten-1 col  s3 offset-s9">
                  
                  <h5 align="center"><i class="material-icons left">settings_applications</i>Config. Loja</h5><br>            
                 
				 
				 
				 <div class="row">
    <form id="formLogin" class="col s12">
      <div class="row">
        
		<p>Adm Logado: <?php echo $client; ?></p>
		
		<?php
		
		try {
      
      $abre = 1;
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM abreloja WHERE abreLojaStatus = :status");
 
    $stmt -> bindValue(':status', $abre);
	
    // Executa query
    $stmt->execute();
 
    
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
		//$openMarket = "Loja Aberta!";
		
	echo	'<div class="switch">
    <label>
      Fechar Loja
      <input type="checkbox" checked="checked" id="abreFecha">
      <span class="lever"></span>
      Abrir Loja
    </label>
  </div>';
		
			

    }
		
	if ($stmt -> rowCount() < 1)
	{
		 //$openMarket = "Loja Fechada!";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
       // header("Location: marketClosed.php"); //redirect page
	   
	   echo	'<div class="switch">
    <label>
      Fechar Loja
      <input type="checkbox" id="abreFecha">
      <span class="lever"></span>
      Abrir Loja
    </label>
  </div>';
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
		
		?>
		
		
       
      
    </form>
	<div id="resultMarket"></div>
	
  </div>
		
		         <a href="cadastroAdm.php" target="_blank">Cadastrar cliente</a><br>
		        <a href="#!" onclick="$('#returnClientModal').openModal();">Buscar Cliente</a><br>
				<a href="encerrar.php">Encerrar cliente</a><br>
				<a href="relatorios.php" target="_blank">Relatorio</a><br>
				<a href="#" class="logout"><i class="material-icons left">settings_power</i>Sair</a>          
            </div>
      </div>
			
			  </div><!--END CONTAINER LOGIN-->
			  
			  
			<div class="card-panel grey lighten-3 s8  m4"><!--BEGIN CONTAINER INFO-->
				  
				  
				<h4 align="center">CENTRAL DE ENTREGAS</h4>
				  <br><br>
				  <?php
				  try {
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmtPedidosGeral = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status < :status");
 
    $stmtPedidosGeral -> bindValue(':status', 4);
    // Executa query
   $stmtPedidosGeral->execute();
   
   $contaLinhas = $stmtPedidosGeral -> rowCount();
   
   
   $stmtRealizados = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status = :status");
 
    $stmtRealizados -> bindValue(':status', 0);
    // Executa query
   $stmtRealizados->execute();
   
   $contaLinhasRea = $stmtRealizados -> rowCount();
   
   
   
   $stmtPreparando = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status = :status");
 
    $stmtPreparando -> bindValue(':status', 1);
    // Executa query
   $stmtPreparando->execute();
   
   $contaLinhasPreparando = $stmtPreparando -> rowCount();
   
   
    $stmtEntrega = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status = :status");
 
    $stmtEntrega -> bindValue(':status', 3);
    // Executa query
   $stmtEntrega->execute();
   
   $contaLinhasEntrega = $stmtEntrega -> rowCount();
 
    
	$stmtPronto = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status = :status");
 
    $stmtPronto -> bindValue(':status', 2);
    // Executa query
   $stmtPronto->execute();
   
   $contaLinhasPronto = $stmtPronto -> rowCount();
	
		
	if ($stmtPedidosGeral -> rowCount() > 1)
	{
		//echo "<b>ERRO: Voc&ecirc n&atildeo tem cadastro ou permissao para estar nesta pagina! Realize o seu cadastro ou tente novamente!</b><br>";
		echo "<h5> Total de pedidos: <span id='totalPedidosPendentes' class='red-text text-darken-2'>".$contaLinhas."</span> | Pedidos realizados: <span class='green-text text-darken-2'>".$contaLinhasRea."</span> | Preparando: <span class='blue-text text-darken-2'>".$contaLinhasPreparando."</span> | Prontos: <span class='brow-text text-darken-2'>".$contaLinhasPronto."</span> | Entregas: <span class='orange-text text-darken-4'>".$contaLinhasEntrega."</span></h5> ";
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
				  
				  ?>
	            <div class="divider"></div>
				<br>
				
				<?php
	  
	  echo '<table class="highlight">';
        echo '<thead>';
          echo '<tr>';
              echo '<th data-field="pedido">ID do pedido</th>';
              echo '<th data-field="cliente">Dados do Cliente</th>';
			  echo '<th data-field="pedidoResumo">Resumo do pedido</th>';
			  echo '<th data-field="total">Total</th>';
			  echo '<th data-field="pag">Tipo Pagamento</th>';
			  echo '<th data-field="entregador">Tempo de entrega</th>';
			  echo '<th data-field="status">Status</th>';
			  echo '<th data-field="atualizar">Atualizar</th>';
          echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
		
		
		try {
			
			
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$pdo-> beginTransaction();
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM pedidos WHERE pedidos_Status < :status");
    $stmt -> bindValue(':status', 4);
    
    // Executa query
    $stmt->execute();
 
    
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	  
	  
	  echo '<tr id="linha'.$obj[0].'">';
	  
	  echo '<td id="'.$obj[0].'">'.$obj[0].'</td>';
	
		//############################################################################3
		
		
		 $stmt2 = $pdo->prepare("SELECT * FROM clientes WHERE clientes_ID = :idCli");
		
		$stmt2 -> bindValue(':idCli', $obj[1]);
		
		
		// Executa query
		$stmt2->execute();
		
		while ($obj2 = $stmt2-> fetch (PDO::FETCH_NUM))
		{
		
		echo '<td id="'.$obj2[0].'"><p>Nome: '.utf8_decode($obj2[1]).'</p>';
		 echo '<p>Endere&ccedilo: '.utf8_decode($obj2[5]).', Nº '.$obj2[6].'.</p>';
		  echo '<p>Compl.: '.utf8_decode($obj2[8]).'.</p>';
		 echo '<p>Telefones: '.number_mask($obj2[3], '(##)#####-####').' / '.number_mask($obj2[4], '(##)#####-####').'</p></td>';
			
		}
		
		echo "<td>";
		     echo '<p>Qtde.: '.$obj[4].'.</p>';
			 echo '<p>Pedidos.: '.$obj[6].'.</p>';
			 
			 if ($obj[11] != 0.00)
			 {
				 echo '<p>Entrega R$ '.number_format($obj[11], 2, ',', '.').'.</p>'; 
			 }
			 
			  if ($obj[12] != 0.00)
			 {
				 echo '<p>Troco pedido R$ '.number_format($obj[12], 2, ',', '.').'.</p>';
				 
				 echo '<p>Devolver ao cliente: R$ '.number_format($obj[12] - $obj[7], 2, ',', '.').'.</p>';
			 }
		
		echo "</td>";
		
		echo '<td>R$  '.number_format($obj[7], 2, ',', '.').'.</td>';
		
		if ($obj[3] == 0)
		{
			echo '<td>Em dinheiro</td>';
		}
		if ($obj[3] == 1)
		{
			echo '<td>Maquineta</td>';
		}
		
		echo "<td><input type='text' value='".preg_replace("/[^0-9]/", "",$obj[10])."' id='time".$obj[0]."'></td>";
		
		
		
		if ($obj[9] == 0)
		{
			echo '<td><select class="browser-default" id="StatusPedido'.$obj[0].'">';
		 
	echo '	 
		
    <option value="" disabled>Escolha 1 opcao</option>
    <option value="0" selected>Pedido Realizado</option>
    <option value="1">Preparando Sushi</option>
    <option value="2">Sushi pronto</option>
	<option value="3">Em entrega</option>
	<option value="4">Entregue</option>
	<option value="5">Cancelado</option>';
  
  
		}
		if ($obj[9] == 1)
		{
			echo '<td><select class="browser-default" id="StatusPedido'.$obj[0].'">';
		 
	echo '	 
		
    <option value="" disabled>Escolha 1 opcao</option>
    <option value="0" >Pedido Realizado</option>
    <option value="1" selected>Preparando Sushi</option>
    <option value="2">Sushi pronto</option>
	<option value="3">Em entrega</option>
	<option value="4">Entregue</option>
	<option value="5">Cancelado</option>';
  
  
		}
		if ($obj[9] == 2)
		{
			echo '<td><select class="browser-default" id="StatusPedido'.$obj[0].'">';
		 
	echo '	 
		
    <option value="" disabled>Escolha 1 opcao</option>
    <option value="0" >Pedido Realizado</option>
    <option value="1">Preparando Sushi</option>
    <option value="2" selected>Sushi pronto</option>
	<option value="3">Em entrega</option>
	<option value="4">Entregue</option>
	<option value="5">Cancelado</option>';
  
  
		}
			if ($obj[9] == 3)
		{
			echo '<td><select class="browser-default" id="StatusPedido'.$obj[0].'">';
		 
	echo '	 
		
    <option value="" disabled>Escolha 1 opcao</option>
    <option value="0" >Pedido Realizado</option>
    <option value="1">Preparando Sushi</option>
    <option value="2">Sushi pronto</option>
	<option value="3" selected>Em entrega</option>
	<option value="4">Entregue</option>
	<option value="5">Cancelado</option>';
  
  
		}
		
		echo "</select></td>";
		
		//echo '<td><button  class="btn" id="'.$obj[0].'">ATUALIZAR</button></td>';
		
		echo '<td><a class="btn-floating btn-large waves-effect waves-light green" id="'.$obj[0].'"><i class="material-icons">replay</i></a></td>';

    }
	echo "</td>";
		
	if ($stmt -> rowCount() < 1)
	{
		echo "<b>ERRO: Nao foi possivel realizar a consulta! Contato o desenvolvedor.</b><br>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
		
	}
	
	
	$pdo ->commit();
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
	
	$pdo -> rollback();
    echo $e->getMessage ();
}
		
		
		
		
		
		
		
		//FUNÇÃO MASK
		
		
		
		function number_mask( $value , $mask ){
    $value = preg_replace( '/[^\d]+/' , '' , $value );

    if ( $mask === '#' ) return $value;
    else {
        for ( $i = 0 , $j = 0 , $t = strlen( $mask ) , $fi = $fo = null ; $i < $t ; $i++ ){
            if ( ( $mask{ $i } !== '#' ) && $j ){
                $fi  = sprintf( '%s%%%dd' , $fi , $j );
                $fo = sprintf( '%s%%0%dd%s' , $fo , $j , $mask{ $i } );
                $j = 0;
            } elseif ( $mask{ $i } == '#' ) ++$j;
            else $fo .= $mask{ $i };
        }

        if ( $j ){
            $fi = sprintf( '%s%%%dd' , $fi , $j );
            $fo = sprintf( '%s%%0%dd' , $fo , $j );
        }

        return vsprintf( $fo , sscanf( $value , $fi ) );
    }
}
		?>
				  
				  </div><!--END CONTAINER INFO-->
			  
     
      
      </div><!--END OF COL-->
      </div><!--END OF ROW-->
      </div><!--END OF BODY -->
      
     
       <!-- Modal Structure -->
  <div id="ifnotvalidate" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao atualizar senha!</h4>
      <p align="center">Voc&ecirc deve preencher todos os campos do cadastro e os campos de senha devem conter valores digitados iguais!</p>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">OK!</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->
	  
	  <!-- Modal Structure -->
  <div id="returnClientModal" class="modal">
    <div class="modal-content">
      <h4>Consulta de Clientes</h4>
      <p>Digite o n&uacutemero do cliente:</p>
      <div class="input-field col s4">
        
        
          <input name="clienteConsulta" id="clienteConsulta" type="text">
          <label for="clienteConsulta">N&UacuteMERO TELEF&OcircNICO</label>
        
        </div>
      <button  class="btn" id="searchClient"><i class="material-icons right">search</i>BUSCAR</button>
      
        
      <div id="resultClient">  </div><!--NEssa div vai o resultado da consulta-->
      
    </div>
    <div class="modal-footer">
	  <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable" id="confirmClient">OK!</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">SAIR</a>
    </div>
  </div>
      
      <!--Import jQuery before materialize.js-->
      
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
      
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>