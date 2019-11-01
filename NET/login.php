<?php
//abaixo iremos pegar o primeiro dia útil do mes, se for, iremos pra tela de atualizar o login
$mes = date("m");
  $ano = date("y");
  $primeiro = mktime(0, 0, 0, $mes, 1, $ano); 
  $dia = date("j", $primeiro);
  $dia_semana = date("w", $primeiro);
  $dia_de_hoje = mktime(0,0,0, $mes, date("d"), $ano);
  
  
  // domingo = 0;
  // sábado = 6;
  // verifica sábado e domingo
  if($dia_semana == 0){
    $dia++;
  }
  if($dia_semana == 6){
    $dia++;
	$dia++;
  }
  $primeiro = mktime(0, 0, 0, $mes, $dia, $ano);
  /*echo "O primeiro dia útil para o mês informado 
     é: " . date("d/m/Y", $primeiro);
	 echo "<p>A data de hoje é :" .date("d/m/y", $dia_de_hoje)."</p>";
	 */
	 
	 if ($primeiro == $dia_de_hoje && !isset($_COOKIE['atualizado']))
	 {
	 
		setcookie('atualizado', 'sim',  time()+ 1 * 3600);//seta cookie para atualização de senha
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/atualiza_login.php">'; //redireciona para outra pasta
	 }
	 else
	 {
	 setcookie('atualizado', 'nao', time()+ 1 * 3600);//seta cookie para atualização de senha
	 }
	



//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

//Aqui puxamos os valores digitados nos campos da página inicial para as variaveis
$Login = $_POST['user'];
$Senha = $_POST['password']; 

//Aqui fazemos a consulta SQL no BD

$codificacao64 = base64_encode($Senha); //Aqui encripto a senha para o BD

$logar = mysql_query("SELECT * FROM tbllog WHERE log_login = '$Login' AND log_senha = '$codificacao64'") or die("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");

//Aqui é feita uma verificação na lista gerada pela consulta. Se não for encontrado resultado, direciona para a página de bloqueio, se funciona, leva para a´página dos livros

@$Login_resgatado = mysql_result($logar,0,"log_login"); //aqui pego o resultado e salvo em variável. primeiro vem a consulta, depois o numero da linha '0' significa a primeira linha e o campo
@$Senha_resgatada = mysql_result($logar,0,"log_senha"); //o arroba omite o erro.
@$Nome_resgatado = mysql_result($logar,0,"log_nome");
@$Identificador_resgatado = mysql_result($logar,0,"log_identificador");
@$Identificador_Login = mysql_result($logar, 0, "id_log");

$cont_log = mysql_num_rows($logar);

if ($cont_log < 1){

session_start("Esta_Logado");
$_SESSION['atualizou'] ="nao"; //session da atualização de cadastro
$_SESSION['Est_logado'] = "nao";
unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);

	echo "<h3><font color='red'>Não foi possível logar, verifique se a senha e o nome do usuário conferem.</font></h3>";
	
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	
}


elseif (($Login == $Login_resgatado) && ($codificacao64 == $Senha_resgatada))
{
//REDIRECIONA PARA OUTRA PÁGINA:  header("location:livros.html");
echo "Você está logado!";
echo "<p>Bem-Vindo: " .$Nome_resgatado. ".</p>";

session_start("Esta_Logado");

$tempolimite = 900;

$_SESSION['Est_logado'] = "sim"; //condição para estar logado
 $_SESSION['registro'] = time(); // armazena o momento em que autenticado 
 $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade 
 $_SESSION['Id_logado'] = $Identificador_resgatado; //aqui é o perfil
 $_SESSION['Id_usuario'] = $Identificador_Login; //aqui é o login unico
 
// fim das configurações de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usuário, e envio para uma página de acordo com ele
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/NET/sysdoc_usuario.php">'; //redireciona para outra pasta
}
elseif ($Identificador_resgatado == 2)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/NET/sysdoc_posto.php">';
}

elseif ($Identificador_resgatado == 1)
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=http://localhost/NET/sysdoc_admin.php">';
}

//mysql_close($logar); //fecha a conexão
mysql_free_result($logar); //libera a memória. a versão arcaica pode ser usada para fins de compatibilidade: mysql_freeresult()


}
else {

session_start("Esta_Logado");
$_SESSION['Est_logado'] = "nao";
unset($_SESSION['registro']);
unset($_SESSION['limite']);
$_SESSION['atualizou'] ="nao";
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);

echo "<h3><font color='red'>Não foi possível logar, verifique se a senha e o nome do usuário conferem.</font></h3>";
	//REDIRECIONA PARA OUTRA PÁGINA:    header ("location: logue.html");
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	
}

	
		
		
?>		