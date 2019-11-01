<?php
  session_start();
  if(!isset($_SESSION['LOGIN_STATUS'])){
      header('location:login.php');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Ajax Login Validation Tutorial | 91 Web Lessons</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
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

         <div class="logout"><a href="logout.php" title="logout"><h1>Logout</h1></a></div>

    </div>

    <div id="wrapper">
         <div class="user_intro"><h1>Welcome <?php echo $_SESSION['UNAME'];?></h1></div>
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
