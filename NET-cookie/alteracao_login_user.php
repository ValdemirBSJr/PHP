<?php
if ($_COOKIE['Est_logado'] !== "sim") //aqui verifico se a session de acesso est� ativa e se o perfil � o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://www.psiti.w.pw/testenet/index.html">';

 die( "Sua se��o expirou.");
setcookie("Est_logado"); //condi��o para estar logado
//setcookie("registro"); // armazena o momento em que autenticado 
//setcookie("limite"); // armazena o tempo limite sem atividade 
setcookie("Id_logado"); //aqui � o perfil
setcookie("Id_usuario"); //aqui � o login unico
setcookie('atualizado');

}
if (isset($_COOKIE['Est_logado'])) //Verifica se a session est� ativa
{
setcookie("Est_logado", $_COOKIE['Est_logado'], time() + 60 * 15);
setcookie("Id_logado", $_COOKIE['Id_logado'], time() + 60 * 15); //aqui � o perfil
setcookie("Id_usuario", $_COOKIE['Id_usuario'], time() + 60 * 15); //aqui � o login unico
}
}

else
{ 
setcookie("Est_logado"); //condi��o para estar logado
setcookie("Id_logado"); //aqui � o perfil
setcookie("Id_usuario");
setcookie('atualizado');
 die( "Sua se��o expirou.");

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
@$Login_resgatado = mysql_result($logar,0,"log_login"); //aqui pego o resultado e salvo em vari�vel. primeiro vem a consulta, depois o numero da linha '0' significa a primeira linha e o campo
@$Senha_resgatada = mysql_result($logar,0,"log_senha"); //o arroba omite o erro.
@$Iden_resgatada = mysql_result($logar,0,"log_identificador");
@$Nome_resgatado = mysql_result($logar,0,"log_nome");
@$Email_resgatado = mysql_result($logar,0,"log_email");

$cont_log = mysql_num_rows($logar);

if ($cont_log < 1){

	echo "<h3>N�o foi poss�vel atualizar, verifique se a senha e o nome do usu�rio conferem.</h3>";
	
		echo "<a href='http://www.psiti.w.pw/testenet/atualiza_login.php'><p>Tente de novo</p></a>";
	
} 

//elseif era abaixo
if (($Nova_senha == $Conf_senha) && ($Conf_senha <> $Senha))
{


/*
session_start("Esta_Logado");

$tempolimite = 900;

$_SESSION['Est_logado'] = "sim"; //condi��o para estar logado
 $_SESSION['registro'] = time(); // armazena o momento em que autenticado 
 $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade 
 $_SESSION['atualizou'] ="sim";
// fim das configura��es de tempo inativo */
setcookie('atualizado', 'nao', time()+ 1 * 3600);//seta cookie para atualiza��o de senha

		$codificacao64 = base64_encode($Nova_senha); //Aqui encripto a senha para o BD
		
		$atualizar = mysql_query("UPDATE tbllog set log_login = '$Login_resgatado', log_senha = '$codificacao64', log_identificador = '$Iden_resgatada', log_nome = '$Nome_resgatado', log_email = '$Email_resgatado'  WHERE id_log = '$Id_resgatado'") or die("N�o foi poss�vel atualizar seus dados. Favor, contate o ADMINISTRADOR.");

		
		echo "Atualizado com sucesso! Voc� ser� redirecionado.";
		echo "<p>Bem-Vindo: " .$Nome_resgatado. ".</p>";
		
			 
			 		 $Identificador_resgatado = $_COOKIE['Id_logado']; //aqui � o perfil
echo "<br><br>";
 
// fim das configura��es de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usu�rio, e envio para uma p�gina de acordo com ele
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


echo "N�o foi poss�vel atualizar, verifique se a senha e o nome do usu�rio conferem, se a nova senha e sua autentifica��o est�o id�nticas u se a nova senha � diferente da anterior.";
	echo "<a href='http://www.psiti.w.pw/testenet/index.html'><p>Tente de novo</p></a>";
	
}





//echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://www.psiti.w.pw/testenet/index.html">';

?>