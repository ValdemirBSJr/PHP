<?php
  session_start();
  if(isset($_SESSION['LOGIN_STATUS']) && !empty($_SESSION['LOGIN_STATUS'])){
      header('location:index.php');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Ajax Login Validation Tutorial | 91 Web Lessons</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
function validLogin(){
      var uname=$('#uname').val();
      var password=$('#password').val();

      var dataString = 'uname='+ uname + '&password='+ password;
      $("#flash").show();
      $("#flash").fadeIn(400).html('<img src="image/loading.gif" />');
      $.ajax({
      type: "POST",
      url: "processed.php",
      data: dataString,
      cache: false,
      success: function(result){
               var result=trim(result);
               $("#flash").hide();
               if(result=='correct'){
                     window.location='index.php';
                     window.open('diario.html', '_self'); //Aqui abre a janela do sistema [FUNCIONA]
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
</head>
<body>
<div id="container">
    <!--top section start-->
    <div id='top'>
         <a href="http://www.91weblessons.com" title="91 Web Lessons" target="blank">
             <img src="image/logo.png" alt="91 Web Lessons" title="91 Web Lessons" border="0"/>
         </a>
    </div>

    <div id='tutorialHead'>
         <div class="tutorialTitle"><h1>PHP Ajax Login Validation Tutorial</h1></div>
         <div class="tutorialLink"><a href="http://www.91weblessons.com/php-ajax-login-validation-tutorial" title="PHP Ajax Login Validation Tutorial"><h1>Tutorial Link</h1></a></div>

    </div>

    <div id="wrapper">
         <table align="center" class="login_box">
              <tr><td colspan="2" id="errorMessage"></td></tr>
              <tr>
                 <td>UserName</td>
                 <td><input type="text" name="uname" id="uname"></td>
              </tr>
              <tr>
                 <td>Password</td>
                 <td><input type="password" name="password" id="password"></td>
              </tr>
              <tr id="button_box">
                 <td>&nbsp</td>
                 <td><input type="button" name="submit" value="Submit" class="button" onclick="validLogin()"></td>
              </tr>
              <tr><td colspan="2" id="flash"></td></tr>
         </table>
    </div>

    <!--fotter section start-->
    <div id="fotter">
         <p>Copyright &copy; 2012 
              <a href="http://www.91weblessons.com" title="91 Web Lessons" target="blank">91 Web Lessons</a>. 
              All rights reserved.
         </p>
    </div>
</div>
</body>
</html>
