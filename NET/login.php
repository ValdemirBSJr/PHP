<?php
//abaixo iremos pegar o primeiro dia �til do mes, se for, iremos pra tela de atualizar o login
$mes = date("m");
  $ano = date("y");
  $primeiro = mktime(0, 0, 0, $mes, 1, $ano); 
  $dia = date("j", $primeiro);
  $dia_semana = date("w", $primeiro);
  $dia_de_hoje = mktime(0,0,0, $mes, date("d"), $ano);
  
  
  // domingo = 0;
  // s�bado = 6;
  // verifica s�bado e domingo
  if($dia_semana == 0){
    $dia++;
  }
  if($dia_semana == 6){
    $dia++;
	$dia++;
  }
  $primeiro = mktime(0, 0, 0, $mes, $dia, $ano);
  /*echo "O primeiro dia �til para o m�s informado 
     �: " . date("d/m/Y", $primeiro);
	 echo "<p>A data de hoje � :" .date("d/m/y", $dia_de_hoje)."</p>";
	 */
	 
	 if ($primeiro == $dia_de_hoje && !isset($_COOKIE['atualizado']))
	 {
	 
		setcookie('atualizado', 'sim',  time()+ 1 * 3600);//seta cookie para atualiza��o de senha
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/NET/atualiza_login.php">'; //redireciona para outra pasta
	 }
	 else
	 {
	 setcookie('atualizado', 'nao', time()+ 1 * 3600);//seta cookie para atualiza��o de senha
	 }
	



//Abaixo conectamos ao servidor, administrador-login e senha
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("netdbtotal") or die (mysql_error());

//Aqui puxamos os valores digitados nos campos da p�gina inicial para as variaveis
$Login = $_POST['user'];
$Senha = $_POST['password']; 

//Aqui fazemos a consulta SQL no BD

$codificacao64 = base64_encode($Senha); //Aqui encripto a senha para o BD

$logar = mysql_query("SELECT * FROM tbllog WHERE log_login = '$Login' AND log_senha = '$codificacao64'") or die("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");

//Aqui � feita uma verifica��o na lista gerada pela consulta. Se n�o for encontrado resultado, direciona para a p�gina de bloqueio, se funciona, leva para a�p�gina dos livros

@$Login_resgatado = mysql_result($logar,0,"log_login"); //aqui pego o resultado e salvo em vari�vel. primeiro vem a consulta, depois o numero da linha '0' significa a primeira linha e o campo
@$Senha_resgatada = mysql_result($logar,0,"log_senha"); //o arroba omite o erro.
@$Nome_resgatado = mysql_result($logar,0,"log_nome");
@$Identificador_resgatado = mysql_result($logar,0,"log_identificador");
@$Identificador_Login = mysql_result($logar, 0, "id_log");

$cont_log = mysql_num_rows($logar);

if ($cont_log < 1){

session_start("Esta_Logado");
$_SESSION['atualizou'] ="nao"; //session da atualiza��o de cadastro
$_SESSION['Est_logado'] = "nao";
unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);

	echo "<h3><font color='red'>N�o foi poss�vel logar, verifique se a senha e o nome do usu�rio conferem.</font></h3>";
	
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	
}


elseif (($Login == $Login_resgatado) && ($codificacao64 == $Senha_resgatada))
{
//REDIRECIONA PARA OUTRA P�GINA:  header("location:livros.html");
echo "Voc� est� logado!";
echo "<p>Bem-Vindo: " .$Nome_resgatado. ".</p>";

session_start("Esta_Logado");

$tempolimite = 900;

$_SESSION['Est_logado'] = "sim"; //condi��o para estar logado
 $_SESSION['registro'] = time(); // armazena o momento em que autenticado 
 $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade 
 $_SESSION['Id_logado'] = $Identificador_resgatado; //aqui � o perfil
 $_SESSION['Id_usuario'] = $Identificador_Login; //aqui � o login unico
 
// fim das configura��es de tempo inativo

if ($Identificador_resgatado == 3) //Aqui testo o perfil do usu�rio, e envio para uma p�gina de acordo com ele
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

//mysql_close($logar); //fecha a conex�o
mysql_free_result($logar); //libera a mem�ria. a vers�o arcaica pode ser usada para fins de compatibilidade: mysql_freeresult()


}
else {

session_start("Esta_Logado");
$_SESSION['Est_logado'] = "nao";
unset($_SESSION['registro']);
unset($_SESSION['limite']);
$_SESSION['atualizou'] ="nao";
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);

echo "<h3><font color='red'>N�o foi poss�vel logar, verifique se a senha e o nome do usu�rio conferem.</font></h3>";
	//REDIRECIONA PARA OUTRA P�GINA:    header ("location: logue.html");
	echo "<a href='index.html'><p>Tente de novo</p></a>";
	
}

	
		
		
?>		