<?php
//pega tumb no site: http://youtubethumbnailgenerator.blogspot.com.br/
//http://www.scriptbrasil.com.br/forum/topic/157099-contar-resultados-com-pdo/
//http://www.maujor.com/blog/2009/04/16/janela-modal-com-jquery/
session_start();
  if(empty($_SESSION['LOGIN_STATUS'])){
      header('location:../index.html');
  }
  
  //echo "Bem-vindo! " .$_SESSION['LOGIN_NOME']. "<br/>";;
  //echo "Loque! Valor: " .$_SESSION['LOGIN_STATUS'] . "<br/>";
  //echo "<a href='sair.php'>sair</a>";
?>
<!DOCTYPE html>
<html lang="pt">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="shortcut icon" href="../img/favicon.ico"type="image/x-icon"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../css/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/jquery.youtubepopup.js"></script>

    
<title>Bem-vindo! <?php  echo utf8_encode($_SESSION['LOGIN_NOME']); ?></title>

<script type="text/javascript">
    //abaixo função de ver o vídeo no popup
    $(function () {
	$("a.youtube").YouTubePopup({ autoplay: 1, draggable: true });
});
    
</script>

<script type="text/javascript">
  //script de janela que pergunta confirmar
  
  function validar (trataPosto) //confirma ao usuário o que ele setou. Se ele não concordar não faz nada
	{
	
		
	
		decisao = confirm("DESEJA ALUGAR O FILME SELECIONADO? CLIQUE EM \"CANCELAR\" PARA CANCELAR E OK PARA CONFIRMAR.");
			if (decisao)
			{
				return true;
			}
			else
			{
				return false;
			}
			
	}
    
</script>

</head>

<body>
<br><br>
<div class"container">
    <div class="row">
        <div class="col-md-2">
            <ul class="list-group">
  <li class="list-group-item">Usu&aacuterio: <?php  echo utf8_encode($_SESSION['LOGIN_NOME']); ?></li>
  <li class="list-group-item">Seu ID: <?php echo  $_SESSION['LOGIN_ID']; ?></li>
  <li class="list-group-item"><?php echo "<a href='sair.php'>sair</a>"; ?></li>
</ul>
        </div>
        
        <div class="col-md-10">
    
    
    <div class="well well-lg">
      <h2 align="center">LOCADORA TM - V&iacutedeos dispon&iacuteveis</h2>  
        
        
  <div class="panel panel-default">
  <div class="panel-body">
    
    <?php
        if (empty($_SESSION['SENHA_MENSAL']))
        {
            echo "N&atildeo foi digitado uma senha mensal v&aacutelida. Voc&ecirc n&atildeo ir&aacute poder alugar os conte&uacutedos, consulte o c&oacutedigo na sua fatura.";
            
        }
        else
        {
            
            
            //aqui embaixo faço o while que vai trazer os filmes de acordo com o codigo do cliente, se está em dia
        try
        {
             //stringFilmes
             
             require_once("stringMensal.php");
             
             $pdo = new PDO("mysql:host=localhost; dbname=$banco_men", $login_men, $senha_men);
             
             $buscaID = $_SESSION['LOGIN_ID'];
             //abaixo faço uma busca que me retorna qual foi o último registro da tabela de hashs
             $carregarCod = $pdo ->prepare("SELECT MAX(cod_ind_DATA), user_ID, cod_ind_HASH FROM $tabela_men WHERE user_ID = $buscaID");
             
             $carregarCod -> execute();
             
             
             while ($resultados = $carregarCod->fetch(PDO::FETCH_NUM))
             {
                
               // echo "<b>HASH: </b>". $resultados[2]. " - <b>Data: </b>" . $resultados[0]."</br>";
               $hashResgatado = $resultados[2];
             }
             //abaixo é a onde a mágica acontece. Se o hash mensal confere com o digitado, entregamos todos os filmes. caso não, entregamos com restrições
             if ($hashResgatado == $_SESSION['SENHA_MENSAL'])
             {
                //abaixo filtro pelos filmes válidos. Filmes antigos recebem o campo expirado e nao entram mais no mostruario
                $pdo2 = new PDO("mysql:host=localhost; dbname=$banco_men", $login_men, $senha_men);
                $carregaFilmes = $pdo2->prepare("SELECT * FROM filme WHERE filme_EXPIRADO = 0");
                
                $carregaFilmes->execute();
                
                    while ($resultados = $carregaFilmes->fetch(PDO::FETCH_NUM))
                    {
                        
                        $verificaLocacao = $pdo2->prepare("SELECT loc_filme_ID, loc_user_ID, loc_DATA FROM loc_filmes WHERE loc_filme_ID =$resultados[0] AND loc_user_ID = $buscaID");
                        $verificaLocacao->execute();
                        
                         if(empty($id_locador)) //aqui eu evito o erro caso não retorne valor da query acima, pois ficaria a variavel nula
                            {
                                $id_locador =0;
                            }
                        
                            while ($resultadoLocacao = $verificaLocacao->fetch(PDO::FETCH_NUM))
                            {
                                $id_locador = $resultadoLocacao[1];
                                $id_filme_locado = $resultadoLocacao[0];
                                $data_Locacao = $resultadoLocacao[2];
                            }
                           
                            if (($id_locador == $buscaID) && ($id_filme_locado == $resultados[0]))
                            {
                                $dataConvertida =strtotime($data_Locacao);
                                $tipo_botao = "btn btn-primary disabled";
                                $descricao_botao = "Alugado em: ".date("d/m/Y",$dataConvertida);
                            }
                            else
                            {
                                $tipo_botao = "btn btn-primary";
                                $descricao_botao = "Alugar";
                            }
  
  echo   '<div class="row">';
    echo '<div class="col-sm-6 col-md-4">';
        echo '<div class="thumbnail">';
            echo '<img src="'.$resultados[4].'" alt="'.$resultados[1].'">';
    echo '  <div class="caption">';
     echo '   <h3>'.utf8_encode($resultados[1]).' -  Valor: R$ '.$resultados[7].'</h3>';
        echo '<p>'.utf8_encode($resultados[2]).'</p>';
        echo '<p><a href="aluga.php?id_user='.$_SESSION['LOGIN_ID'].'&id_filme='.$resultados[0].'&id_nome='.utf8_encode($_SESSION['LOGIN_NOME']).'&filme_nome='.utf8_encode($resultados[1]).'" class="'.$tipo_botao.'" onclick="return validar(this)"role="button">'.$descricao_botao.'</a> <a href="'.$resultados[3].'" class="youtube" role="button">Assistir trailer</a></p>';
   echo '   </div>';
   echo ' </div>';
  echo '</div>';
echo '</div>';
                        
                    }
                
                
             
             }
             
    // fecho o banco
    $pdo = null;
            
        } catch ( PDOException $e ) {
    echo $e->getMessage ();
        }
        }
        
        
    ?>
 
    
    
   
      
  </div> 
  </div>
</div>    
        </div>
    </div>
</div>

</body>
</html>