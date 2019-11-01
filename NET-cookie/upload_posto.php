<?php

if ($_COOKIE['Est_logado'] !== "sim" || ($_COOKIE['Id_logado'] <> 3)) //aqui verifico se a session de acesso está ativa e se o perfil é o do acesso
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








// ######################CODIGO FUNCIONANDO PARA ENVIAR ARQUIVO AO SERVIDOR
$origina = $_POST['originador'];
$data_ori = $_POST['data_originador'];
$vouch = $_POST['voucher'];
 $arq_permitidos = array('application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword');

// O nome original do arquivo no computador do usuário
    $arqName = $_FILES['arquivo']['name'];
	    // O tipo mime do arquivo. Um exemplo pode ser "image/gif"
	    $arqType = $_FILES['arquivo']['type'];
    // O tamanho, em bytes, do arquivo
    $arqSize = $_FILES['arquivo']['size'];
    // O nome temporário do arquivo, como foi guardado no servidor
   $arqTemp = $_FILES['arquivo']['tmp_name'];
    // O código de erro associado a este upload de arquivo
    $arqError = $_FILES['arquivo']['error'];
	
	if ($arqError == 0)//testa se não houve erro se não houver dá mensagem de enviado
		{
		if (array_search($arqType, $arq_permitidos) === false) //verifica se o tipo de arquivo é word ou pdf
			{
				echo "<p><font color='red'>O tipo de arquivo selecionado para envio é inválido! São permitidos apenas documentos do MICROSOFT WORD ou PDF!</font></p>";
				echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_usuario.php'>VOLTAR</a>";
			}
			else //se for manda o arquivo
			{
			$nome = time(). "-".$id_orig. "-".$arqName; //nome alterado
				$pasta = "/home/u187528061/public_html/uploads/";
				$upload = move_uploaded_file($arqTemp, $pasta. $nome);
				echo "enviado!";
			}
		}
		
		//#########################################
		
	//Aqui fazemos o envio dos dados para o BD
		
		mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
		mysql_select_db("u187528061_netdb") or die (mysql_error());
		
		
		$id_orig = $_POST['originador'];
		$id_tratador = $_POST['posto_responsavel'];
		$data_orig = date("Y-m-d");
	
		$descritivo = $_POST['voucher'];
		
		if (($id_tratador == "Selecione") || empty($arqName)) //**********Tem que ser adaptado junto ao código de envio do arquivo
		{
			echo "Não foi possível salvar. Você deve selecionar um arquivo válido e selecionar um posto válido.";
			echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_usuario.php'><p>Voltar</p></a>";
		}
		else
		{
		
		$StringSQL = "INSERT INTO tbluploadposto (posto_originador, posto_demanda_tratad, posto_data_orig, posto_tratador, posto_tratado, posto_data_tratado, posto_arquivo, posto_descritivo) VALUES ('$id_orig', '$id_tratador', '$data_orig', NULL, 0, NULL, '$nome', '$descritivo' )";
		
		$InsercaoSQL = mysql_query("$StringSQL") or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");
		echo "Posto enviado com sucesso!";
		
		$retornaPosto = "SELECT posto_id, posto_arquivo, posto_descritivo FROM tbluploadposto ORDER BY posto_id DESC LIMIT 1"; //retorna o último registro
		
		$geraUltimo = mysql_query("$retornaPosto") or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");
		
			echo "<h4>Abaixo segue o posto gerado:</h4>";
			
				echo "<table border='1'>";
							echo "<tr>";
							
							echo "<td>ID DO POSTO</td>";
							echo "<td>ARQUIVO POSTO</td>";
							echo "<td>DESCRITIVO</td>";
							
							echo "</tr>";
							
							echo "<tr>";
							
						while ($retornaPosto = mysql_fetch_array($geraUltimo))
						{
							echo "<tr>";
							
							echo "<td>".$ID = $retornaPosto['posto_id']."</td>";
							echo "<td><a href='http://www.psiti.w.pw/uploads/".$ARQ = $retornaPosto['posto_arquivo']."' target='_blank' title='Clique no link para visualizar o documento'>CLIQUE AQUI</a></td>";
							echo "<td>".$DESC = $retornaPosto['posto_descritivo']."</td>";
							
							echo "</tr>";
						}
					echo "</table>";	
						
							
		
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="20; URL=http://www.psiti.w.pw/testenet/sysdoc_usuario.php">';
		echo "<a href='http://www.psiti.w.pw/testenet/sysdoc_usuario.php'><p>Voltar</p></a>";
		}
		
		
		
		
		
	

?>