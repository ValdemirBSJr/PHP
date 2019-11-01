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

session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if ($_SESSION['Est_logado'] !== "sim" || $_SESSION['Id_logado'] <> 1)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/index.html">';
 session_destroy();
 die( "Sua seção expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
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
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://localhost/NET/index.html">';

}
else{
 $_SESSION['registro'] = time();
}



mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

$StringSQL = "INSERT INTO tbllog (log_login, ) VALUES ()";



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