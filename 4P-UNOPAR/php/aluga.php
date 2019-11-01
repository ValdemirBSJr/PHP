<?php
//pega tumb no site: http://youtubethumbnailgenerator.blogspot.com.br/
//http://www.scriptbrasil.com.br/forum/topic/157099-contar-resultados-com-pdo/
session_start();
  if(empty($_SESSION['LOGIN_STATUS'])){
      header('location:../index.html');
  }
  
  //echo "Bem-vindo! " .$_SESSION['LOGIN_NOME']. "<br/>";;
  //echo "Loque! Valor: " .$_SESSION['LOGIN_STATUS'] . "<br/>";
  //echo "<a href='sair.php'>sair</a>";
?>


 <!DOCTYPE HTML>
   <html lang="pt-br">
   <head>
   	<meta charset="UTF-8">
   	<link rel="shortcut icon" href="../img/favicon.ico"type="image/x-icon"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../css/jquery-ui.css" rel="stylesheet" />
   	
        <title>Locadora de <?php  echo utf8_encode($_SESSION['LOGIN_NOME']); ?></title>
   </head>
   <body>
  
  <?php
    
    $id_User = $_GET['id_user'];
    $id_Filme = $_GET['id_filme'];
    $id_Nome = utf8_decode($_GET['id_nome']);
    $nome_Filme = utf8_decode($_GET['filme_nome']);
   
    
    try
    {
        //echo '<meta HTTP-EQUIV="Refresh" CONTENT="10; URL=locadora.php">';
        
        $pdo = new PDO ("mysql:host=localhost; dbname=4p", "root", "");
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $locaFilmes = $pdo->prepare("INSERT INTO loc_filmes (loc_filme_ID, loc_user_ID, loc_DATA) VALUES (:FILMEID, :USERID, :DATALOCACAO)");
        
        $locaFilmes -> bindParam(":FILMEID", $id_Filme, PDO::PARAM_STR);
        $locaFilmes -> bindParam(":USERID", $id_User, PDO::PARAM_STR);
        $locaFilmes -> bindParam(":DATALOCACAO", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        
        
        //$locaFilmes ->execute();
        @$pdo ->query($locaFilmes); //no caso da insercao, só deu certo assim com query. o execute enviava valores duplicados. Ignorei o erro. GAmbi master. PDO é chato e complicado...
        $contagem = $locaFilmes ->rowCount();
        
        
        //Abaixo testo se foi inserido no banco, caso sim, retorna informação de registro senão, informa erro
        if ($locaFilmes ->execute())
        {
           $MensagemTopo = "Olá, ".$id_Nome."! Filme locado!";
           $MensagemCorpo = "O filme: ".$nome_Filme." foi alugado com sucesso! O filme já está disponível no canal 654 da sua TV.";
        }
        else
        {
            $MensagemTopo = "Olá, ".$id_Nome."! Não foi possível locar o filme!";
            $MensagemCorpo = "O filme: ".$nome_Filme." não foi alugado! Consulte a operadora pelo número: (11) 3333-3333.";
        }
        
        echo '<div class="jumbotron">';
        echo '<div class="container">';
        echo '    <h1>'.utf8_encode($MensagemTopo).'</h1>';
           echo ' <p>'.utf8_encode($MensagemCorpo).'</p>';
           echo utf8_encode('<p>Você será redirecionado para a página de locação em 10 segundos, ou clique no botão abaixo:</p>');
            echo '<p><a class="btn btn-primary btn-lg" role="button" id="click" href="locadora.php">Voltar</a></p>';
       echo '</div>';
    echo '</div>';
        
        
           // fecho o banco
    $pdo = null;
    }
    catch ( PDOException $e )
    {
    echo $e->getMessage ();
    }
        
?>
  
  
  <meta HTTP-EQUIV="Refresh" CONTENT="10; URL=locadora.php">
  </body>
 </html>