<?php
//O código abaixo usa PDO (Php Data Object) para conexão com o BD

try {
    // PDO em ação!
    $pdo = new PDO ( "mysql:host=localhost;dbname=ajax_test", "root", "" );
 
    // Com o objeto PDO instanciado
    // preparo uma query a ser executada
    $stmt = $pdo->prepare("SELECT * FROM mural");
 
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
		echo "<b>Mensagem: </b>". $obj[1] . "</br>";
    }
    // fecho o banco
    $pdo = null;
    // tratamento da exeção
} catch ( PDOException $e ) {
    echo $e->getMessage ();
}


?>