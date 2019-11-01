<?php
      session_start();
          if(!isset($_SESSION['CLIENTENOME']) || !isset($_SESSION['CARRINHO']))
             {
              $cliente = "Sem cliente escolhido ou sem pedido escolhido. Selecione um antes!";
			  echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/6P-UNOPAR/cliente.php">';
			  
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
 function apagaCarrinho() {
    
  
$(document).ready(function() {
  $(".modal-trigger").on('click', function(event) {
		var idform = $(this).attr('id'); //pega o id do que foi clicado, independentemente do que foi clicado
       // $("#linha" + idform).css("display", "none"); //apaga a linha dos pedidos visualmente
		document.getElementById("linha" + idform).style.display = "none"; //apaga a linha dos pedidos visualmente
		
		var valorDaLinhaRetiradaPedido = document.getElementById("totaldoPedido" + idform).innerHTML; //abaixo altero o valor do total geral dinamicamente
		var apenasPreco = valorDaLinhaRetiradaPedido.split(" ");
		var valorSubtraidoPedido = apenasPreco[1];
		
		
		var valorDaLinhaRetiradaTotal = document.getElementById("totalGeral").innerHTML;
		var taxaEntrega = document.getElementById("entrega").value;
		
		var valorSubtraido = valorDaLinhaRetiradaTotal  - valorSubtraidoPedido;
		
		
		
		if (valorSubtraido < 0) {
		  valorSubtraido = 0;
		}
		
		var resposta =  valorSubtraido;
		
		document.getElementById("totalGeral").innerHTML = resposta;
		
		
		var idformmanda = $(this).attr('id');
		
		$.post('deleteCarrinho.php',{idform:idformmanda},
		function call_back(data){
			$("#resultCarrinho").html(data);
		     Materialize.toast('Pedido retirado do carrinho do cliente!', 3000, 'rounded');    
		});
        
        
	});
  
  this.off("click"); //Essa linha é extremamente importante. Ela evita um bug de clickes duplicados na chamada da função jquery acima
});


}




function pegaPedido()
{
  //aqui eu pego os valores pra mostrar na tela
  var nome ="Valor total: R$ " + document.getElementById('totalGeral').innerHTML;
  document.getElementById('mostra.nome').innerHTML = nome;
  
}
//
 function mensagemPedido() {
   pegaPedido();
   $('#confirmaPedido').openModal();
     
}



  //função do ajax jquery que insere cliente
$(document).ready(function() {
	$("#cadastraPedido").click(function(event) {
		//var texto = document.getElementById("clienteConsulta").value;
        var cliente = document.getElementById('clienteId').innerHTML;
        var valorTotal = document.getElementById('totalGeral').innerHTML;
		var trocoValor = $('#troco').val();
		var Taxaentrega = $('#entrega').val();
        
		$.post('insertDataPedido.php',{clienteId:cliente, totalGeral:valorTotal, troco:trocoValor, entrega:Taxaentrega},
		function call_back(data){
			$("#resultCarrinho").html(data);
            Materialize.toast('Pedido realizado! Acompanhe e atualize o pedido na guia: ENTREGAS', 3000, 'rounded');
			window.setTimeout(function aguardaMensagem() { window.location.assign("entrega.php");}, 5000); //função que espera 3 segundos antes de redirecionar
           
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
       
      <?php
	  
	  echo '<h4 align="center">&nbspPedidos do Cliente: '.$_SESSION['CLIENTENOME'].'&nbsp/&nbspCadastro: <span id="clienteId">'.$_SESSION['CLIENTEID'].'</span></h4>';
	  echo '&nbspTelefone do cliente: '.$_SESSION['CLIENTETELEFONE'].'</br>';
	  echo '&nbspEndere&ccedilo do cliente: '.$_SESSION['CLIENTEENDERECO'].'</br>';
	  echo '&nbspPonto de refer&ecircncia: '.$_SESSION['CLIENTEREFERENCIA'].'</br>';
	  echo '<div class="divider"></div>';
	  
	  echo '<table class="responsive-table">';
        echo '<thead>';
          echo '<tr>';
              echo '<th data-field="pedido">Pedido</th>';
              echo '<th data-field="tamanho">Tamanho</th>';
              echo '<th data-field="unitario">Valor unit&aacuterio</th>';
			  echo '<th data-field="qtde">Qtde. pedido</th>';
			  echo '<th data-field="total">Total</th>';
			  echo '<th data-field="pagamento">Pagamento</th>';
			  echo '<th data-field="excluir">Excluir o pedido?</th>';
          echo '</tr';
        echo '</thead>';

        echo '<tbody>';
        
		 $somatotalPedido = 0;
		 foreach ($_SESSION['CARRINHO'] as $rotulo => $informacao)
		{
		  
		  echo '<tr id="linha'.$rotulo.'">';
		  
			//echo $rotulo."=>".$informacao."<br>";
			$retornaArray = explode(";", $_SESSION['CARRINHO'][$rotulo]); //recebe a array com os valores do carrinho

$type = "all";			
			$sql = "SELECT * FROM produto WHERE produtoId = '$retornaArray[0]'";
    
$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$result = mysql_query($sql) or die(mysql_error());


if($type == "all"){
	$return = "";
 if (mysql_num_rows($result) > 0)
    {
    
	while($data = mysql_fetch_array($result)){
		
		 echo '<td id="'.$retornaArray[0].'">'.$data['produtoNome'].'</td>';
		 
	}
    
    }
}
			$somatotalPedido = $somatotalPedido + ($retornaArray[2] * $retornaArray[3]);
		echo '<td>'.$retornaArray[1].'</td>';	
		echo '<td>R$ '.$retornaArray[2].'</td>';	
		echo '<td>'.$retornaArray[3].'</td>';
		echo '<td id="totaldoPedido'.$rotulo.'">R$ '.$retornaArray[2] * $retornaArray[3].'</td>';
		echo '<td>'.$retornaArray[4].'</td>';
		echo '<td><button  class="btn modal-trigger" id="'.$rotulo.'" onclick="apagaCarrinho();">Excluir</button></td>';
			echo '</tr>';
		}
		
		
        echo '</tbody>';
      echo '</table>';
	  
	  echo '<div class="row">';
	  echo '<div class="col s6 m5">';
	  echo '<label for="entrega">Taxa de entrega</label>';
	  echo '	<p><input placeholder="entrega" id="entrega" type="text" class="validate col s3" ><br><br><br>';
	  echo '</div>';
	  
	  echo '<div class="col s6 m5">';
	  echo '<label for="troco">Troco a enviar</label>';
	  echo '	<p><input placeholder="troco" id="troco" type="text" class="validate col s3" >';
	   echo '</div>';
	 
	  echo '</div>';
	  
	  echo '<h4>TOTAL GERAL: R$ <span id="totalGeral">'.$somatotalPedido.'</span></h4>';
	  echo '<div class="divider"></div>';
	  echo '<br>';
	 // echo '<a  class="waves-effect waves-light btn"  onclick="$(\'#confirmaPedido\').openModal();"><i class="material-icons right">send</i>FECHAR PEDIDO</a>';
	  echo '<a  class="waves-effect waves-light btn"  onclick="mensagemPedido()"><i class="material-icons right">send</i>FECHAR PEDIDO</a>';
	  ?>
      
  </div>
  <!--Aqui acima termina o div da página-->
  <div id="resultCarrinho"></div>
     
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