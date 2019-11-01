<?php
//session_start();
//
////O seguinte codigo faz a validação em si do login
//
////Necessario para caracteres especiais
//header("Content-Type: text/html; charset=ISO-8859-1",true);
//
////$Login = $_POST['uname'];
////$Senha = $_POST['password'];
//
////Abaixo testo se houve get e se os campos foram vazios
//if (!empty($_POST) AND (empty($_POST['uname']) OR empty($_POST['password'])) )
//{
//    echo "<p>Login ou senha estão em branco!</p>";
//}
//else{
//    echo "<p>valor do Login: ". $Login . "</p>";
//    echo "<p>valor da Senha: ". $Senha . "</p>";
//
//
//    //O código abaixo usa PDO (Php Data Object) para conexão com o BD e login
//
////Dados de acesso
//$host = "localhost"; //nome do host
//$dbn  = "dtc_abordo"; //nome do banco
//$user = "root"; //usuario
//$pass = ""; //senha de acessp
// 
//$tabela = "usuario";
// 
//try
//{
//	//Conectar
//	$ligacao = new PDO("mysql:dbname=$dbn; host=$host", $user, $pass);
//	$ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 
// //Simular processo demorado para vermos o “carregando” (descartar em produção)
//	sleep(1);
// 
//	//Em caso de pesquisas, via procedures
//	//$pesq = "";
//	//$sql = "CALL Nome_da_procedure()";
// 
//	//Em caso de querys
//	$pesq1 = $Login; //aqui é o valor a ser buscado
//        $pesq2 = $Senha;
//	$sql = "SELECT * FROM $tabela WHERE usuario_login = :LOGIN_DIGITADO AND usuario_senha = :SENHA_DIGITADA";
// 
//	$resultados = $ligacao->prepare($sql);
// 
//	//Definição de parâmetros
//	$resultados->bindParam(":LOGIN_DIGITADO", $pesq1, PDO::PARAM_STR);
//        $resultados->bindParam(":SENHA_DIGITADA", $pesq2, PDO::PARAM_STR);
//        
//	$resultados->execute();
// 
//	//abaixo iremos verificar se teve retorno senao, nao passa da tela de login
//        
//        if (!$resultados->rowCount())
//        {
//            echo "<p><font color = 'red'>Login ou senha inválidos!</font></p>";
//        }
//        
//        else{
//            
// 
//	foreach($resultados as $linha)
//	{
//		echo '<p>';
//		//Nome do campo na tabela pesquisada
//		echo $linha["usuario_login"];
//		echo '</p>';
//                
//                $LoginRestadado = $linha["usuario_login"];
//                $SenhaResgatada = $linha["usuario_senha"];
//	}
//        
//        //simples contagem de linhas resgatadas
//	echo '<hr><p>Resultados: '.$resultados->rowCount().'</p>';
//        
//        //Abaixo fazemos a verificação e mandamos para outra página
//        if (($Login == $LoginRestadado) && ($Senha == $SenhaResgatada))
//        {
//            $_SESSION['LOGIN_STATUS']=true;
//            $_SESSION['UNAME']=$uname;
//           // header("Location: teste.php"); //redireciona para outra pasta
//            
//            //exit();
//            
//            //echo '<script>window.top.location.href="http://localhost/DTC_A_BORDO/DTC/diario.html"</script>';
//        }
//        
// 
//	//Desconectar
//	$ligacao = null;
//
//        }
//}
//        
//
//        
//
//catch(PDOException $erro)
//{
//	echo $erro->getMessage();
//}
//
//
//}
session_start();
sleep(3); //espera 3 segundos -só pra testes
include_once('inc/dbConnect.inc.php'); //linha usada pra ir buscar o connect
$message=array();
if(isset($_POST['uname']) && !empty($_POST['uname'])){
    $uname=mysql_real_escape_string($_POST['uname']);
}else{
    $message[]='Favor digitar login';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
    $password=mysql_real_escape_string($_POST['password']);
}else{
    $message[]='Favor digitar senha.';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/><br/>';
     }
}else{
    $query="select * from usuario where usuario_login='$uname' and usuario_senha='$password'";

    $res=mysql_query($query);
    $checkUser=mysql_num_rows($res);
    if($checkUser > 0){
         $_SESSION['LOGIN_STATUS']=true;
         $_SESSION['UNAME']=$uname;
         echo 'correct';
    }else{
         echo ucwords('Por favor, entre com os dados corretos.');
    }
}
?>

