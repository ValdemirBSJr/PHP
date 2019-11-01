<?php
session_cache_expire(15); //tempo da session é 15 minutos
session_start();
          if(!isset($_SESSION['NAMECLI'] ))
             {
              $client = "Login/Cadastro";
             }
             
             else
             {
              $client = "Ol&aacute, ".$_SESSION['NAMECLI']."!";
              
              }
              

try {
      
      $abre = 1;
	
	$DB_Host= "mysql.hostinger.com.br"; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "u662939396_vicia";
	$DB_User = "u662939396_us3rr";
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
		
			

    }
		
	if ($stmt -> rowCount() < 1)
	{
		 //$openMarket = "Loja Fechada!";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
        header("Location: marketClosed.php"); //redirect page
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}

                   
             ?>

<!DOCTYPE html>
  <html>
    <head>
	 <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	 
	 <base href="http://viciadosemsushi.com.br/"/><!--SERVE PARA URL AMIGAVEL PARA MANTER O CAMINHO RELATIVO DO CSS E JS-->
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
     
      
      <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      
      <script type="text/javascript" src="js/jquery.mask.min.js"/></script>
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
      
   
 <ul id="dropdown1" class="dropdown-content">
  <li><a href="#" onclick="$('#modalUser').openModal();"><i class="material-icons left">perm_identity</i>Login</a></li>
  <li><a <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'href="/cadastro"';} else { echo 'onclick="$(\'#iflog\').openModal();"'; } ?> id="cad"><i class="material-icons left">subtitles</i>Cadastre-se</a></li>
  <li><a <?php if(isset($_SESSION['NAMECLI'] )){ echo 'href="Atualizarcadastro.php"';} else { echo 'onclick="$(\'#ifnotlog\').openModal();"'; } ?> id="cadSign"><i class="material-icons left">assignment_ind</i>Atualizar cadastro</a></li>
  <li><a  href="#" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'id="basket"'; } ?>><i class="material-icons left">shopping_basket</i>Pedidos<span id="basketdrop" class="badge transparent"></span></a></li>
  <li class="divider"></li>
  <li><a href="#" class="logout"><i class="material-icons left">settings_power</i>Sair</a></li>
</ul>
  <nav>
    <div class="nav-wrapper black">
      <a href="/index" class="brand-logo">&nbspViciados em Sushi</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#" class="dropdown-button" data-activates="dropdown1"><i class="material-icons left">perm_identity</i><span id="loginResultName"><?php echo $client?></span><i class="material-icons right">arrow_drop_down</i><span class="loading"><img src="img/loading.GIF"/></span></a></li>
        <li><a id="cart" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'href="carrinho.php"'; } ?>><i class="material-icons left">shopping_cart</i><span id="cartBadge" <?php if((!isset($_SESSION['CARRINHO'] ) || empty($_SESSION['CARRINHO']))){ echo 'class="badge transparent hide">0</span></a></li>';} else { echo 'class="new badge red darken-1">'.count($_SESSION['CARRINHO']).'</span></a></li>'; } ?>
      </ul>
      <ul class="side-nav" id="mobile-demo"><!-- lateral sidenav-->
         <li><a href="#" onclick="$('#modalUser').openModal();"><i class="material-icons left">perm_identity</i><span id="loginResultNave"><?php echo $client ?></span></a></li>
        <li><a <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'href="/cadastro"';} else { echo 'onclick="$(\'#iflog\').openModal();"'; } ?> id="cadSidenav"><i class="material-icons left">subtitles</i>Cadastre-se</a></li>
        <li><a <?php if(isset($_SESSION['NAMECLI'] )){ echo 'href="Atualizarcadastro.php"';} else { echo 'onclick="$(\'#ifnotlog\').openModal();"'; } ?> id="cadSign"><i class="material-icons left">assignment_ind</i>Atualizar cadastro</a></li>
        <li><a id="cartSidenav" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'href="carrinho.php"'; } ?>><i class="material-icons left">shopping_cart</i><span id="cartSidenavBadge" <?php if((!isset($_SESSION['CARRINHO'] ) || empty($_SESSION['CARRINHO']))){ echo 'class="badge transparent"></span></a></li>';} else { echo 'class="new badge red darken-1">'.count($_SESSION['CARRINHO']).'</span></a></li>'; } ?>
        <li><a href="#"  href="#" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'id="basketSidenav"'; } ?>><i class="material-icons left">shopping_basket</i>Pedidos<span id="basketSidenav" class="badge transparent"></span></a></li>
        <li class="divider"></li>
        <li><a href="#" class="logout"><i class="material-icons left">settings_power</i>Sair</a></li>
        
      </ul>
    </div>
  </nav>
      
      </div><!--END FIXED BAR -->     
    
      <!-- BANNER -->

       <div class="slider">
    <ul class="slides">
      <li>
        <img src="img/Site_banner_1.jpg"> <!-- random image -->
        <div class="caption right-align">
          
        </div>
      </li>
      <li>
        <img src="img/Site_banner_3.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3>Sushi feitos na hora por quem entende do assunto!</h3>
        </div>
      </li>
      <li>
        <img src="img/Site_banner_4.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3>Pe&ccedila seu sushi de forma simples e rápida que entregamos a domic&iacutelio!</h3>
          <h5 class="light red-text text-darken-3">Viciados em sushi</h5>
        </div>
      </li>
      <li>
        <img src="img/Site_banner_5.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3>Prove dos nossos combos pensados para propiciar a melhor experi&ecircncia!</h3>
          <h5 class="light grey-text text-lighten-3">Viciados em sushi</h5>
        </div>
      </li>
    </ul>
  </div><br>
        
        <!-- END BANNER -->
        
        <!-- HEAD-END ;D -->
        
        <!-- BODY -->
      
      
      <div class="page-content">
      <div class="row">
     
     
     <?php
     
     try {
      
	
	$DB_Host= "mysql.hostinger.com.br"; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "u662939396_vicia";
	$DB_User = "u662939396_us3rr";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM sushis WHERE sushi_Ativo = :ativo");
    $stmt -> bindValue(':ativo',"1");

    // Executa query
    $stmt->execute();
 
    // lembra do mysql_fetch_array?
    //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
    //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
    //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
    
	//$obj = $stmt -> fetch (PDO::FETCH_NUM);
	//abaixo temos dois jeitos de recuperar, pelo indice da coluna e pelo nome do campo como um objeto
    
     

	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	 
	  if ($obj[6] != "-")
	   {
		
		$retornaArray = explode(";", $obj[6]);
		
		$escolha = 
		
	'<select class="browser-default" id="StatusSelect'.$obj[0].'">	
    <option value="noSelect" disabled selected>Escolha 1 sabor/tipo</option>';
	
	 foreach ($retornaArray as $rotulo => $informacao)
	 {
                  
    $escolha .= '<option value="'.$rotulo.'">'.$informacao.'</option>';
   
	
	}
	$escolha .= '</select>';
	   }
	   else
	   {
		$escolha = "";
	   }
	
    echo '<div class="col s12  m4">';
   echo '<div class="card">';
    
   	echo '
    
      <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <a class="imgPop" href="img/'.$obj[4].'"><img  src="img/'.$obj[4].'"></a>
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4" id="title'.$obj[0].'">'.$obj[1].'</span>
      <p><a href="#!" class="activator">Realizar pedido</a></p><!--A classe activator é que faz o efeito de revelar o card -->
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">'.$obj[1].'<i class="material-icons right">close</i></span>
       <h5>'.$obj[2].'</h5>
       
       <div class="section">
       <div class="card-panel grey lighten-3 z-depth-1">
       <form action="#">
	    '.$escolha.'
       <h6 align="center">Selecione abaixo a quantidade</h6>
      <p class="range-field">
      <input class="hoverable" type="range" id="range'.$obj[0].'" min="1" max="30" value="1"/>
      <h6 align="center">Pre&ccedilo Total: R&#36 <span id="coin'.$obj[0].'" name="'.$obj[3].'">'.number_format($obj[3], 2, ',', '.').'</span></h6>
       </form>
      </p>
      <h6 align="center"><button id="'.$obj[0].'" class="btn waves-effect waves-light red darken-2 hoverable" name="action">Adicionar ao carrinho</button></h6>
      </p>
      </div>
      </div>';
      
    
      
   echo '   
    </div>
  </div>
    ';
    
    
    echo '</div>';
   echo '</div>';
   
   echo '<div id="resultado'.$obj[0].'" class="hide"></div>';

    }
   

		
	if ($stmt -> rowCount() < 1)
	{
		echo "<b>OoOps! Estamos com problemas no momento. Que tal tentar mais tarde!</b><br>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IPecho $name;
	}
	
	
    
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
     
   if  (isset($_SESSION['NAMECLI'] ))
   {
      echo '<INPUT type="hidden" id="resultName" value="'.$_SESSION['NAMECLI'].'">';
   }
     ?>
     
     <div id="resultLogin"></div>
     
    <div id="sushis" class="hide">0</div>
    
    
     
     <!-- SOCIAL BUTTON -->
      <div class="fixed-action-btn horizontal" style="bottom: 139px; right: 24px;">
    <a class="btn-floating btn-large red">
      <span class="tooltipped" data-position="top" data-delay="40" data-tooltip="Siga o viciados em sushi!"><img src="img/connection28.png"/></span>
    </a>
    <ul>
      <li><a href="mailto:contato@viciadosemsushi.com.br" class="btn-floating red"><img src="img/mail59.png"/></a></li>
      <li><a href="https://www.instagram.com/viciadosemsushidelivery/" target="_blank" class="btn-floating yellow darken-4"><img src="img/instagram12.png"/></a></li>
      <!-- <li><a class="btn-floating green" onclick="$('#modalzap').openModal();"><img src="img/whatsapp.png"/></a></li> -->
      <li><a href="https://www.facebook.com/Viciados-em-Sushi-717507661682145/?fref=ts" target="_blank" class="btn-floating  indigo darken-1"><img src="img/facebook29.png"/></a></li>

    </ul>
  </div>
      <!-- END SOCIAL BUTTON -->
      
      </div><!--END OF ROW -->
      </div><!--END OF BODY -->
    
      
        <!--MODELS They should stay out of div-->
       
       
   <!-- Modal Structure -->
  <div id="ifnotlog" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao acessar item</h4>
      <p align="center">Voc&ecirc deve estar logado primeiro para acessar esta parte do site!</p>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">OK!</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->
      
         <!-- Modal Structure -->
  <div id="iflog" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao acessar item</h4>
      <p align="center">Voc&ecirc est&aacute logado como <span class="returnClientName"></span>.</p>
       <p align="center"><a  href="#" class="logout">N&atildeo sou <span class="returnClientName"></span>!</a></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">OK!</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->


  <!-- Modal Structure -->
  <div id="modalUser" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4 id="titleLogin">Login de usu&aacuterios</h4>
      <p id="exampleLogin">Logue para continuar</p>
      
    
    <div class="row">
    <form id="formLogin" class="col s12">
      <div class="row">
        
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="emailLogin" type="email" class="validate">
          <label for="emailLogin">E-mail</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input id="senhaLogin" type="password" class="validate">
          <label for="senhaLogin">Senha</label>
        </div>
        
      </div>
      
    </form>
  </div>
    
    
    <div class="row">
    <form id="formForgotPass" class="col s12 hide">
      <div class="row">
        
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="emailForgotPass" type="email" class="validate">
          <label for="emailForgotPass">E-mail</label>
        </div>
        <div class="input-field col s12">
		 <span  id="loading2"><img src="img/loading2.gif"/>Enviando...</span>
          
          <a href="#!" id="returnPass" class="waves-effect waves-teal btn-flat hoverable">Retornar ao login</a>
          
        </div>
        
      </div>
      
    </form>
  </div>
    
       
      <a href="#!" id="lostPass" class="waves-effect waves-teal btn-flat hoverable">Esqueci a senha</a>
      
      <div id="resultRequestPass"></div>
      
    </div>
    
    <div class="modal-footer">
      <a href="#!" id="loginCli" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Login</a>
      <a href="#!" id="recoverPass" class="waves-effect waves-light red darken-2 btn hide">Recuperar a senha</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
    </div>
  </div>
      <!--End modal-->
      

  <!-- Modal order of customers -->
  <div id="modalCostumers" class="modal bottom-sheet">
   
     
  </div>
      <!--End modal-->
      
      <!--Import jQuery before materialize.js-->
      
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
      
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>