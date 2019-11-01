<?php
  session_start();
  if(isset($_SESSION['LOGIN_STATUS']) && empty($_SESSION['LOGIN_STATUS'])){
      header('location:index.php');
  }
?>

<!doctype html>

<html lang="pt">
<head>
    <title>DTC-Olá<?php echo $_SESSION['UNAME']; ?></title>
</head>

<FRAMESET COLS ="160,*" BORDER="0" FRAMESPACING="0"> 
<FRAME SRC="menu.php" NAME="esquerda" NORSIZE FRAMEBORDER="NO">

<FRAMESET ROWS ="220,*">
<FRAME SRC="cima.htm" NAME="cima" NORESIZE SCROLLING="NO" FRAMEBORDER="NO"><FRAME SRC="conteudo.htm" NAME="conteudo" FRAMEBORDER="NO">
</FRAMESET>

</FRAMESET>

<body>
    <p>Ola <?php echo date('l');  echo $_SESSION['UNAME'];?></p>
    <a href="logoff.php">Sair</a>
</body>
</html>
