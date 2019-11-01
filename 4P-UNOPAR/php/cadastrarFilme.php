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


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cadastrador: <?php  echo utf8_encode($_SESSION['LOGIN_NOME']); ?></title>
<link rel="shortcut icon" href="../img/favicon.ico"type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="html5.css">
     <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="document.getElementById('result').style.display = 'none';">
<script type="text/javascript" src="../js/func.js"></script>
<div id="container">
    
	<h1 align="center">Sistema de cadastramento de filmes TELECINE MOZER</h1>
       <div class="well">
        
        
        
        <form  id="contact-form" class="form-horizontal" role="form" action="cadastrarFilme.php">
  <div class="form-group" id="name-field">
                <label for="form-name" class="col-lg-2 control-label">Nome do Filme</label>
                <div class="col-lg-10">
                    <input type="text" class="input-large" id="id" name="form-name-filme" placeholder="Nome do Filme" required autofocus>
                </div>
            </div>
  
  
  <div class="form-group" id="name-field">
                <label for="form-name" class="col-lg-2 control-label">URL do filme</label>
                <div class="col-lg-10">
                    <input type="text" class="input-large custom" id="form-name" name="form-name-url" placeholder="URL" required>
                </div>
            </div>
  
   <p>
    
     <div class="form-group" id="name-field">
                <label for="form-name" class="col-lg-2 control-label">Valor do filme</label>
                <div class="col-lg-10">
                    <input type="text" class="input-large custom" id="form-name" name="form-name-valor" placeholder="valor" required>
                </div>
            </div>
    

    <div class="form-group" id="name-field">
                <label for="form-name" class="col-lg-2 control-label">Thumbnail</label>
                <div class="col-lg-10">
                    <input type="text" class="input-large custom" id="form-name" name="form-name-thumb" placeholder="imagem" required>
                </div>
            </div>
    
    
    
        <label>Produto liberado?
<select name="liberado"    size="1">
<option value="0" selected>N&atildeo</option>
<option value="1">Sim</option>
</select>
</label>
        
             <label>Produto expirado?
<select name="expirado"    size="1">
<option value="0" selected>N&atildeo</option>
<option value="1">Sim</option>
</select>
</label>
  
    
  
  <div class="form-group">
  <label for="comment">Sinopse:</label>
  <textarea class="form-control" rows="2" id="comment" placeholder="Sinopse..." name="form-sinopse-filme"></textarea>
</div>
        </form>
        
 <nav>
  <ul class="pager">
    <li><input class="btn btn-primary" value="Inserir" onclick="insertData()" type="button" /></li>
    <li><input class="btn btn-primary" value="Mostrar" onclick="getById()" type="button" /></li>
  </ul>
</nav>
 <p>Usu&aacuterio: <?php  echo utf8_encode($_SESSION['LOGIN_NOME']); ?></p>
 <p><?php echo "<a href='sair.php'>sair</a>"; ?></p>
	</div>
	
	<div id="result"><img src="../img/loading36.gif"></div>
</div>
</body>
</html>




	
  
  </body>
 </html>