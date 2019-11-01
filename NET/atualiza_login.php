<?php
session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

$atualiza_login = $_COOKIE['atualizado'];
echo $atualiza_login;

if($atualiza_login == "nao") //verifica se o cookie existe. se sim, nao manda para a tela de recadastrar login
{
$Identificador_resgatado = $_SESSION['Id_logado']; //aqui é o perfil
echo "<br><br>";
 
// fim das configurações de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usuário, e envio para uma página de acordo com ele
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/sysdoc_usuario.php">';  //redireciona para outra pasta
}
elseif ($Identificador_resgatado == 2)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/sysdoc_posto.php">';
}

elseif ($Identificador_resgatado == 1)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/sysdoc_admin.php">';
}

}


if ($registro) //Verifica se a session está ativa
{
$segundos = time() - $registro; //se tiver ativa atualiza em quanto tempo está
}

/* verifica abaixo o tempo de inatividade 
se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
se não ele renova o tempo e ai é contado mais 900 segundos*/

if($segundos>$limite)
{
 session_destroy();
 die( "Sua seção expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://localhost/NET/index.html">';

}
else{
 $_SESSION['registro'] = time();
}


	
	
	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

<title>**SYSTEM DOC**</title>
<link href="format.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>
</head>

<body>
</div>
	
	<form name="login"method="post" action="alteracao_login_user.php">
<label>Usuário:
<input name="user" type="text" tabindex="1" size="15">
</label>
<label>Senha:
<input name="password" type="password" tabindex="2" size="15">
</label>
<label>Nova Senha:
<input name="new_password" type="password" tabindex="2" size="15">
</label>
<label>Confirmar Nova Senha:
<input name="confirm_new_password" type="password" tabindex="2" size="15">
</label>

<input type="submit" name="Submit" value="Atualizar" tabindex="3">
</form>

</label>


</body>

</html>