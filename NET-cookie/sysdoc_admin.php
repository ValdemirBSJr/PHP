<?php
//############FUNÇÃO GERA SENHA#######################
/**
04
* Função para gerar senhas aleatórias
05
*
06
* @author    Thiago Belem <contato@thiagobelem.net>
07
*
08
* @param integer $tamanho Tamanho da senha a ser gerada
09
* @param boolean $maiusculas Se terá letras maiúsculas
10
* @param boolean $numeros Se terá números
11
* @param boolean $simbolos Se terá símbolos
12
*
13
* @return string A senha gerada
14
*/

function gerarSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)

{

$lmin = 'abcdefghijklmnopqrstuvwxyz';

$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$num = '1234567890';

$simb = '!@#$%*-';

$retorno = '';

$caracteres = '';

 

$caracteres .= $lmin;

if ($maiusculas) $caracteres .= $lmai;

if ($numeros) $caracteres .= $num;

if ($simbolos) $caracteres .= $simb;

 

$len = strlen($caracteres);

for ($n = 1; $n <= $tamanho; $n++) {

$rand = mt_rand(1, $len);

$retorno .= $caracteres[$rand-1];

}

return $retorno;

}
/*
	// Gera uma senha com 10 carecteres: letras (min e mai), números
03
$senha = geraSenha(10);
04
// gfUgF3e5m7
05
 
06
// Gera uma senha com 9 carecteres: letras (min e mai)
07
$senha = geraSenha(9, true, false);
08
// BJnCYupsN
09
 
10
// Gera uma senha com 6 carecteres: letras minúsculas e números
11
$senha = geraSenha(6, false, true);
12
// sowz0g
13
 
14
// Gera uma senha com 15 carecteres de números, letras e símbolos
15
$senha = geraSenha(15, true, true, true);
16
// fnwX@dGO7P0!iWM
*/

//#############FIM DA FUNÇÃO



if ($_COOKIE['Est_logado'] !== "sim" || ($_COOKIE['Id_logado'] <> 1)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

 die( "Sua seção expirou.");
setcookie("Est_logado"); //condição para estar logado
//setcookie("registro"); // armazena o momento em que autenticado 
//setcookie("limite"); // armazena o tempo limite sem atividade 
setcookie("Id_logado"); //aqui é o perfil
setcookie("Id_usuario"); //aqui é o login unico


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

 die( "Sua seção expirou.");

echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

}





/*mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

$StringSQL = "INSERT INTO tbllog (log_login, ) VALUES ()"; */



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>


<title>**ADMINISTRADOR**</title>
<link href="formato.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>


</head>

<body>

<nav>
<ul class="menuhorizontal">
<li><a href="busca_posto.php">PESQUISAR</a></li>
<li><a href="sair.php">SAIR</a></li>

</ul>
</nav>

<br><br><br>
<h1>Sysdoc do ADMINISTRADOR</h1>

	<form name="enviar_cadastro" method="post" action="cadastra_user.php" >
<label>Login do usuário cadastrado:
<input name="login" type="text" tabindex="1" size="15">
</label>
<label>Senha do usuário:
<input name="senha" type="text" tabindex="2" size="16" value="<?php  echo $senha_aleatoria = gerarSenha(6,false, true)?>">
</label>
<label>Nome do usuário:
<input name="nome" type="text" tabindex="1" size="30">
</label>
<label>Email do usuário:
<input name="email" type="text" tabindex="1" size="30">
</label><br/><br/>

<label>Perfil do usuário criado:
<select name="perfil"  size="1">
<option selected value="selecione">Selecione um dos perfis abaixo</option>
<option value="1">Administrador</option>
<option value="2">Posto fiscal</option>
<option value="3">Assist. Administrativo</option>
</select>
</label>


<p><input type="submit" name="Submit" value="Cadastrar Usuário" tabindex="3"></P>

</form>

</body>

</html>