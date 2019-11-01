<?php
      session_cache_expire(15); //tempo da session é 15 minutos
	  session_start();
          if(!isset($_SESSION['NAMECLI'] ))
             {
              header("Location: index.php"); //redirect page
              
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
	
		$openMarket = "Loja Aberta!";
		
			

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
    

    <body onload="$('html, body').animate({ scrollTop: $('#rolling').offset().top }, 600);">
      
      <!-- HEAD -->
        <div class="navbar-fixed">
      
   
 <ul id="dropdown1" class="dropdown-content">
  <li><a href="#" onclick="$('#modalUser').openModal();"><i class="material-icons left">perm_identity</i>Login</a></li>
  <li><a <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'href="cadastro.php"';} else { echo 'onclick="$(\'#iflog\').openModal();"'; } ?> id="cad"><i class="material-icons left">subtitles</i>Cadastre-se</a></li>
  <li><a <?php if(isset($_SESSION['NAMECLI'] )){ echo 'href="Atualizarcadastro.php"';} else { echo 'onclick="$(\'#ifnotlog\').openModal();"'; } ?> id="cadSign"><i class="material-icons left">assignment_ind</i>Atualizar cadastro</a></li>
  <li><a  href="#" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'id="basket"'; } ?>><i class="material-icons left">shopping_basket</i>Pedidos<span id="basketdrop" class="badge transparent"></span></a></li>
  <li class="divider"></li>
  <li><a href="#" class="logout"><i class="material-icons left">settings_power</i>Sair</a></li>
</ul>
  <nav>
    <div class="nav-wrapper black">
      <a href="index.php" class="brand-logo">&nbspViciados em Sushi</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#" class="dropdown-button" data-activates="dropdown1"><i class="material-icons left">perm_identity</i><span id="loginResultName"><?php echo $client?></span><i class="material-icons right">arrow_drop_down</i><span class="loading"><img src="img/loading.GIF"/></span></a></li>
        <li><a id="cart" <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'onclick="$(\'#ifnotlog\').openModal();"';} else { echo 'href="carrinho.php"'; } ?>><i class="material-icons left">shopping_cart</i><span id="cartBadge" <?php if((!isset($_SESSION['CARRINHO'] ) || empty($_SESSION['CARRINHO']))){ echo 'class="badge transparent hide">0</span></a></li>';} else { echo 'class="new badge red darken-1">'.count($_SESSION['CARRINHO']).'</span></a></li>'; } ?>
      </ul>
      <ul class="side-nav" id="mobile-demo"><!-- lateral sidenav-->
         <li><a href="#" onclick="$('#modalUser').openModal();"><i class="material-icons left">perm_identity</i><span id="loginResultNave"><?php echo $client ?></span></a></li>
        <li><a <?php if(!isset($_SESSION['NAMECLI'] )){ echo 'href="cadastro.php"';} else { echo 'onclick="$(\'#iflog\').openModal();"'; } ?> id="cadSidenav"><i class="material-icons left">subtitles</i>Cadastre-se</a></li>
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
      
      if(isset($_SESSION['NAMECLI']))
             {
                  echo "<INPUT type='hidden' id='resultName' value='".$_SESSION['NAMECLI']."'>";
      
             }
             
             
      if((!isset($_SESSION['CARRINHO'] ) || empty($_SESSION['CARRINHO'])))
      {
echo "
      <div class='col s12 m12'>
        <div class='card-panel teal'>
          <h5 align='center'><span class='white-text'>Desculpe, ".$_SESSION['NAMECLI'].". Seu carrinho est&aacute vazio!
          </span><a class='waves-effect waves-light red darken-2 btn' href='index.php' id='rolling'>Click para escolher os sushis!</a></h5>
        </div>
        </div>";
        
      }
      else
      {
            
            $clienteId	= $_SESSION['IDCLI'];
            $clienteNome =  $_SESSION['NAMECLI'];
            $clienteSobrenome = $_SESSION['CLISOBRENOME'];
            $clienteTelefone1 = $_SESSION['TEL1'];
            $clienteTelefone2 = $_SESSION['TEL2'];
            $clienteEndereco   =   $_SESSION['ENDCLI'];
            $clienteNumeroEndereco = $_SESSION['ENDNUMCLI'];
            $clienteEmail = $_SESSION['EMAILCLI'];
            $clienteReferencia   =   $_SESSION['COMPLENDCLI'];    
            $clienteDataCadastro   =   $_SESSION['DATACADCLI'];
            $clienteDistanciaEntrega =  $_SESSION['DISTANCIAENTREGACLI'];
            $clienteTempoEntrega = $_SESSION['TEMPOENTREGACLI'];
            $clienteEndGoogle = $_SESSION['ENDGOOGLECLI'];
            
            $freteBruto = preg_replace("/[^0-9\,]/", "", $clienteDistanciaEntrega);
            //$freteFloat = number_format($freteBruto, 2, ',', '.');
            $freteFloat = str_replace(',', '.', $freteBruto);
            
            if ($freteFloat > 2)
            {
                  $frete = 5.00;
            }
            else {
                  $frete = 0;
            }
            
            
      echo '<h4 align="left">&nbsp'.$clienteNome.', segue abaixo seus pedidos.</h4><br>';
      echo '<a class="waves-effect waves-light red darken-2 btn" href="index.php" id="rolling"><i class="material-icons right">replay</i>Voltar a comprar!</a><br><br>';
	  echo '<div class="divider"></div>';
	  
	  echo '<table class="responsive-table">';
        echo '<thead>';
          echo '<tr>';
              echo '<th data-field="pedido">C&oacute. Ped.</th>';
              echo '<th data-field="tamanho">Quantidade</th>';
              echo '<th data-field="unitario">Valor unit&aacuterio</th>';
			  echo '<th data-field="total">Total</th>';
			  echo '<th data-field="pagamento">Descri&ccedil&atildeo do pedido</th>';
			  echo '<th data-field="excluir">Excluir o pedido do carrinho</th>';
          echo '</tr';
        echo '</thead>';

        echo '<tbody>';
            
            $somatotalPedido = 0;
            
            foreach ($_SESSION['CARRINHO'] as $rotulo => $informacao)
                  {
                        echo '<tr id="line'.$rotulo.'">';
		  
                              //echo $rotulo."=>".$informacao."<br>";
                              $retornaArray = explode(";", $_SESSION['CARRINHO'][$rotulo]); //recebe a array com os valores do carrinho
                              
                              $somatotalPedido = $somatotalPedido + ($retornaArray[1] * $retornaArray[2]);
                              
                              echo '<td id="codCart'.$retornaArray[0].'">'.$retornaArray[0].'</td>';	
                              echo '<td id="qtdeCart'.$retornaArray[0].'">'.$retornaArray[1].'</td>';
                              echo '<td>R$ '.number_format($retornaArray[2], 2, ',', '.').'</td>';
                              echo '<td>R$ <span id="coin'.$rotulo.'" name="'.$retornaArray[0].'">'.number_format($retornaArray[3], 2, ',', '.').'</span></td><div id="resultado'.$retornaArray[0].'" ></div>';
                              echo '<td>'.$retornaArray[4].'</td>';
                              echo '<td><button  class="btn modal-trigger" id="'.$rotulo.'">Excluir</button></td>';
                              echo '</tr>';
                  }
                  
                  if ($frete == 5.00)
                  {
                       $somatotalPedido  = $somatotalPedido + $frete;
                  }
                  
                   echo '</tbody>';
      echo '</table>';
                  
                  echo '<div class="divider"></div>';
                  
                   echo '<h4>TOTAL GERAL: R$ <span id="totalGeral">'.number_format($somatotalPedido, 2, ',', '.').'</span></h4>';
                   echo '<h5>FRETE COBRADO: R$ <span id="freteCarrinho">'.number_format($frete, 2, ',', '.').'</span></h5>';
                   
                   echo '<a href="#!" id="cartFinish" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Finalizar o pedido!</a><br><br>';
                   
                   echo '<div class="divider"></div>';
                   

                  
                  
      }
             
             
             ?>
      </div><!--END OF COL-->
      </div><!--END OF ROW-->
      </div><!--END OF BODY -->
      
      <div class="page-content" id="cartPayment"><!--BEGIN SECOND PAGE CONTENT-->
	  
	  
      
      <div class="row">
     <div class="col m12 s12">
            
      <div class="fixed-action-btn" style="bottom: 300px; left: 24px;">
            <a class="btn-floating btn-large" id="returnCart">
            <span class="tooltipped" data-position="top" data-delay="40" data-tooltip="Retornar para o carrinho!"><i class="large material-icons">skip_previous</i></span>
            </a>
            <ul>
            </ul>
      </div>
      
            
            <h4 align="center">&nbspSelecione abaixo a forma de pagamento</h4><br><br>
			
            
            <div class="row">
              
             <div class="conteiner">      
            <div class="card-panel grey lighten-1 col  s3 offset-s1">
                  
                  <h4 align="center"><i class="material-icons left">attach_money</i>Pague 	&agrave vista</h4><br>
                  
                 <form class="col s12">
                  <div class="col s6">
                   <p class="grey lighten-2">
                        <input type="checkbox" id="queroTroco" class="filled-in"/>
                        <label for="queroTroco">Quero troco</label>
                  </p>
                   </div><br><br>
                   
      <div class="row">
        <div class="input-field col s6" id="divTroco">
          <input  id="troco" type="text" class="validate">
          <label for="troco">Quero troco para:</label>
        </div>
        <div class="input-field col s6">
          <input disabled id="freteAvista" type="text" class="validate" <?php  if (isset($frete)){echo 'value="R$ '.number_format($frete, 2, ',', '.').'"';}else{echo 'value="R$ 0,00"';}?>>
          <label for="freteAvista">Frete Cobrado</label>
        </div>
      </div>
                 </form>
                  <?php
                        
                  if(isset($somatotalPedido)){echo '<h5 align="center">Total: R$ <span id="totalGeralPagamento">'.number_format($somatotalPedido, 2, ',', '.').'</span></h5>';}else{echo '<h5 align="center">Total: R$ <span id="totalGeralPagamento">0,00</span></h5>';}
                  ?>
                  <h6 align="center"><a href="#!" id="pagamentoDinheiro" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Pagar com Dinheiro!</a></h6><br>
            
            </div>
            
            
            <div class="card-panel grey lighten-1 col  s3 offset-s1">
                  
                  <h4 align="center"><i class="material-icons left">credit_card</i>Cart&atildeo de cr&eacutedito</h4>
                  <h6 align="center">Nesta modalidade de pagamento, levamos a maquineta e o pagamento &eacute realizado no ato da entrega.</h6>
                  <div class="row">
                        <div class="input-field col s6">
                        <input disabled id="freteMaquineta" type="text" class="validate" <?php  if (isset($frete)){echo 'value="R$ '.number_format($frete, 2, ',', '.').'"';}else{echo 'value="R$ 0,00"';}?>>
                        <label for="freteMaquineta">Frete Cobrado</label>
                  </div>
                  </div>
                  <?php
                  //echo '<h5 align="center">Total: R$ <span id="totalGeralMaquineta">'.number_format($somatotalPedido, 2, ',', '.').'</span></h5>';
                  if(isset($somatotalPedido)){echo '<h5 align="center">Total: R$ <span id="totalGeralMaquineta">'.number_format($somatotalPedido, 2, ',', '.').'</span></h5>';}else{echo '<h5 align="center">Total: R$ <span id="totalGeralMaquineta">0,00</span></h5>';}
                  ?>
                  <h6 align="center"><a href="#!" id="pagamentoMaquineta" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Me traga a maquineta!</a></h6><br>
                  
            </div>
            
            
           <!-- <div class="card-panel grey lighten-1 col  s3 offset-s1">Pague seguro</div> -->
		   <span id="loading2" class="col  s3 offset-s1"><img src="img/loading2.gif"/>Concretizando a compra...</span>
            
             </div>
             
            
            </div>
            
            
            
            
            
            </div>
         </div>   
      </div><!--END SECOND PAGE CONTENT-->
      
      
      <div class="page-content" id="finishPayment"><!--BEGIN THIRD PAGE CONTENT-->
      
      <div class="row">
     <div class="col m12 s12">
            
            <h1 align="center">Pedido realizado com sucesso!</h1>
            <h3 align="center">Acompanhe o status do seu pedido na cesta de pedidos.</h3>
            <br><br>
            
             <div class="col "><a class="waves-effect waves-light red darken-2 btn" href="#!" onclick="$('#modalCostumers').openModal();">VER A CESTA DE PEDIDOS</a></div>
             <div class="col s6"><a class="waves-effect waves-light red darken-2 btn" href="index.php">VOLTAR A P&AacuteGINA PRINCIPAL</a></div>
      
            </div>
         </div>   
      </div><!--END THIRD PAGE CONTENT-->
      
      
        <!--MODELS They should stay out of div-->
       
       
   <!-- Modal Structure -->
  <div id="ifnotlog" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao acessar item</h4>
      <p align="center">Voc&ecirc deve estar logado primeiro para acessar esta parte do site!</p>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red accent-1 hoverable">OK!</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->
      
        <!-- Modal user  -->


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
      
      <!--Import jQuery before materialize.js-->
      
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
      
      <script type="text/javascript" src="js/materialize.js"></script>
    </body>
  </html>