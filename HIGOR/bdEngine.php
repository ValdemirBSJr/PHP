


<!DOCTYPE html>
<html>
<head>
	
	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  
	  <script type="text/javascript" src="js/jss.js"></script>
	  
</head>
<body>
<?php

 session_start();

$opcao = $_POST['opcaoSQL'];

if (isset($_POST['opcaoSQL'])) //INICIO DA VERIFICAÇÃO DAO OPÇÃO DE SQL
{
	if ($opcao == 0)
	{
		
		
$clienteEmail   = trim($_POST['clienteEmail']);



//$dataConvertidaSQL = explode('/',$clienteNascimento);
//$dataPronta = $dataConvertidaSQL[2].'-'.$dataConvertidaSQL[1].'-'.$dataConvertidaSQL[0];

try {
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$pdo-> beginTransaction();
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE clientes_Email = :email");
 
    $stmt -> bindValue(':email',$clienteEmail);
    // Executa query
    $stmt->execute();
 
    
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
		
		$token = geraSenha(20, true, true);
		$ativo = 0;
		
		 $stmt2 = $pdo->prepare("INSERT INTO novasenha (novaSenha_ID, novaSenha_CliId, novaSenha_CliNome, novaSenha_CodAut, novaSenha_Ativo) VALUES ('', :Id_Cliente, :Nome_Cliente, :Cod_Aut, :Ativo)");
 
		$stmt2 -> bindValue(':Id_Cliente',$obj[0]);
		$stmt2 -> bindValue(':Nome_Cliente',$obj[1]);
		$stmt2 -> bindValue(':Cod_Aut',$token);
		$stmt2 -> bindValue(':Ativo',$ativo);
		// Executa query
		$stmt2->execute();
		
		$nomeCodificado = base64_encode($obj[1]);
		
		echo"	 <div class='row'>
      <div class='col s12 m12'>
        <div class='card-panel teal'>
          <span class='white-text'>Prezado, ".utf8_decode($obj[1]).". Enviamos para seu email cadastrado um link para criar uma nova senha. Dentro de instantes, acesse este email para recuperar!<span class='red-text'> Caso n&atildeo receba a senha, verifique a caixa de spam/lixo eletr&ocircnico.</span>
          </span>
        </div>
      </div>
    </div>";
	
	echo "http://localhost/HIGOR/recoverymypass.php?token=".$token."&code=".$nomeCodificado."";

    }
		
	if ($stmt -> rowCount() < 1)
	{
		echo "<b>ERRO: Voc&ecirc n&atildeo tem cadastro ou o campo de senha foi digitado incorretamente. Realize o seu cadastro ou tente novamente!</b><br>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
		
	}
	
	
	$pdo ->commit();
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
	
	$pdo -> rollback();
    echo $e->getMessage ();
}



	}
	
	
	if ($opcao == 1)
	{
//sleep(3); //aguarda 3 segundos

	$clienteNome   = trim($_POST['Nome']);
	$clienteSobrenome    = trim($_POST['Sobrenome']);
	$clienteFone = trim($_POST['Fone']);
	$clienteFone2 = trim($_POST['Fone2']);
	$clienteEndereco = trim($_POST['Endereco']);
	$clienteNumero = trim($_POST['Numero']);
	$clienteComplemento = trim($_POST['Complemento']);
	$clienteEmail = trim($_POST['Email']);
	$clienteSenha = trim($_POST['Senha']);
	$clienteHoraCad = date("Y-m-d");
	$clienteDistancia = trim($_POST['Distancia']);
	$clienteTempo = trim($_POST['Tempo']);
	$clienteEndGoogle = trim($_POST['EndGoogle']);
	
	$senhaCodificada = sha1($clienteSenha);
	

try
		{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("INSERT INTO clientes (clientes_ID, clientes_Nome, clientes_SobreNome, clientes_Telefone, clientes_Telefone2, clientes_Endereco, clientes_EndNumero, clientes_Email, clientes_ComplementoEnd, clientes_Senha, clientes_Distancia, clientes_Tempo, 	clientes_EndGoogle, clientes_DataCad)
						  VALUES ('', :Nome, :Sobrenome, :Fone, :Fone2, :Endereco, :Numero, :Email, :Complemento, :Senha, :Distancia, :Tempo, :EndGoogle, :Data)");
 
    $stmt -> bindValue(':Nome',$clienteNome);
	$stmt -> bindValue(':Sobrenome',$clienteSobrenome);
	$stmt -> bindValue(':Fone',$clienteFone);
	$stmt -> bindValue(':Fone2',$clienteFone2);
	$stmt -> bindValue(':Endereco',$clienteEndereco);
	$stmt -> bindValue(':Numero',$clienteNumero);
	$stmt -> bindValue(':Complemento',$clienteComplemento);
	$stmt -> bindValue(':Email',$clienteEmail);
	$stmt -> bindValue(':Senha',$senhaCodificada);
	$stmt -> bindValue(':Data',$clienteHoraCad);
	$stmt -> bindValue(':Distancia',$clienteDistancia);
	$stmt -> bindValue(':Tempo',$clienteTempo);
	$stmt -> bindValue(':EndGoogle',$clienteEndGoogle);
	
	$result = $stmt->execute();
	
	if ($result)
	{
	echo"	 <div class='row'>
      <div class='col s12 m12'>
        <div class='card-panel teal'>
          <span class='white-text'>Parab&eacutens, ".$clienteNome.". Seu cadastro foi feito com sucesso! Fa&ccedila seu login para experimentar o melhor do sushi!
          </span>
        </div>
      </div>
    </div> ";
		
	}
		
			
		} catch ( PDOException $e )
		
		{
			echo $e->getMessage ();
		}


	}
	
	if ($opcao == 2)
	{
//sleep(3); //aguarda 3 segundos

	$total = trim($_POST['Total']);
	$frete = trim($_POST['Frete']);
	$troco = trim($_POST['Troco']);
	$opcaoPagamento = trim($_POST['OpcaoPagamento']);
	$dataPedido = date("Y-m-d");
	$pedidoStatus = 0;
	$pedidoEntregador = 0;
	$dataSaidaTempo = strtotime("0000-00-00 00:00:00");
	
	if (empty($troco))
			  {
			   $troco = 0;
			  }
			  
			  if (empty($frete))
			  {
			   $frete = 0;
			  }
			  
			   $arrayIdPedidos = array();
              $arrayQtdePedidos = array();
			  $arrayValorIndividualPedidos = array();
			  $descritivosPedidos = array();
			  
			  	foreach ($_SESSION['CARRINHO'] as $rotulo => $informacao)
		{
					
					$retornaArray = explode(";", $_SESSION['CARRINHO'][$rotulo]); //recebe a array com os valores do carrinho
					
					array_push($arrayIdPedidos, $retornaArray[0]);
					array_push($arrayQtdePedidos, $retornaArray[1]);
					array_push($arrayValorIndividualPedidos, $retornaArray[2]);
					array_push($descritivosPedidos, $retornaArray[4]);

		}
		
		$idPedidosConsolidados = implode(';',$arrayIdPedidos);
		$qtdeConsolidada = implode(';', $arrayQtdePedidos);
		$valorIndividualConsolidado = implode(';', $arrayValorIndividualPedidos);
		$descritivosConsolidados = implode(';', $descritivosPedidos);

try
		{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("INSERT INTO pedidos (pedidos_Id, pedidos_ClienteID, pedidos_ProdutosId, pedidos_OpcaoPagamento, pedidos_Qtde, pedidos_ValorIndividual, pedidos_Descritivos, pedidos_ValorTotal, pedidos_EntregadorId, pedidos_Status, pedidos_TempEntrega, pedidos_EntregaValor, pedidos_troco, pedidos_HoraSaida, pedidos_Data)
						  VALUES ('', :idCliente, :idProdutos, :opcaoPagamento, :qtde, :valorIndividual, :descritivosConsolidado, :valorTotal, :entregadorId, :pedidoStatus, :pedidoTempo, :frete, :troco, :DataSaidaTempo, :Data)");
 
    $stmt -> bindValue(':idCliente',$_SESSION['IDCLI']);
	$stmt -> bindValue(':idProdutos',$idPedidosConsolidados);
	$stmt -> bindValue(':opcaoPagamento',$opcaoPagamento);
	$stmt -> bindValue(':qtde',$qtdeConsolidada);
	$stmt -> bindValue(':valorIndividual',$valorIndividualConsolidado);
	$stmt -> bindValue(':descritivosConsolidado',$descritivosConsolidados);
	$stmt -> bindValue(':valorTotal',$total);
	$stmt -> bindValue(':entregadorId',$pedidoEntregador);
	$stmt -> bindValue(':pedidoStatus',$pedidoStatus);
	$stmt -> bindValue(':frete',$frete);
	$stmt -> bindValue(':troco',$troco);
	$stmt -> bindValue(':Data',$dataPedido);
	$stmt ->bindValue(':pedidoTempo', $_SESSION['TEMPOENTREGACLI']);
	$stmt -> bindValue(':DataSaidaTempo',$dataSaidaTempo);
	
	$result = $stmt->execute();
	
		
		unset($_SESSION['CARRINHO']);
		
			
		} catch ( PDOException $e )
		
		{
			echo $e->getMessage ();
		}


	}
	
	if ($opcao == 3)
	{
//sleep(3); //aguarda 3 segundos

	$clienteNome   = trim($_POST['Nome']);
	$clienteSobrenome    = trim($_POST['Sobrenome']);
	$clienteFone = trim($_POST['Fone']);
	$clienteFone2 = trim($_POST['Fone2']);
	$clienteEndereco = trim($_POST['Endereco']);
	$clienteNumero = trim($_POST['Numero']);
	$clienteComplemento = trim($_POST['Complemento']);
	$clienteEmail = trim($_POST['Email']);
	$clienteSenha = trim($_POST['Senha']);
	//$clienteHoraCad = date("Y-m-d");
	$clienteDistancia = trim($_POST['Distancia']);
	$clienteTempo = trim($_POST['Tempo']);
	$clienteEndGoogle = trim($_POST['EndGoogle']);
	
	$senhaCodificada = sha1($clienteSenha);
	$subOpcao = trim($_POST['SubOpcao']);
	
	if ($subOpcao == 0)
	{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
		
		$SQL = "UPDATE clientes set clientes_Nome = :Nome, clientes_SobreNome = :Sobrenome, clientes_Telefone = :Fone, clientes_Telefone2 = :Fone2, clientes_Endereco = :Endereco, clientes_EndNumero = :Numero, clientes_Email = :Email, clientes_ComplementoEnd = :Complemento, clientes_Senha = :Senha, clientes_Distancia = :Distancia, clientes_Tempo = :Tempo, clientes_EndGoogle = :EndGoogle 
					WHERE clientes_ID = :IdCli";
					
					$stmt = $pdo->prepare($SQL);
 
    $stmt -> bindValue(':Nome',$clienteNome);
	$stmt -> bindValue(':Sobrenome',$clienteSobrenome);
	$stmt -> bindValue(':Fone',$clienteFone);
	$stmt -> bindValue(':Fone2',$clienteFone2);
	$stmt -> bindValue(':Endereco',$clienteEndereco);
	$stmt -> bindValue(':Numero',$clienteNumero);
	$stmt -> bindValue(':Complemento',$clienteComplemento);
	$stmt -> bindValue(':Email',$clienteEmail);
	$stmt -> bindValue(':Senha',$senhaCodificada);
	$stmt -> bindValue(':IdCli',$_SESSION['IDCLI']);
	$stmt -> bindValue(':Distancia',$clienteDistancia);
	$stmt -> bindValue(':Tempo',$clienteTempo);
	$stmt -> bindValue(':EndGoogle',$clienteEndGoogle);
	
	}
	if ($subOpcao == 1)
	{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
	
		$SQL="UPDATE clientes set clientes_Nome = :Nome, clientes_SobreNome = :Sobrenome, clientes_Telefone =:Fone, clientes_Telefone2 = :Fone2, clientes_Endereco = :Endereco, clientes_EndNumero = :Numero, clientes_Email = :Email, clientes_ComplementoEnd = :Complemento, clientes_Distancia = :Distancia, clientes_Tempo = :Tempo, clientes_EndGoogle = :EndGoogle 
					WHERE clientes_ID = :IdCli";
					
					$stmt = $pdo->prepare($SQL);
 
    $stmt -> bindValue(':Nome',$clienteNome);
	$stmt -> bindValue(':Sobrenome',$clienteSobrenome);
	$stmt -> bindValue(':Fone',$clienteFone);
	$stmt -> bindValue(':Fone2',$clienteFone2);
	$stmt -> bindValue(':Endereco',$clienteEndereco);
	$stmt -> bindValue(':Numero',$clienteNumero);
	$stmt -> bindValue(':Complemento',$clienteComplemento);
	$stmt -> bindValue(':Email',$clienteEmail);
	$stmt -> bindValue(':IdCli',$_SESSION['IDCLI']);
	$stmt -> bindValue(':Distancia',$clienteDistancia);
	$stmt -> bindValue(':Tempo',$clienteTempo);
	$stmt -> bindValue(':EndGoogle',$clienteEndGoogle);
	
	}
	

try
		{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    
	
	$result = $stmt->execute();
	
	if ($result)
	{
	echo"	 <div class='row'>
      <div class='col s12 m12'>
        <div class='card-panel teal'>
          <span class='white-text'>Parab&eacutens, ".$clienteNome.". Seu cadastro foi atualizado com sucesso! Fa&ccedila seu login para experimentar o melhor do sushi!
          </span>
        </div>
      </div>
    </div> ";
		
	}
		
			
		} catch ( PDOException $e )
		
		{
			echo $e->getMessage ();
		}


	}
	
	if ($opcao == 4)
	
	{
		
		 try {
			
			$token = trim($_POST['Token']);
			$nomeDecodificado = trim($_POST['Code']);
			$senhaNova = trim($_POST['clienteSenha']);
			
			$novaSenhaCod = sha1($senhaNova);
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$pdo-> beginTransaction();
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM novasenha WHERE novaSenha_CliNome = :Nome AND novaSenha_CodAut = :CodAuth");
 
    $stmt -> bindValue(':Nome',$nomeDecodificado);
    $stmt -> bindValue(':CodAuth',$token);
    // Executa query
    $stmt->execute();
 
    
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
		
		$ativo = 1;
		
		 $stmt2 = $pdo->prepare("UPDATE novasenha set novaSenha_Ativo = :ativo WHERE novaSenha_CliNome = :Nome_Cliente AND novaSenha_CodAut = :CodAuth");
 
		$stmt2 -> bindValue(':ativo',$ativo);
		$stmt2 -> bindValue(':Nome_Cliente',$nomeDecodificado);
		$stmt2 -> bindValue(':CodAuth',$token);
		
		// Executa query
		$stmt2->execute();
		
		 $stmt3 = $pdo->prepare("UPDATE clientes set clientes_Senha = :ClienteNovaSenha WHERE clientes_ID = :ClienteId");
 
		$stmt3 -> bindValue(':ClienteId',$obj[1]);
		$stmt3 -> bindValue(':ClienteNovaSenha',$novaSenhaCod);
		
		
		// Executa query
		$resultado = $stmt3->execute();
		
		if ($resultado)
		{
			echo "<h4>Senha atualizada com sucesso!</h4>";
			echo "<a href='index.php'>Voltar ao in&iacutecio</a>";
			
		}
	
	

    }
		
	if ($stmt -> rowCount() < 1)
	{
		echo "<b>ERRO: Voc&ecirc n&atildeo tem cadastro ou o campo de senha foi digitado incorretamente. Realize o seu cadastro ou tente novamente!</b><br>";
		// echo $_SERVER['REMOTE_ADDR']."<br>"; //PEGA O IP
		
	}
	
	
	$pdo ->commit();
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
	
	$pdo -> rollback();
    echo $e->getMessage ();
}
		
	}


if ($opcao == 5)
{

$admLogin   = $_POST['AdmLogin'];
$admSenha    = $_POST['AdmSenha'];

$senhaCodificada = sha1($admSenha);

//$dataConvertidaSQL = explode('/',$clienteNascimento);
//$dataPronta = $dataConvertidaSQL[2].'-'.$dataConvertidaSQL[1].'-'.$dataConvertidaSQL[0];

try {
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_Login = :admlog AND admin_Senha = :senha");
 
    $stmt -> bindValue(':admlog',$admLogin);
	$stmt -> bindValue(':senha',$senhaCodificada); 
    // Executa query
    $stmt->execute();
 
    
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
		echo "<INPUT type='hidden' id='resultName' value='".$obj[1]."'>";
		
		
		@session_start();
		session_name($_SERVER['REMOTE_ADDR'].$obj[1]);
		$_SESSION['IDADMIN'] = $obj[0];
		$_SESSION['NAMEADM'] = $obj[1];
	

		

    }
		
	if ($stmt -> rowCount() < 1)
	{
		//echo "<b>ERRO: Voc&ecirc n&atildeo tem cadastro ou permissao para estar nesta pagina! Realize o seu cadastro ou tente novamente!</b><br>";
		
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}


}

if ($opcao == 6)
{
	try {
      
      $abre = $_POST['Retorno'];
	  
	  if ($abre == 1)
	  {
		$StatusStore = "<p>O viciados foi aberto!!!</p>";
	  }
	  if ($abre == 0)
	  {
		$StatusStore = "<p>O viciados foi Fechado!!!</p>";
	  }
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("UPDATE abreloja set abreLojaStatus = :status WHERE abreLojaID = :ID");
 
    $stmt -> bindValue(':status', $abre);
	$stmt -> bindValue(':ID', 1);
	
   

	$resultado = $stmt->execute();
		
		if ($resultado)
		{
			echo $StatusStore;
			
		}
		
	else
	{
		 //$openMarket = "Loja Fechada!";
		 echo "<p>Erro no acesso ao Banco de dados! Avisa ao Desenvolvedor!</p>"; //PEGA O IP
        //header("Location: marketClosed.php"); //redirect page
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}
	
	
}

if ($opcao == 7)
{
	$statusPedido = $_POST['idStatusPedido'];
	$idLinha = $_POST['idform'];
	$tempo = $_POST['Time']." minutos";
	
	try {
      
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("UPDATE pedidos set pedidos_Status = :status, pedidos_TempEntrega = :tempo WHERE pedidos_Id = :ID");
 
    $stmt -> bindValue(':status', $statusPedido);
	$stmt -> bindValue(':tempo', $tempo);
	$stmt -> bindValue(':ID', $idLinha);
	
   

	$resultado = $stmt->execute();
		
		if ($resultado)
		{
			//echo $StatusStore;
			
		}
		
	else
	{
		 //$openMarket = "Loja Fechada!";
		 echo "<p>Erro no acesso ao Banco de dados! Avisa ao Desenvolvedor!</p>"; //PEGA O IP
        //header("Location: marketClosed.php"); //redirect page
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}

	
}

if ($opcao == 8)
{

try {
      
	  $fone = trim($_POST['Fone']);
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE clientes_Telefone LIKE :fone OR clientes_Telefone2 LIKE :fone");
 
    $stmt -> bindValue(':fone', "%".$fone."%");
	
    // Executa query
    $stmt->execute();
 
    echo"<br><br>";
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
	$dataFormatada = strtotime($obj[13]);
	
		echo "<p>ID do cliente: <span id='idCli'>".$obj[0]."</span><p>";
		echo "<p>Nome: <span id='nameCli'>".utf8_decode($obj[1])."</span></p>";
		echo "<p id='endCli'>Endereco: ".utf8_decode($obj[5]).", N: ".$obj[6]."</p>";
		echo "<p>Cliente desde: <span>".date('d/m/Y', $dataFormatada)."</span></p>";
			

    }
		
	if ($stmt -> rowCount() < 1)
	{
		 //$openMarket = "Loja Fechada!";
		echo "<p>Cliente nao localizado</p>";
        
        
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}

}

if ($opcao == 9)
{

try {
      
	  $id = $_POST['IDCLI'];
	
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE clientes_ID = :id");
 
    $stmt -> bindValue(':id', $id);
	
    // Executa query
    $stmt->execute();
 
	
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	
	echo "<INPUT type='hidden' id='resultNameAdm' value='".$obj[1]."'>";
	

		$_SESSION['IDCLI'] = $obj[0];
		$_SESSION['NAMECLI'] = $obj[1];
		$_SESSION['CLISOBRENOME'] = $obj[2];
		$_SESSION['TEL1'] = $obj[3];
		$_SESSION['TEL2'] = $obj[4];
		$_SESSION['ENDCLI'] = $obj[5];
		$_SESSION['ENDNUMCLI'] = $obj[6];
		$_SESSION['EMAILCLI'] = $obj[7];
		$_SESSION['COMPLENDCLI'] = $obj[8];
		$_SESSION['DISTANCIAENTREGACLI'] = $obj[10];
		$_SESSION['TEMPOENTREGACLI'] = $obj[11];
		$_SESSION['ENDGOOGLECLI'] = $obj[12];
		$_SESSION['DATACADCLI'] = $obj[13];
			

    }
		
	if ($stmt -> rowCount() < 1)
	{
		 //$openMarket = "Loja Fechada!";
		echo "<p>Cliente nao localizado</p>";
        
        
		
	}
	
	
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}

}


if ($opcao == 10)
	{
//sleep(3); //aguarda 3 segundos

	$clienteNome   = trim($_POST['Nome']);
	$clienteSobrenome    = trim($_POST['Sobrenome']);
	$clienteFone = trim($_POST['Fone']);
	$clienteFone2 = trim($_POST['Fone2']);
	$clienteEndereco = trim($_POST['Endereco']);
	$clienteNumero = trim($_POST['Numero']);
	$clienteComplemento = trim($_POST['Complemento']);
	$clienteEmail = trim($_POST['Email']);
	$clienteSenha = "-";
	$clienteHoraCad = date("Y-m-d");
	$clienteDistancia = trim($_POST['Distancia']);
	$clienteTempo = trim($_POST['Tempo']);
	$clienteEndGoogle = trim($_POST['EndGoogle']);
	
	//$senhaCodificada = sha1($clienteSenha);
	

try
		{
	$DB_Host= ""; //se fica em branco, permite acesso de qualquer lugar, tem que configurar para acesso de qualquer lugar no mySQL tbm
	$DB_Name = "viciados_sushi";
	$DB_User = "Us3rAd1ctSush1";
	$DB_Pass = "jumanJ1";
    // PDO em ação!
    $pdo = new PDO ( "mysql:host={$DB_Host};dbname={$DB_Name}", $DB_User, $DB_Pass);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("INSERT INTO clientes (clientes_ID, clientes_Nome, clientes_SobreNome, clientes_Telefone, clientes_Telefone2, clientes_Endereco, clientes_EndNumero, clientes_Email, clientes_ComplementoEnd, clientes_Senha, clientes_Distancia, clientes_Tempo, 	clientes_EndGoogle, clientes_DataCad)
						  VALUES ('', :Nome, :Sobrenome, :Fone, :Fone2, :Endereco, :Numero, :Email, :Complemento, :Senha, :Distancia, :Tempo, :EndGoogle, :Data)");
 
    $stmt -> bindValue(':Nome',$clienteNome);
	$stmt -> bindValue(':Sobrenome',$clienteSobrenome);
	$stmt -> bindValue(':Fone',$clienteFone);
	$stmt -> bindValue(':Fone2',$clienteFone2);
	$stmt -> bindValue(':Endereco',$clienteEndereco);
	$stmt -> bindValue(':Numero',$clienteNumero);
	$stmt -> bindValue(':Complemento',$clienteComplemento);
	$stmt -> bindValue(':Email',$clienteEmail);
	$stmt -> bindValue(':Senha',$clienteSenha);
	$stmt -> bindValue(':Data',$clienteHoraCad);
	$stmt -> bindValue(':Distancia',$clienteDistancia);
	$stmt -> bindValue(':Tempo',$clienteTempo);
	$stmt -> bindValue(':EndGoogle',$clienteEndGoogle);
	
	$result = $stmt->execute();
	
	if ($result)
	{
	echo"	 <div class='row'>
      <div class='col s12 m12'>
        <div class='card-panel teal'>
          <span class='white-text'>Cliente, ".$clienteNome.". Cadastrado com sucesso! 
          </span>
        </div>
      </div>
    </div> ";
		
	}
		
			
		} catch ( PDOException $e )
		
		{
			echo $e->getMessage ();
		}


	}




}//FIM DA VERIFICAÇÃO DAO OPÇÃO DE SQL

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';
$retorno = '';
$caracteres = '';
$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;
$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {
$rand = mt_rand(1, $len);
$retorno .= $caracteres[$rand-1];
}
return $retorno;
}
?>



<!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/materialize.js"></script>
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
</body>
</html>