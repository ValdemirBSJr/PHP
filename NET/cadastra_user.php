<?php

session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if ($_SESSION['Est_logado'] !== "sim" || $_SESSION['Id_logado'] <> 1)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/index.html">';
 session_destroy();
 die( "Sua se��o expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
}
if ($registro) //Verifica se a session est� ativa
{
$segundos = time() - $registro; //se tiver ativa atualiza em quanto tempo est�
}

/* verifica abaixo o tempo de inatividade 
se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
se n�o ele renova o tempo e ai � contado mais 900 segundos*/

if($segundos>$limite)
{ 
 session_destroy();
 die( "Sua se��o expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://localhost/NET/index.html">';

}
else{
 $_SESSION['registro'] = time();
}



$login = $_POST['login'];
$senha = $_POST['senha'];
$identificador  = $_POST['perfil'];
$nome = $_POST['nome'];
$email = $_POST['email'];

if ($identificador == "selecione" || empty($senha) || empty($identificador) || empty($nome) || empty($email))
{
echo "N�o foi poss�vel cadastrar, pois voc� deixou campos em branco! Nesta tela, todos os campos s�o obrigat�rios.";
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/NET/sysdoc_admin.php">';
		echo "<a href='sysdoc_admin.php'><p>Voltar</p></a>";
}
else
{

$senha_codificada = base64_encode($senha);



mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

$StringSQL = "INSERT INTO tbllog (log_login, log_senha, log_identificador, log_nome, log_email) VALUES ('$login', '$senha_codificada', '$identificador', '$nome', '$email')";

$inclusaoSQL = mysql_query("$StringSQL") or die (mysql_error());
	
	if ($inclusaoSQL) //se foi feito o cadastro
	{
	echo " <script type='text/javascript'>
	  
	  alert('Usu�rio cadastrado com sucesso!');
      </script>";
	  
	  echo "<a href='mailto: ".$email."?subject=CADASTRO DE USU�RIO SYSDOC&body=PREZADO COLABORADOR ".$nome.", SEU CADASTRO NO SISTEMA SYSDOC FOI EFETUADO COM SUCESSO! SEU LOGIN: ".$login.". SUA SENHA: ".$senha."'>NOTIFICAR O COLABORADOR!!!!</a>";
	  	  echo "<p><a href='sysdoc_admin.php'>VOLTAR</a></p>";
	}
	else
	{
	echo " <script type='text/javascript'>
	  
	  alert('N�o foi poss�vel cadastrar. Contate o ADM!');
      </script>";
	  
	  echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/NET/sysdoc_admin.php">';
	  echo "<a href='sysdoc_admin.php'>VOLTAR</a>";
	}
	
}
?>