<?php
if ($_COOKIE['Est_logado'] !== "sim") //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

 die( "Sua seção expirou.");
setcookie("Est_logado"); //condição para estar logado
//setcookie("registro"); // armazena o momento em que autenticado 
//setcookie("limite"); // armazena o tempo limite sem atividade 
setcookie("Id_logado"); //aqui é o perfil
setcookie("Id_usuario"); //aqui é o login unico
setcookie('atualizado');

}
if (isset($_COOKIE['Est_logado'])) //Verifica se a session está ativa
{
setcookie("Est_logado", $_COOKIE['Est_logado'], time() + 60 * 15);
setcookie("Id_logado", $_COOKIE['Id_logado'], time() + 60 * 15); //aqui é o perfil
setcookie("Id_usuario", $_COOKIE['Id_usuario'], time() + 60 * 15); //aqui é o login unico
}
}

else
{ 
setcookie("Est_logado"); //condição para estar logado
setcookie("Id_logado"); //aqui é o perfil
setcookie("Id_usuario");
setcookie('atualizado');
 die( "Sua seção expirou.");

echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

}



$atualiza_login = $_COOKIE['atualizado'];


if($atualiza_login == "nao") //verifica se o cookie existe. se sim, nao manda para a tela de recadastrar login
{
$Identificador_resgatado = $_COOKIE['Id_logado']; //aqui é o perfil
echo "<br><br>";
 
// fim das configurações de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usuário, e envio para uma página de acordo com ele
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.psiti.w.pw/testenet/sysdoc_usuario.php">';  //redireciona para outra pasta
}
elseif ($Identificador_resgatado == 2)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.psiti.w.pw/testenet/sysdoc_posto.php">';
}

elseif ($Identificador_resgatado == 1)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.psiti.w.pw/testenet/sysdoc_admin.php">';
}

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