<?php

if (($_COOKIE['Est_logado'] !== "sim") || ($_COOKIE['Id_logado'] <> 1)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
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



$login = $_POST['login'];
$senha = $_POST['senha'];
$identificador  = $_POST['perfil'];
$nome = $_POST['nome'];
$email = $_POST['email'];

if ($identificador == "selecione" || empty($senha) || empty($identificador) || empty($nome) || empty($email))
{
echo "Não foi possível cadastrar, pois você deixou campos em branco! Nesta tela, todos os campos são obrigatórios.";
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://www.psiti.w.pw/testenet/sysdoc_admin.php">';
		echo "<a href='sysdoc_admin.php'><p>Voltar</p></a>";
}
else
{

$senha_codificada = base64_encode($senha);



mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

$StringSQL = "INSERT INTO tbllog (log_login, log_senha, log_identificador, log_nome, log_email) VALUES ('$login', '$senha_codificada', '$identificador', '$nome', '$email')";

$inclusaoSQL = mysql_query("$StringSQL") or die (mysql_error());
	
	if ($inclusaoSQL) //se foi feito o cadastro
	{
	echo " <script type='text/javascript'>
	  
	  alert('Usuário cadastrado com sucesso!');
      </script>";
	  
	  echo "<a href='mailto: ".$email."?subject=CADASTRO DE USUÁRIO SYSDOC&body=PREZADO COLABORADOR ".$nome.", SEU CADASTRO NO SISTEMA SYSDOC FOI EFETUADO COM SUCESSO! SEU LOGIN: ".$login.". SUA SENHA: ".$senha."'>NOTIFICAR O COLABORADOR!!!!</a>";
	  	  echo "<p><a href='sysdoc_admin.php'>VOLTAR</a></p>";
	}
	else
	{
	echo " <script type='text/javascript'>
	  
	  alert('Não foi possível cadastrar. Contate o ADM!');
      </script>";
	  
	  echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://www.psiti.w.pw/testenet/sysdoc_admin.php">';
	  echo "<a href='sysdoc_admin.php'>VOLTAR</a>";
	}
	
}
?>