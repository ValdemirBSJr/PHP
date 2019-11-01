<?php
  session_start();
  if(isset($_SESSION['LOGIN_STATUS']) && !empty($_SESSION['LOGIN_STATUS'])){
      header('location:diario.php');
  }
?>

<!doctype html>
<html> 
<head>
 
    <!-- Basics -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
    <title>LOGIN</title>
 
    <!-- CSS -->
 
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/estilo.css">
        
    <!--<script type="text/javascript" src="js/Ajax.js"></script>-->
    <script type="text/javascript" src="js/jquery.js"></script>
    
    <script type="text/javascript">
function validLogin(){
      var uname=$('#uname').val();
      var password=$('#password').val();

      var dataString = 'uname='+ uname + '&password='+ password;
      $("#flash").show();
      $("#flash").fadeIn(400).html('<img src="img/loading24.gif" />Carregando...');
      $.ajax({
      type: "POST",
      url: "processed.php",
      data: dataString,
      cache: false,
      success: function(result){
               var result=trim(result);
               $("#flash").hide();
               if(result=='correct'){
                     //window.location='index.php';
                     window.open('diario.php', '_self'); //Aqui abre a janela do sistema [FUNCIONA]
               }else{
                     $("#errorMessage").html(result);
               }
      }
      });
}

function trim(str){
     var str=str.replace(/^\s+|\s+$/,'');
     return str;
}
</script>
    

   <!--  <script type="text/javascript">  
            //Testando o jQuery  
            $(document).ready(function() {  
                alert("JQuery funcionando!");  
            });  
        </script>  -->
 
</head>

<body onload="document.getElementById('flash').style.display = 'none';">
 
    <!-- Begin Page Content -->
 
    <div id="container">
 
        <form >
 
            <label for="username">Login:</label>
 
            <input type="text" id="uname" name="uname">
 
            <label for="password">Senha:</label>
 
            <p><a href="#">Esqueceu a senha?</a></p>
 
            <input type="password" id="password" name="password">
                
                <div id="wrapper">
                    <div id="flash">
                    </div>
                </div>
 
            <div id="lower">
 
                <input type="button" value="Logar" onclick="validLogin()">
 
            </div><!--/ lower-->
 
        </form>
        
            
 
    </div><!--/ container-->
 
</body>

</html>