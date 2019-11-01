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
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
      
    </head>
    

    <body>
      
      <!-- HEAD -->
          <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo">&nbspViciados em Sushi - ADMINISTRA - RELAT&OacuteRIOS</a>
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
				<a href="#!">Relatorio</a><br>
				<a href="#" class="logout"><i class="material-icons left">settings_power</i>Sair</a>          
            </div>
      </div>
			
			  </div><!--END CONTAINER LOGIN-->
			  
			  
			<div class="card-panel grey lighten-3 s8  m4"><!--BEGIN CONTAINER INFO-->
				  
				  
				<h4 align="center">RELAT&OacuteRIOS</h4>
				  <br><br>
				  
				  
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