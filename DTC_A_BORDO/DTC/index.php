<?php //Validação do session
  session_start();
  if(!isset($_SESSION['LOGIN_STATUS'])){
      header('location:login.php');
  }
?>



<!doctype html>
<html> 
<head>
 
    <!-- Basics -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 
    <title>INDEX</title>
 
    <!-- CSS -->
 
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/estilo.css">
        
    <!--<script type="text/javascript" src="js/Ajax.js"></script>-->
    <script type="text/javascript" src="js/jquery.js"></script>
    
    
    
</script>

   <!--  <script type="text/javascript">  
            //Testando o jQuery  
            $(document).ready(function() {  
                alert("JQuery funcionando!");  
            });  
        </script>  -->
 
</head>

<body onload="document.getElementById('result').style.display = 'none';">
 
    <!-- Begin Page Content -->
 
    <div id="container">
 
        <form>
 
            <label for="username">Login:</label>
 
            <input type="text" id="uname" name="uname">
 
            <label for="password">Senha:</label>
 
            <p><a href="#">Esqueceu a senha?</a></p>
 
            <input type="password" id="password" name="password">
                
                <div id="wrapper">
                    <p>Bem-vindo, <?php echo $_SESSION['UNAME'];?></p>
                </div>
 
            <div id="lower">
 
                <input type="button" value="Logar" onclick="validLogin()">
 
            </div><!--/ lower-->
 
        </form>
        
            
 
    </div><!--/ container-->
 
</body>

</html>