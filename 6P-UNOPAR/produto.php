<!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      
      
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="css/material.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!--Função do AJAX-->
      <script type="text/javascript" src="js/func-AJAX.js"></script>
      
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">
  //função do ajax jquery que retorna o cliente
//$(document).ready(function() {
//	$("#procuraCliente").click(function(event) {
//		var texto = document.getElementById("clienteConsulta").value;
//		$.post('retornaCliente.php',{clienteConsulta:texto},
//		function call_back(data){
//			$("#result").html(data);
//           
//		});
//	});
//});

function pegaProduto()
{
  //aqui eu pego os valores pra mostrar na tela
  var nome = document.getElementById('produtoNome').value;
  var descricao = document.getElementById('produtoDescricao').value;
  document.getElementById('mostra.nome').innerHTML = nome;
  document.getElementById('mostra.descricao').innerHTML = descricao;
  
}

 function mensagemProduto() {
if (document.getElementById('produtoNome').value == "" || document.getElementById('produtoDescricao').value == "" || document.getElementById('produtoTamanho').value == "" || document.getElementById('produtoCusto').value=="") {
    $('#erroCadastro').openModal();
  }
  else{
   pegaProduto();
   $('#confirmaProduto').openModal();
   
  }
   
}

  //função do ajax jquery que insere cliente
$(document).ready(function() {
	$("#cadastraProduto").click(function(event) {
		//var texto = document.getElementById("clienteConsulta").value;
        var nome = $('#produtoNome').val();
        var descricao = $('#produtoDescricao').val();
        var tamanho = $('#produtoTamanho').val();
        var custo = $('#produtoCusto').val();
        var imagem = $('#produtoImagem').val();
        
		$.post('insertDataProduto.php',{produtoNome:nome, produtoDescricao:descricao, produtoTamanho:tamanho, produtoCusto:custo, produtoImagem:imagem},
		function call_back(data){
			$("#resultadoCadastro").html(data);
            
           
		});
        
	});
});

</script>
      
      
    </head>

    <body>
        
        
      <!-- The drawer is always open in large screens. The header is always shown,
  even in small screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
        
<a href="#" data-activates="mobile-demo" class="button-collapse"></a><!-- Aqui ele faz o efeito mobile de recolher ao deslizar dedo-->

<div class="nav-wrapper">
<a class='dropdown-button' href='#!' data-activates='dropdown1'><i class="material-icons prefix">account_circle</i><i class="material-icons right">arrow_drop_down</i></a>

<!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    <li><a href="cliente.php"><i class="tiny material-icons prefix">play_circle_outline</i>Login</a></li>
    <li class="divider"></li>
    <li><a href="deslogar.php"><i class="tiny material-icons prefix">power_settings_new</i>Sair</a></li>
  </ul>

</div>

<?php
      session_start();
          if(!isset($_SESSION['CLIENTENOME']))
             {
              echo "Sem cliente escolhido";
             }
             
             else
             {
              echo $_SESSION['CLIENTENOME'];
              }
             ?>

      
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
        <label class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
          
          
          
          <input class="mdl-textfield__input" type="text" name="sample"
                 id="fixed-header-drawer-exp" />
          
        
          
        </div>
      </div>
    </div>
  </header>
  
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Men&uacute</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="index.php">HOME</a>
      <a class="mdl-navigation__link" href="cliente.php">Cliente</a>
      <a class="mdl-navigation__link" href="entrega.php">Entregas</a>
      <a class="mdl-navigation__link" href="parceiro.php">Parceiros</a>
      <a class="mdl-navigation__link" href="produto.php">Produtos</a>
      <a class="mdl-navigation__link" href="pedido.php">Pedidos</a>
	  <a class="mdl-navigation__link" href="entregador.php">Entregadores</a>
	   <a class="mdl-navigation__link" href="relatorio.php">Relat&oacuterios</a>
    </nav>
  </div>
  
  
  
  
  <main class="mdl-layout__content">
    
    <div class="page-content">
      
      
       
      <h2 align="center">Cadastro de Produtos</h2>
  
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Digite o nome do produto" id="produtoNome" type="text" class="validate">
          <label for="produtoNome">NOME</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Digite a descricao do produto" id="produtoDescricao" type="text" class="validate">
          <label for="produtoDescricao">DESCRITIVO</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input  placeholder="Digite os tamanhos do produto" id="produtoTamanho" type="text" class="validate">
          <label for="produtoTamanho">TAMANHO</label>
        </div>
      </div>
	   <div class="row">
        <div class="input-field col s6">
          <input  placeholder="Digite os custos do produto" id="produtoCusto" type="text" class="validate">
          <label for="produtoCusto">CUSTO</label>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Digite o caminho da imagem" id="produtoImagem" type="text" class="validate">
          <label for="produtoImagem">IMAGEM</label>
        </div>
      </div>
      
      
  <a  class="waves-effect waves-light btn"  onclick="mensagemProduto()"><i class="material-icons right">send</i>CADASTRAR</a>
  
  
  
  <div id="resultadoCadastro"></div>
      
    </form>
  </div>
        
  </div>
     
     
        

  
      
   
   
   
   

      
  </div>
  <!--Aqui acima termina o div da página-->  
     
  </main>
 

  
  
       <!--MODELS TEM QUE FICAR FORA DA DIV DO BODY-->
       
       <!-- Modal Structure -->
  <div id="retornoClienteModal" class="modal">
    <div class="modal-content">
      <h4>Consulta de Clientes</h4>
      <p>Digite o número do cliente:</p>
      <div class="input-field col s2">
        
        
          <input name="clienteConsulta" id="clienteConsulta" type="text">
          <label for="clienteConsulta">NÚMERO TELEFÔNICO</label>
        
        </div>
      <button  class="btn modal-trigger" id="procuraCliente"><i class="material-icons right">search</i>BUSCAR</button>
      
        
      <div id="result"></div><!--NEssa div vai o resultado da consulta-->
      
    </div>
    <div class="modal-footer">
      <a href="cliente.php" class="modal-action modal-close waves-effect waves-green btn-flat">SAIR</a>
    </div>
  </div>
       
         <!-- Modal Structure -->
  <div id="confirmaProduto" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <h2>CADASTRO DE PRODUTO</h2>
      <h4>Tem certeza que deseja efetuar o cadastro do produto abaixo?</h4>
      <h6 id="mostra.nome" ></h6>
      <h6 id="mostra.descricao" ></h6>
      
    </div>
    <div class="modal-footer">
      <a  class="modal-action modal-close waves-effect waves-green btn-flat ">DESCARTAR</a>
      <a  class="modal-action modal-close waves-effect waves-green btn-flat " id="cadastraProduto">SALVAR</a>
    </div>
  </div>
  
  
   <!-- Modal Structure -->
  <div id="erroCadastro" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <h2>ERRO NO CADASTRO DO PRODUTO</h2>
      <h4>Campos obrigat&oacuterios n&atildeo foram preenchidos.</h4>
     
      
    </div>
    <div class="modal-footer">
      <a  class="modal-action modal-close waves-effect waves-green btn-flat ">OK!</a>
      
    </div>
  </div>    
            
            
     <!-- Modal Structure -->
  <div id="modal3" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
      
        <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">First Name</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" type="tel" class="validate">
          <label for="icon_telephone">Telephone</label>
        </div>
      </div>
    </form>
  </div>
      
      
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>     
        
</div>
        
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/material.js"></script>
      
    </body>
    
    
    

  </html>