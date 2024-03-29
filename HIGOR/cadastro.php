<?php
      session_start();
          if(!isset($_SESSION['NAMECLI'] ))
             {
              $client = "Login/Cadastro";
             }
             
             else
             {
              $client = "Ol&aacute, ".$_SESSION['NAMECLI']."!";
              }
             ?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      
      
      <link rel="stylesheet" href="css/magnific-popup.css">
<script src="js/jquery.magnific-popup.min.js"></script>
      <script type="text/javascript" src="js/jquery.mask.min.js"></script>
      <script type="text/javascript" src="js/jquery.maskMoney.js"></script>
     <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
      
      <link rel="shortcut icon" href="img/favicon.ico"type="image/x-icon"/>



      <script type="text/javascript" src="js/jss.js"></script>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
    </head>
    

    <body>
      
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
    
      
       
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              
              <img src="img/Site_banner_1.jpg">
              
            </div>
          </div>
        </div>
        
        <!-- HEAD-END ;D -->
        
        <!-- BODY -->
      
      <div class="page-content">
     
     <div id="resultLogin"></div>
      
      <div class="row">
    <form id="formContact" class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input id="nome" type="text" name="campoNome" class="validate">
          <label for="nome">Nome</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">assignment_ind</i>
          <input id="sobrenome" type="text" class="validate">
          <label for="sobrenome">Sobrenome</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">contact_phone</i>
          <input id="fone" type="tel" class="validate" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
          <label for="fone">Telefone Fixo</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">phone</i>
          <input id="fone2" type="tel" class="validate" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
          <label for="fone2">Telefone Celular</label>
        </div>
        <div class="input-field col s8">
          <i class="material-icons prefix">store</i>
          <input id="endereco" type="text" class="validate">
          <label for="endereco">Endere�o</label>
        </div>
        <div class="input-field col s4">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="N�mero da resid�ncia"><i class="material-icons prefix">receipt</i>
          <input id="numero" type="text" class="validate" pattern="[0-9]+">
          <label for="numero">N�mero</label></span>
        </div>
        <div class="input-field col s12">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="Ex.: N�mero do Apart. / Casa e etc."><i class="material-icons prefix">store</i>
          <input id="complemento" type="text" class="validate">
          <label for="complemento">Complemento do endere�o</label></span>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input id="email" type="email" name="campoEmail" class="validate">
          <label for="email" data-error="E-mail inv�lido" data-success="E-mail v�lido">E-mail</label>
        </div>
        <div class="input-field col s6">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="Escolha uma senha com 10 caracteres"><i class="material-icons prefix">lock</i>
          <input id="senha" type="password" class="validate" length="10" >
          <label for="senha">Senha</label></span>
        </div>
        <div class="input-field col s6">
          <span class="tooltipped" data-position="bottom" data-delay="60" data-tooltip="Confirme a sua senha com 10 caracteres"><i class="material-icons prefix">lock</i>
          <input id="confSenha" type="password" class="validate" length="10">
          <label for="confSenha">Confirmar senha</label></span>
        </div>
        
        
      </div>
      
      <a  class="waves-effect waves-light btn red accent-1 hoverable"  id="UserFormButton"><i class="material-icons right">done</i>CADASTRAR</a>
    </form>
  </div>
    
    <div id="distancia" class="hide"></div>
      <div id="tempo" class="hide"></div>
      <div id="endGoogle" class="hide"></div>
      <div id="mapsresults" class="hide"></div>
    
    
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
  <div id="ifnotvalidate" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao cadastrar!</h4>
      <p align="center">Voc&ecirc deve preencher todos os campos do cadastro e os campos de senha devem conter valores digitados iguais!</p>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">OK!</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->
      
      
        <!-- Modal Structure -->
  <div id="UserCad" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Verifique os dados antes de continuar!</h4>
      <h6 align="center">Seus Dados de Cadastro:</h6>
      
       <div class="divider"></div><br>
      
      

        <ul class="collection">
            
            <label for="nameUser">Nome</label><li class="collection-item" id="nameUser"></li>
           <label for="addressUser">End.</label> <li class="collection-item" id="addressUser"></li>
            <label for="numberAddress">N�</label><li class="collection-item" id="numberAddress"></li>
            <label for="complUser">Compl.</label><li class="collection-item" id="complUser"></li>
            <label for="foneUser">Tel.</label><li class="collection-item" id="foneUser"></li>
            <label for="fone2User">Cel..</label><li class="collection-item" id="fone2User"></li>
            <label for="emailUser">Email</label><li class="collection-item" id="emailUser"></li>
         
         </ul>
      
    </div>
    <div class="modal-footer">
      <a href="#!" id="userCadForm" class="modal-action modal-close waves-effect waves-green btn red darken-2 hoverable">Me cadastre!</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
      
    </div>
  </div>    
      <!-- END of Modal Structure -->

 <!-- Modal Structure -->
  <div id="iflog" class="modal modal-fixed-footer hoverable">
    <div class="modal-content">
      <h4 align="center">Erro ao acessar item</h4>
      <p align="center">Voc&ecirc est� logado como <span class="returnClientName"></span>.</p>
       <p align="center"><a  href="#" class="logout">N�o sou <span class="returnClientName"></span>!</a></p>
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