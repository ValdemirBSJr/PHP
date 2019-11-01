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
     
     
    <div class="row"><!--BEGIN CONTAINER LOGIN-->
              
             <div class="conteiner">      
            <div class="card-panel grey lighten-1 col  s4 offset-s4">
                  
                  <h4 align="center"><i class="material-icons left">person_pin</i>Realizar login como Administrador</h4><br>            
                 
				 
				 
				 <div class="row">
    <form id="formLogin" class="col s12">
      <div class="row">
        
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_contact_calendar</i>
          <input id="adminLogin" type="text" class="validate">
          <label for="adminLogin">Login</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input id="senhaLogin" type="password" class="validate">
          <label for="senhaLogin">Senha</label>
        </div>
		
      </div>
	  
	  <a href="#!" id="loginAdmin" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Login</a>
      
    </form>
  </div>
		
		
				          
            </div>
      </div>
			  </div><!--END CONTAINER LOGIN-->
     
      
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