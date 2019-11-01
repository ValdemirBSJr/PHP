<?php
      session_start();
          if(!isset($_SESSION['CLIENTENOME']))
             {
              $cliente = "Sem cliente escolhido.";
			 
			  
             }
             
             else
             {
              $cliente = $_SESSION['CLIENTENOME'];
              }
?>
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
// function atualizaPedido() {
//    
//  
//$(document).ready(function() {
//  $(".modal-trigger").on('click', function(event) {
//		var idform = $(this).attr('id'); //pega o id do que foi clicado, independentemente do que foi clicado
//       // $("#linha" + idform).css("display", "none"); //apaga a linha dos pedidos visualmente
//		//document.getElementById("linha" + idform).style.display = "none"; //apaga a linha dos pedidos visualmente
//		
//		//var valorDaLinhaRetiradaPedido = document.getElementById("totaldoPedido" + idform).innerHTML; //abaixo altero o valor do total geral dinamicamente
//		//var apenasPreco = valorDaLinhaRetiradaPedido.split(" ");
//		//var valorSubtraidoPedido = apenasPreco[1];
//		
//		//var valorDaLinhaRetiradaTotal = document.getElementById("totalGeral").innerHTML;
//		
//		
//		//var valorSubtraido = valorDaLinhaRetiradaTotal - valorSubtraidoPedido;
//		
//		
//		
//		
//		//document.getElementById("totalGeral").innerHTML = resposta;
//		var entregadorId = "entregadorId" + idform; //passa o ID do elemento
//		var entregador = $('#entregadorId' + idform).val(); //pega o value
//		
//		var idStatusPedido = "StatusPedido" + idform;
//		var statusPedido = $('#StatusPedido' + idform).val();
//		
//		var idformmanda = $(this).attr('id');
//		
//		
//		
//		$.post('updateDataEntrega.php',{idform:idformmanda, idStatusPedido:statusPedido, entregadorId:entregador},
//		function call_back(data){
//			$("#resultEntrega").html(data);
//		     Materialize.toast('Pedido atualizado com sucesso!', 3000, 'rounded');    
//		});
//        
//        
//	});
//  
//  this.off("click"); //Essa linha é extremamente importante. Ela evita um bug de clickes duplicados na chamada da função jquery acima
//});
//
//
//}
//
//
//
//
//function pegaPedido()
//{
//  //aqui eu pego os valores pra mostrar na tela
//  var nome ="Valor total: R$ " + document.getElementById('totalGeral').innerHTML;
//  document.getElementById('mostra.nome').innerHTML = nome;
//  
//}
//
// function mensagemPedido() {
//   pegaPedido();
//   $('#confirmaPedido').openModal();
//     
//}


  //função do ajax jquery que insere cliente
$(document).ready(function() {
	$("#retornaConsulta").click(function(event) {
		//var texto = document.getElementById("clienteConsulta").value;
        var dataInicialVal = $('#dataInicial').val(); //pega o value
        var dataFinalVal = $('#dataFinal').val();
        
		$.post('consultaRelatorio.php',{dataInicial:dataInicialVal, dataFinal:dataFinalVal},
		function call_back(data){
			$("#resultRelatorio").html(data);
            
           
		});
        
	});
});

//function teste() {
//	  alert(document.getElementById("dataFinal").value);
//}

function dateMask(inputData, e){ //função para tratar os campos data

var tecla;

if(document.all) // Internet Explorer
tecla = event.keyCode;
else //Outros Browsers
tecla = e.which;

if(tecla >= 48 && tecla < 58){ // numeros de 0 a 9 e '/'
var data = inputData.value;

//validar o dia do mês
if (data.length == 2){
if(inputData.value >= 1 && inputData.value <= 31) {
data += '/';
inputData.value = data;
return true;
}
else
return false;
}

//validar o mês (de 1 a 12)
if (data.length == 5){
mes = data[3]+""+data[4];
if(mes >= 1 && mes <= 12) {
data += '/';
inputData.value = data;
return true;
}
else
return false;
}

//validar o ano (de 1900 a 2100)
if (data.length == 8){
ano = data[6]+""+data[7];
if(ano >= 19 && ano <= 21){
inputData.value = data;
return true;
}
else
return false;
}

}else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
return true;
else
return false;
}

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
//Retorna o cliente logado
      echo $cliente;
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
	  <h4 align="center">RELAT&OacuteRIOS - ENTREGAS REALIZADAS</h4>
	  <div class="divider"></div><br><br>
	  
	  <div class="container" align="center">
	  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6 m2">
          <input  id="dataInicial" type="text" class="validate" onkeypress="return dateMask(this, event)">
          <label for="dataInicial">DATA INICIAL</label>
        </div>
        <div class="input-field col s6 m2">
          <input id="dataFinal" type="tel" class="validate" onkeypress="return dateMask(this, event)">
          <label for="dataFinal">DATA FINAL</label>
		  
        </div>
		
		<a class="btn modal-trigger" id="retornaConsulta"><i class="material-icons left">search</i>PESQUISAR</a>
      </div>
	  
	  
	  </div>
	  </div>
	  
	
	  <div class="divider"></div><br>
       
      
  </div>
  <!--Aqui acima termina o div da página-->
  <div id="resultRelatorio"></div>
     
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
  <div id="confirmaPedido" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <h2>CADASTRO DE PEDIDO</h2>
      <h4>Tem certeza que deseja efetuar o cadastro do pedido abaixo?</h4>
      <h6 id="mostra.nome"></h6>
      <h6 id="mostra.descricao" ></h6>
      
    </div>
    <div class="modal-footer">
      <a  class="modal-action modal-close waves-effect waves-green btn-flat ">DESCARTAR</a>
      <a  class="modal-action modal-close waves-effect waves-green btn-flat " id="cadastraPedido">SALVAR</a>
    </div>
  </div>
  
  
   <!-- Modal Structure -->
  <div id="erroCadastro" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <h2>ERRO NO CADASTRO DO PARCEIRO</h2>
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