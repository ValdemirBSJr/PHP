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
 function atualizaPedido() {
    
  
$(document).ready(function() {
  $(".modal-trigger").on('click', function(event) {
		var idform = $(this).attr('id'); //pega o id do que foi clicado, independentemente do que foi clicado
       // $("#linha" + idform).css("display", "none"); //apaga a linha dos pedidos visualmente
		//document.getElementById("linha" + idform).style.display = "none"; //apaga a linha dos pedidos visualmente
		
		//var valorDaLinhaRetiradaPedido = document.getElementById("totaldoPedido" + idform).innerHTML; //abaixo altero o valor do total geral dinamicamente
		//var apenasPreco = valorDaLinhaRetiradaPedido.split(" ");
		//var valorSubtraidoPedido = apenasPreco[1];
		
		//var valorDaLinhaRetiradaTotal = document.getElementById("totalGeral").innerHTML;
		
		
		//var valorSubtraido = valorDaLinhaRetiradaTotal - valorSubtraidoPedido;
		
		
		
		
		//document.getElementById("totalGeral").innerHTML = resposta;
		var entregadorId = "entregadorId" + idform; //passa o ID do elemento
		var entregador = $('#entregadorId' + idform).val(); //pega o value
		
		var idStatusPedido = "StatusPedido" + idform;
		var statusPedido = $('#StatusPedido' + idform).val();
		
		var idformmanda = $(this).attr('id');
		
		
		
		$.post('updateDataEntrega.php',{idform:idformmanda, idStatusPedido:statusPedido, entregadorId:entregador},
		function call_back(data){
			$("#resultEntrega").html(data);
		     Materialize.toast('Pedido atualizado com sucesso!', 3000, 'rounded');    
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
//$(document).ready(function() {
//	$("#cadastraPedido").click(function(event) {
//		//var texto = document.getElementById("clienteConsulta").value;
//        var cliente = document.getElementById('clienteId').innerHTML;
//        var valorTotal = document.getElementById('totalGeral').innerHTML;
//        
//		$.post('insertDataPedido.php',{clienteId:cliente, totalGeral:valorTotal},
//		function call_back(data){
//			$("#resultCarrinho").html(data);
//            Materialize.toast('Pedido realizado! Acompanhe e atualize o pedido na guia: ENTREGAS', 3000, 'rounded');
//           
//		});
//        
//	});
//});

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
	  <h4 align="center">CENTRAL DE ENTREGAS</h4>
	  <div class="divider"></div>
       
      <?php
	  
	  echo '<table class="responsive-table">';
        echo '<thead>';
          echo '<tr>';
              echo '<th data-field="pedido">ID do pedido</th>';
              echo '<th data-field="cliente">Dados do Cliente</th>';
			  echo '<th data-field="pedidoResumo">Resumo do pedido</th>';
			  echo '<th data-field="total">Total</th>';
			  echo '<th data-field="entregador">Entregador</th>';
			  echo '<th data-field="status">Status</th>';
			  echo '<th data-field="atualizar">Atualizar</th>';
          echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
        
		 
		  
		  
		  
			//echo $rotulo."=>".$informacao."<br>";

$type = "all";			
			$sql = "SELECT * FROM pedido WHERE pedidoStatus < '2'"; //busca tudo que não tiver entregue ou cancelado
    
$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$result = mysql_query($sql) or die(mysql_error());


if($type == "all"){//if type geral
	$return = "";
 if (mysql_num_rows($result) > 0)
    { //if mysqlnum geral
    
	while($data = mysql_fetch_array($result)){ //consulta geral
	  
		echo '<tr id="linha'.$data['pedidoId'].'">';
		
		//ID DO PEDIDO
		 echo '<td id="'.$data['pedidoId'].'">'.$data['pedidoId'].'</td>';
		 
		 //RETORNA DADOS DOS CLIENTES
		 $cliente = $data['pedidoClienteId'];
		 $sqlCli = "SELECT * FROM cliente WHERE clienteId = '$cliente'";

$typeCli = "all";		 
$userCli = "root";
$passCli = "";
$hostCli = "localhost";
$baseCli = "6p";
mysql_connect($hostCli, $userCli, $passCli);
mysql_select_db($baseCli);
$resultCli = mysql_query($sqlCli) or die(mysql_error());
		 
		 if($typeCli == "all"){
	$return = "";
 if (mysql_num_rows($resultCli) > 0)
    {
    
	while($dataCliente = mysql_fetch_array($resultCli)){
		
		 echo '<td id="'.$dataCliente['clienteId'].'"><p>Nome: '.$dataCliente['clienteNome'].'</p>';
		 echo '<p>Endere&ccedilo: '.utf8_encode($dataCliente['clienteEndereco']).'</p>';
		 echo '<p>Telefone: '.$dataCliente['clienteTelefone'].'</p></td>';
		 
	}
    
    }
}
		 
		 //FIM DOS CLIENTES
		 
		 //COMEÇO PEDIDO
		 
		 $retornaArrayPedido = explode(";", $data['pedidoProdutoId']); //recebe os ids dos produtos comprados
		 
		 echo '<td>';
		 
		 foreach ($retornaArrayPedido as $rotulo => $informacao)
		{
		 
$sqlProd = "SELECT * FROM produto WHERE produtoId = '$informacao'";

$typeProd = "all";		 
$userProd = "root";
$passProd = "";
$hostProd = "localhost";
$baseProd = "6p";
mysql_connect($hostProd, $userProd, $passProd);
mysql_select_db($baseProd);
$resultProd = mysql_query($sqlProd) or die(mysql_error());
		 
		 if($typeProd == "all"){
	$return = "";
 if (mysql_num_rows($resultProd) > 0)
    {
    
	while($dataProd = mysql_fetch_array($resultProd)){
		
		 echo '<p>Pedido: '.$dataProd['produtoNome'].'</p>';
		  
		 
	}
    
    }
}
	
		}
		
		echo '<p>Tamanhos: '.$data['pedidoTamanho'].'</p>';
		  echo '<p>Qtde.: '.$data['pedidoQtde'].'</p></td>';
		  
			//FIM PEDIDO
			
			//VALOR
           
			if (($data['pedidoEntrega'] == 0) && ($data['PedidoTroco'] == 0)) //se não tiver taxa de entrega e nem troco mostra só o valor do pedido
			{
				echo'<td>Pedido: R$ '.$data['pedidoValor'].'</td>';  
			}
			if (($data['PedidoTroco'] > 0) && ($data['pedidoEntrega'] > 0))
			{
				  $trocoTotal = $data['PedidoTroco'] - ($data['pedidoValor'] + $data['pedidoEntrega']);
				  
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].' / Entrega: R$ '.$data['pedidoEntrega'].'</p>';
				 echo '<p>Troco solicitado: R$ '.$data['PedidoTroco'].'</p>';
				 echo'<p>Troco a devolver: R$ '.$trocoTotal.'</p></td>';
			}
			if (($data['PedidoTroco'] == 0) && ($data['pedidoEntrega'] > 0))
			{
				  $total = $data['pedidoValor'] + $data['pedidoEntrega'];
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].' / Entrega: R$ '.$data['pedidoEntrega'].'</p>';
				 echo'<p>Total: R$ '.$total.'</p></td>';
			}
			if (($data['PedidoTroco'] > 0) && ($data['pedidoEntrega'] == 0))
			{
				  $trocoadevolver = $data['PedidoTroco'] - $data['pedidoValor'];
				 echo'<td><p>Pedido: R$ '.$data['pedidoValor'].'</p>';  
				 echo'<p>Troco a devolver: R$ '.$trocoadevolver.'</p></td>';
			}
			//FIM VALOR
			
			//ENTREGADOR
			echo '<td>';
		

$typeEntregador = "all"; 


$userEntregador = "root";
$passEntregador = "";
$hostEntregador = "localhost";
$baseEntregador = "6p";
mysql_connect($hostEntregador, $userEntregador, $passEntregador);
mysql_select_db($baseEntregador);
$return = "";

//$resultEntregador = mysql_query($sqlEntregador);

if($typeEntregador == "all"){
	$return = "";
	
	if ($data['pedidoEntregadorId'] == 0){
	  echo '<select class="browser-default" id="entregadorId'.$data['pedidoId'].'">';
      echo '<option value="" disabled selected>Escolha um entregador</option>';
	  
	  $sqlEntregador = "SELECT * FROM entregador";
	  $resultEntregador = mysql_query($sqlEntregador);
	  
	while($dataentregador = mysql_fetch_array($resultEntregador))
	{
			
      echo '<option value="'.$dataentregador['entregadorId'].'">'.utf8_encode($dataentregador['entregadorNome']).'</option>';
  
	}
	
	echo '</select>';
	}
	elseif($data['pedidoEntregadorId'] != 0){
	  
	  $entregadorSelecionado = $data['pedidoEntregadorId'];
	  
	  $sqlEntregador = "SELECT * FROM entregador WHERE entregadorId = '$entregadorSelecionado'";
	  $resultEntregador = mysql_query($sqlEntregador);
	  
	  echo '<select class="browser-default" id="entregadorId'.$data['pedidoId'].'">';
	  while($dataentregador = mysql_fetch_array($resultEntregador))
	{
	  echo '<option value="'.$data['pedidoEntregadorId'].'" selected>'.utf8_encode($dataentregador['entregadorNome']).'</option>';
	}
	  echo '</select>';
	  
	}
	
}
		
		echo '</td>';
			//FIM ENTREGADOR
			
			//STATUS
		echo '<td>';
			
			 if ($data['pedidoStatus'] == 0)
	  {
	  echo '<select class="browser-default" id="StatusPedido'.$data['pedidoId'].'">';
      echo '<option value="0" disabled selected>Pendente</option>';
	  echo '<option value="1">Em tr&acircnsito</option>';
	  echo '<option value="2">Cancelado</option>';
	  echo '<option value="3">Entregue</option>';
	  echo '</select>';
	  }
	  if ($data['pedidoStatus'] == 1)
	  {
			echo '<select class="browser-default" id="StatusPedido'.$data['pedidoId'].'">';
      echo '<option value="0" disabled>Pendente</option>';
	  echo '<option value="1" selected>Em tr&acircnsito</option>';
	  echo '<option value="2">Cancelado</option>';
	  echo '<option value="3">Entregue</option>';
	  echo '</select>';
	  }
	   if ($data['pedidoStatus'] == 2)
	  {
			echo '<select class="browser-default" id="StatusPedido'.$data['pedidoId'].'">';
      echo '<option value="0" disabled>Pendente</option>';
	  echo '<option value="1">Em tr&acircnsito</option>';
	  echo '<option value="2" selected>Cancelado</option>';
	  echo '<option value="3">Entregue</option>';
	  echo '</select>';
	  }
	   if ($data['pedidoStatus'] == 3)
	  {
			echo '<select class="browser-default" id="StatusPedido'.$data['pedidoId'].'">';
      echo '<option value="3" disabled selected>Entregue</option>';
	  echo '</select>';
	  }
	  
	  echo '</td>';
			
			//FIM DO STATUS
			
			echo '<td><button  class="btn modal-trigger" id="'.$data['pedidoId'].'" onclick="atualizaPedido();">ATUALIZAR</button></td>';
          
	  
	  echo'</tr>';


		
		 
	} //fim da consulta geral
    
    } //if mysqlnum geral
}//if type geral
	  
		
		
		
        echo '</tbody>';
      echo '</table>';
	  echo '<div class="divider"></div>';
	  
	 
	  ?>
      
  </div>
  <!--Aqui acima termina o div da página-->
  <div id="resultEntrega"></div>
     
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