<?php
      session_start();
          if(!isset($_SESSION['CLIENTENOME']))
             {
              $cliente = "Sem cliente escolhido";
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script> 
      
      <script type="text/javascript">
  //função do ajax jquery que retorna o cliente
  function preencheCarrinho() {
    
  
$(document).ready(function() {
  $(".modal-trigger").on('click', function(event) {
		var idform = $(this).attr('id'); //pega o id do que foi clicado, independentemente do que foi clicado
        var qtde = $('#qtde' + idform).val();
        //var nomeProduto = $('#nomeProduto' + idform).text();
        var tamanho_valor = document.getElementById('seletor'+idform).options[document.getElementById('seletor'+idform).selectedIndex].text;
        var pagamento;
        
        if (document.getElementById('qtde'+ idform).value == "" || document.getElementById('seletor'+idform).options[document.getElementById('seletor'+idform).selectedIndex].text == "Escolha o tamanho/valor" || document.getElementById('clienteLogado').innerHTML == "Sem cliente escolhido") {
        
        Materialize.toast('ERRO: Escolha op&ccedil&otildees v&aacutelidas para o pedido, ou sem cliente selecionado.', 3000, 'rounded');
        
        }
        else{
          
        if ($("#radio2" + idform).is(":checked")) {
            pagamento = "dinheiro";
        }
        else {
          pagamento = "cartao";
        }
        
        var valorArray = tamanho_valor.split('-');
        var valor = valorArray[1].trim();
        var total = parseFloat(valor) * parseFloat(qtde);
        
        var idqtde = $('#qtde' + idform).attr('id');
        var idtamanho_valor = $('#seletor' + idform).attr('id');
        var idpagamento = $('#radio2' + idform).attr('id');
        var idformpassar = $(this).attr('id');
        
		$.post('insertCarrinho.php',{idqtde:qtde, idtamanho_valor:tamanho_valor, idpagamento: pagamento, idformpassar:idform},
		function call_back(data){
			$("#resultCarrinho").html(data);
		     Materialize.toast('Pedido adicionado ao carrinho do cliente! valor do pedido: R$ '+ total+'. Verifique na guia pedidos o status total.', 3000, 'rounded');    
		});
       
      //Materialize.toast('Pedido adicionado ao carrinho do cliente! valor do pedido: R$ '+ total+'. Verifique na guia pedidos o status total.', 3000, 'rounded');
       
        } 
        
        
	});
  
  this.off("click"); //Essa linha é extremamente importante. Ela evita um bug de clickes duplicados na chamada da função jquery acima
});


}
function pegaCliente()
{
  //aqui eu pego os valores pra mostrar na tela
  var nome = document.getElementById('clienteNome').value;
  var telefone = document.getElementById('clienteTelefone').value;
  document.getElementById('mostra.cliente').innerHTML = nome;
  document.getElementById('mostra.telefone').innerHTML = telefone;
  
}

 function mensagemCliente() {
if (document.getElementById('clienteNome').value == "" || document.getElementById('clienteTelefone').value == "" || document.getElementById('clienteEndereco').value == "" || document.getElementById('clienteNascimento').value=="") {
    $('#erroCadastro').openModal();
  }
  else{
   pegaCliente();
   $('#confirmaCliente').openModal();
   
  }
   
}


  //função do ajax jquery que insere cliente
$(document).ready(function() {
	$("#cadastraCliente").click(function(event) {
		//var texto = document.getElementById("clienteConsulta").value;
        var nome = $('#clienteNome').val();
        var endereco = $('#clienteEndereco').val();
        var referencia = $('#clienteReferencia').val();
        var nascimento = $('#clienteNascimento').val();
        var telefone = $('#clienteTelefone').val();
        
		$.post('insertDataCliente.php',{clienteNome:nome, clienteEndereco:endereco, clienteReferencia:referencia, clienteNascimento:nascimento, clienteTelefone:telefone},
		function call_back(data){
			$("#resultadoCadastro").html(data);
            
           
		});
        
	});
});

//function dateMask(inputData, e){ //função para tratar os campos data
//
//var tecla;
//
//if(document.all) // Internet Explorer
//tecla = event.keyCode;
//else //Outros Browsers
//tecla = e.which;
//
//if(tecla >= 48 && tecla < 58){ // numeros de 0 a 9 e '/'
//var data = inputData.value;
//
////validar o dia do mês
//if (data.length == 2){
//if(inputData.value >= 1 && inputData.value <= 31) {
//data += '/';
//inputData.value = data;
//return true;
//}
//else
//return false;
//}
//
////validar o mês (de 1 a 12)
//if (data.length == 5){
//mes = data[3]+""+data[4];
//if(mes >= 1 && mes <= 12) {
//data += '/';
//inputData.value = data;
//return true;
//}
//else
//return false;
//}
//
////validar o ano (de 1900 a 2100)
//if (data.length == 8){
//ano = data[6]+""+data[7];
//if(ano >= 19 && ano <= 21){
//inputData.value = data;
//return true;
//}
//else
//return false;
//}
//
//}else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
//return true;
//else
//return false;
//}
</script>
      
      
    </head>

    <body onload="getById()">
        
        
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
      echo '<span id="clienteLogado">'.$cliente.'</span>';
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
    
    <div class="page-content" id="result">
       
       <!--LOADER-->
    <div class="mdl-spinner mdl-js-spinner is-active"></div>
      <!--FIM DO LOADER-->
  


      
   
   
   
   
   
   
   
      
  </div>
    
    <div id="resultCarrinho">  </div><!--NEssa div vai o resultado da consulta-->
  <!--Aqui acima termina o div da página-->  
     
  </main>
 

  
  
       <!--MODELS TEM QUE FICAR FORA DA DIV DO BODY-->
       
       <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Cabeçalho modal</h4>
      <p>Texto do modal</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Concordo</a>
    </div>
  </div>
       
         <!-- Modal Structure -->
  <div id="pedidoRealizado" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>REALIZAR PEDIDO</h4>
      <p>Deseja adicionar este pedido ao carrinho do cliente?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">DESCARTAR</a>
      <a class="modal-action modal-close waves-effect waves-green btn-flat " id="preparaPedido">SIM</a>
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
    