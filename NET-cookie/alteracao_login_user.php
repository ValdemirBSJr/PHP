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

mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

$Login = $_POST['user'];
$Senha = $_POST['password'];
$Nova_senha = $_POST['new_password'];
$Conf_senha = $_POST['confirm_new_password'];

$verificacao_encryptada = base64_encode($Senha);

$logar = mysql_query("SELECT * FROM tbllog WHERE log_login = '$Login' AND log_senha = '$verificacao_encryptada'") or die("Erro no acesso ao servidor/BD. Contate o ADMINISTRADOR.");

@$Id_resgatado = mysql_result($logar,0,"id_log");
@$Login_resgatado = mysql_result($logar,0,"log_login"); //aqui pego o resultado e salvo em variável. primeiro vem a consulta, depois o numero da linha '0' significa a primeira linha e o campo
@$Senha_resgatada = mysql_result($logar,0,"log_senha"); //o arroba omite o erro.
@$Iden_resgatada = mysql_result($logar,0,"log_identificador");
@$Nome_resgatado = mysql_result($logar,0,"log_nome");
@$Email_resgatado = mysql_result($logar,0,"log_email");

$cont_log = mysql_num_rows($logar);

if ($cont_log < 1){

	echo "<h3>Não foi possível atualizar, verifique se a senha e o nome do usuário conferem.</h3>";
	
		echo "<a href='http://www.psiti.w.pw/testenet/atualiza_login.php'><p>Tente de novo</p></a>";
	
} 

//elseif era abaixo
if (($Nova_senha == $Conf_senha) && ($Conf_senha <> $Senha))
{


/*
session_start("Esta_Logado");

$tempolimite = 900;

$_SESSION['Est_logado'] = "sim"; //condição para estar logado
 $_SESSION['registro'] = time(); // armazena o momento em que autenticado 
 $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade 
 $_SESSION['atualizou'] ="sim";
// fim das configurações de tempo inativo */
setcookie('atualizado', 'nao', time()+ 1 * 3600);//seta cookie para atualização de senha

		$codificacao64 = base64_encode($Nova_senha); //Aqui encripto a senha para o BD
		
		$atualizar = mysql_query("UPDATE tbllog set log_login = '$Login_resgatado', log_senha = '$codificacao64', log_identificador = '$Iden_resgatada', log_nome = '$Nome_resgatado', log_email = '$Email_resgatado'  WHERE id_log = '$Id_resgatado'") or die("Não foi possível atualizar seus dados. Favor, contate o ADMINISTRADOR.");

		
		echo "Atualizado com sucesso! Você será redirecionado.";
		echo "<p>Bem-Vindo: " .$Nome_resgatado. ".</p>";
		
			 
			 		 $Identificador_resgatado = $_COOKIE['Id_logado']; //aqui é o perfil
echo "<br><br>";
 
// fim das configurações de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usuário, e envio para uma página de acordo com ele
{
echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_usuario.php'>Voltar</a>"; //redireciona para outra pasta
}
elseif ($Identificador_resgatado == 2)
{
echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_posto.php'>Voltar</a>";
}

elseif ($Identificador_resgatado == 1)
{
echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_admin.php'>Voltar</a>";
}

}
else {


echo "Não foi possível atualizar, verifique se a senha e o nome do usuário conferem, se a nova senha e sua autentificação estão idênticas u se a nova senha é diferente da anterior.";
	echo "<a href='http://www.psiti.w.pw/testenet/index.html'><p>Tente de novo</p></a>";
	
}





//echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://www.psiti.w.pw/testenet/index.html">';

?>