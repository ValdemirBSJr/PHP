<!DOCTYPE HTML>
<html lang="pt/br">
	<head>
	   	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="css/material.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
	  <!--Função do AJAX-->
      <script type="text/javascript" src="js/func-AJAX.js"></script>
	  
	   <script type="text/javascript">
  //função do ajax jquery que retorna o cliente
$(document).ready(function() {
	$("#preparaPedido").click(function(event) {
		//var texto = document.getElementById("clienteConsulta").value;
		//$.post('retornaCliente.php',{clienteConsulta:texto},
		//function call_back(data){
		//	$("#result").html(data);
		//         
		//});
        //$('#pedidoRealizado').openModal();
		alert('TESTE');
	});
});

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
	
<body>	

<?php


sleep(1);
$sql  = "";

	$type = "all"; 
	$sql = "SELECT * FROM produto";



$user = "root";
$pass = "";
$host = "localhost";
$base = "6p";
mysql_connect($host, $user, $pass);
mysql_select_db($base);
$return = "";



$result = mysql_query($sql);



if($type == "all"){
	$return = "";
	
	
echo '<div class="page-content">';
	
echo '<div class="row"> <!-- Essa row aqui organiza os cards distribuindo na tela! Todos os cards tem que estar aqui dentro-->';	
	
	while($data = mysql_fetch_array($result)){
//abaixo salvo os dados de tamanho e preço em arrays pra colocar no combobox de preço tamanho		
$arrayTamanho = explode(';', $data['produtoTamanho']);

$arrayCusto = explode(';', $data['produtoCusto']);

$chave = 0; //Aqui vou anotar a chave do array
		
 echo '<div class="col s12 m4">';
   echo '<div class="card">';
    echo '<div class="card-image waves-effect waves-block waves-light">';
      echo '<img class="activator" src="img/'.$data['produtoImagem'].'">';
    echo '</div>';
    echo '<div class="card-content">';
      echo '<span class="card-title activator grey-text text-darken-4">'.$data['produtoNome'].'</span>';
      echo '<p><a href="#" class="activator">Realizar pedido</a></p><!--A classe activator é que faz o efeito de revelar o card -->';   
    echo '</div>';
    
    echo '<div class="card-reveal" id="quadro">';
      echo '<span class="card-title grey-text text-darken-4">'.$data['produtoNome'].'<i class="material-icons right">close</i></span>';
      echo '<p>'.$data['produtoDescricao'].'</p>';
      
	  
      echo '<label>Escolha o tamanho</label> <!-- Aqui eu coloquei por conta própria pra por seletor -->';
    echo '<select class="browser-default" id="seletor'.$data['produtoId'].'">';
      echo '<option value="" disabled selected>Escolha o tamanho/valor</option>';
	  foreach($arrayTamanho as $tamanho_e_Custo)
	  {
		
      echo '<option value="'.$chave.'">'.$tamanho_e_Custo.' - '.$arrayCusto[$chave].'</option>';  
	  $chave++;
	  
	  }
    echo '</select>';
    
	
    echo '<label for="qtde">Quantidade</label>';
	echo '	<p><input placeholder="Qtde." id="qtde'.$data['produtoId'].'" type="text" class="validate col s3" value="1">';
      
	  
	  echo'<br><br>';

	  
echo '<p>';
echo '      <input name="radio-'.$data['produtoId'].'" type="radio" id="radio1'.$data['produtoId'].'" />';
echo '      <label for="radio1'.$data['produtoId'].'"><img src="img/master.jpg" height="40" width="40"/>Cartão</label>';
echo '    </p>';
echo '    <p>';
echo '      <input name="radio-'.$data['produtoId'].'" type="radio" id="radio2'.$data['produtoId'].'" checked/>';
echo '      <label for="radio2'.$data['produtoId'].'"><img src="img/dinheiro.gif" height="40" width="40"/>À Vista na entrega</label>';
echo '    </p>';
    
   //echo '<button  class="btn modal-trigger" id="'.$data['produtoId'].'" onclick="$(\'#pedidoRealizado\').openModal();">Fechar pedido</button>';
   echo '<button  class="btn modal-trigger" id="'.$data['produtoId'].'" onclick="preencheCarrinho();">Fechar pedido</button>';
  
      
    echo '</div>';
    
 echo ' </div>';
   	
	echo '</div>';	
		


	}
	
	echo '</div>';
	echo '</div>';	
	
}


else{
	//abaixo codigo inutil de outro projeto. tava com pressa rsrsrsrs
	if($data = mysql_fetch_array($result)){
		$return .= "Nome: " .     $data['nome'] .     "<br>";
		$return .= "E-mail: " .   $data['email'] .    "<br>";
		$return .= "Telefone: " . $data['telefone'] . "<br>";
	}
	else{
		
		$return .= "Não foi possível listar o registro com id: " . $id;
	}
}

echo $return;



?>









<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/material.js"></script>

</body>

</html>