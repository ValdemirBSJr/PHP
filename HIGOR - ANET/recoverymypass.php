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
        <a href="index.php" class="brand-logo">&nbspViciados em Sushi - Ir para p&aacutegina principal</a>
      </div>
    </nav>
  </div>
      
      <!--END FIXED BAR -->        
    
      <!-- BANNER --> 
    
      
       
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              
              <img src="img/Site_banner_1.jpg">
              
            </div>
          </div>
        </div>
        
        <!-- HEAD-END ;D -->
        
        <!-- BODY -->
      
      <div class="page-content" id="cartPage">
     
     <div class="row">
     <div class="col m12 s12">
     
     
     <div id="resultLogin"></div>
     
     
    
     
     
      <?php
      
      if (!isset($_GET['token']) || !isset($_GET['code']))
      {
        echo    "<h4 class='red-text'> Ooops, voc&ecirc n&atildeo tem um c&oacutedigo v&aacutelido para recuperação de senha.</h4>";
      
      }
      else
      {
          $nomeDecodificado = base64_decode($_GET['code']);
          $token = $_GET['token'];
          $ativo = 0;
            
            try {
	
	$DB_Host= "mysql.hostinger.com.br"; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "u662939396_vicia";
	$DB_User = "u662939396_us3rr";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM novasenha WHERE novaSenha_CodAut = :token AND novaSenha_Ativo = :ativo");
 
    $stmt -> bindValue(':ativo', $ativo);
	$stmt -> bindValue(':token',$token); 
    // Executa query
    $stmt->execute();
 
    // lembra do mysql_fetch_array?
    //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
    //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
    //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
    
	//$obj = $stmt -> fetch (PDO::FETCH_NUM);
	//abaixo temos dois jeitos de recuperar, pelo indice da coluna e pelo nome do campo como um objeto
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
    
           
           echo "Ol&aacute, ".$nomeDecodificado.". Redefina a sua senha abaixo.<br>";
           
           //echo $_GET['token'];
           
      echo '     
            <div class="row" id="resultConfPass">
    <form id="formContact" class="col s12">
      <div class="row">
        
        
        <div class="input-field col s6">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="Confirme a sua senha com 10 caracteres"><i class="material-icons prefix">lock</i>
          <input id="senha" type="password" class="validate" length="10">
          <label for="senha">Nova senha</label></span>
        </div>
        <div class="input-field col s6">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="Confirme a sua senha com 10 caracteres"><i class="material-icons prefix">lock</i>
          <input id="confSenha" type="password" class="validate" length="10">
          <label for="confSenha">Confirmar nova senha</label></span>
        </div>
        
        </div>
      <a  class="waves-effect waves-light btn red accent-1 hoverable"  id="UserFormButtonAlterPass"><i class="material-icons right">done</i>ATUALIZAR SENHA</a>
    </form>
  </div>';
  
  echo "<span id='token' class='hide'>".$token."</span>";
  echo "<span id='code' class='hide'>".$nomeDecodificado."</span>";

    }
		
	if ($stmt -> rowCount() < 1)
	{
		echo    "<h4 class='red-text'> Ooops, voc&ecirc n&atildeo tem um c&oacutedigo v&aacutelido para recuperação de senha.</h4>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
            
            //################################################
          
          
          
           
           
      }
             
             
             ?>
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
      
      <!--Import jQuery before materialize.js-->
      
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
      
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>