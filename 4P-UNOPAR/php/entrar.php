<?php

require_once("stringConexao.php");

//O código abaixo usa PDO (Php Data Object) para conexão com o BD

$loginDigitado = mysql_real_escape_string($_POST['form-name']);
$senhaDigitada = mysql_real_escape_string($_POST['form-senha']);
$senhaMensal = mysql_real_escape_string($_POST['form-mensal']);
$opcaoLoginn = $_POST['opcaoLogin'];

try {
    // PDO em ação!
    $pdo = new PDO ( "mysql:host=localhost;dbname=$banco", $login, $senha);
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM $tabela WHERE user_ID = :LOGIN_DIGITADO AND user_SENHA = :SENHA_DIGITADA");
    
    
    //O segredo para a contagem e o fetch_all no fim da consulta. Ele retorna em um array o número de linhas da consulta
    // atribuindo a quantidade de linhas retornadas
   
    //parametros
    $stmt -> bindParam(":LOGIN_DIGITADO", $loginDigitado, PDO::PARAM_STR);
    $stmt -> bindParam(":SENHA_DIGITADA", $senhaDigitada, PDO::PARAM_STR);
 
    // Executa query
    $stmt->execute();
    
    
    // lembra do mysql_fetch_array?
    //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
    //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
    //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
    
	//abaixo temos dois jeitos de recuperar, pelo indice da coluna e pelo nome do campo como um objeto
	while ($obj = $stmt-> fetch (PDO::FETCH_NUM)) {
	//while ( $obj = $stmt->fetch ( PDO::FETCH_OBJ ) ) {
 
        // Resultados podem ser recuperados atraves de seus atributos. 
		//Para ver como posso resgatar de todas as formas, ver: http://www.php.net/manual/pt_BR/pdostatement.fetch.php
        //echo "<b>Nome:</b> " . $obj->login . " - <b>Senha:</b> " . $obj->senhasc."</br>";
		//echo "<b>Nome: </b>". $obj[0]. " - <b>Senha: </b>" . $obj[2]."</br>";
		$LoginRestadado = $obj[0];
                $SenhaResgatada = $obj[1];
                $NomeResgatado = $obj[2];
                
                //echo '<hr><p>Resultados: '.$stmt->rowCount().'</p>';
                $stmt -> setFetchMode(PDO::FETCH_ASSOC);
                $contagem = $stmt->fetchColumn();
                
                
                 if (!$stmt->rowCount())
        {
            echo "<p><font color = 'red'>Login ou senha inválidos!</font></p>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="10; URL=../index.html">'; //redireciona para outra pasta
            echo "<a href='../index.html'>Voltar</a>";
        }
        
        else{
            
 
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
        
        //simples contagem de linhas resgatadas
	//echo '<hr><p>Resultados: '.$resultados->rowCount().'</p>';
        
        //Abaixo fazemos a verificação e mandamos para outra página
        if (($loginDigitado == $LoginRestadado) && ($senhaDigitada == $SenhaResgatada) && ($opcaoLoginn == "1"))
        {
            session_start();
            $_SESSION['LOGIN_STATUS']="true";
            $_SESSION['LOGIN_NOME']=$NomeResgatado;
            $_SESSION['SENHA_MENSAL'] = $senhaMensal;
            $_SESSION['LOGIN_ID'] = $LoginRestadado;
            header("Location: locadora.php"); //redireciona para outra pasta
            
            //exit();
            
            //echo '<script>window.top.location.href="http://localhost/DTC_A_BORDO/DTC/diario.html"</script>';
        }
        if (($loginDigitado == $LoginRestadado) && ($senhaDigitada == $SenhaResgatada) && ($opcaoLoginn == "2")) //aqui entra como administrador
        {
             session_start();
            $_SESSION['LOGIN_STATUS']="true";
            $_SESSION['LOGIN_NOME']=$NomeResgatado;
            $_SESSION['SENHA_MENSAL'] = $senhaMensal;
            $_SESSION['LOGIN_ID'] = $LoginRestadado;
            header("Location: cadastrarFilme.php"); //redireciona para outra pasta
        }
        else 
        {
            echo "<p><font color = 'red'>Login ou senha inválidos!</font></p>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="10; URL=../index.html">'; //redireciona para outra pasta
            echo "<a href='../index.html'>Voltar2</a>";
            echo $opcaoLogin;
        }
        }
    
    
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
        }
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}


?>