<?php

session_start("Esta_Logado");

$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if (($_SESSION['Est_logado'] !== "sim") || ($_SESSION['Id_logado'] <> 3)) //aqui verifico se a session de acesso est� ativa e se o perfil � o do acesso
{
echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=http://localhost/NET/index.html">';
session_destroy();
 die( "Sua se��o expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
}
if ($registro) //Verifica se a session est� ativa
{
$segundos = time() - $registro; //se tiver ativa atualiza em quanto tempo est�
}

/* verifica abaixo o tempo de inatividade 
se ele tiver ficado mais de 900 segundos sem atividade ele destroi a session
se n�o ele renova o tempo e ai � contado mais 900 segundos*/

if($segundos>$limite)
{
 session_destroy();
 die( "Sua se��o expirou.");
 unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset ($_SESSION['Id_logado']);
unset($_SESSION['Id_usuario']);
echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=http://localhost/NET/index.html">';

}
else
{
 $_SESSION['registro'] = time();
}



/* ######################CODIGO FUNCIONANDO PARA ENVIAR ARQUIVO AO SERVIDOR
$origina = $_POST['originador'];
$data_ori = $_POST['data_originador'];
$vouch = $_POST['voucher'];
 $arq_permitidos = array('application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword');

// O nome original do arquivo no computador do usu�rio
    $arqName = $_FILES['arquivo']['name'];
	    // O tipo mime do arquivo. Um exemplo pode ser "image/gif"
	    $arqType = $_FILES['arquivo']['type'];
    // O tamanho, em bytes, do arquivo
    $arqSize = $_FILES['arquivo']['size'];
    // O nome tempor�rio do arquivo, como foi guardado no servidor
   $arqTemp = $_FILES['arquivo']['tmp_name'];
    // O c�digo de erro associado a este upload de arquivo
    $arqError = $_FILES['arquivo']['error'];
	
	if ($arqError == 0)//testa se n�o houve erro se n�o houver d� mensagem de enviado
		{
		if (array_search($arqType, $arq_permitidos) === false) //verifica se o tipo de arquivo � word ou pdf
			{
				echo "<p><font color='red'>O tipo de arquivo selecionado para envio � inv�lido! S�o permitidos apenas documentos do MICROSOFT WORD ou PDF!</font></p>";
				echo "<a href='index.html'>VOLTAR</a>";
			}
			else //se for manda o arquivo
			{
			$nome = time(). "-".$id_orig. "-".$arqName; //nome alterado
				$pasta = "/home/u187528061/public_html/uploads/";
				$upload = move_uploaded_file($arqTemp, $pasta. $nome);
				echo "enviado!";
			}
		}
		
		*/#########################################
		
	//Aqui fazemos o envio dos dados para o BD
		
		mysql_connect("localhost", "root", "") or die (mysql_error());
		mysql_select_db("netdbtotal") or die (mysql_error());
		
		
		$id_orig = $_POST['originador'];
		$id_tratador = $_POST['posto_responsavel'];
		$data_orig = date("Y-m-d");
		$arqName = $_FILES['arquivo']['name']; //******esta linha tem que ser retirada depois!!!!!!
		$descritivo = $_POST['voucher'];
		$nome = time(). "-".$id_orig. "-".$arqName; //nome alterado ********TEM QUE SER ADAPTADO TAMBEM J� TEM L� EM CIMA
		if (($id_tratador == "Selecione") || empty($arqName)) //**********Tem que ser adaptado junto ao c�digo de envio do arquivo
		{
			echo "N�o foi poss�vel salvar. Voc� deve selecionar um arquivo v�lido e selecionar um posto v�lido.";
			echo "<a href='sysdoc_usuario.php'><p>Voltar</p></a>";
		}
		else
		{
		
		$StringSQL = "INSERT INTO tbluploadposto (posto_originador, posto_demanda_tratad, posto_data_orig, posto_tratador, posto_tratado, posto_data_tratado, posto_arquivo, posto_descritivo) VALUES ('$id_orig', '$id_tratador', '$data_orig', NULL, 0, NULL, '$nome', '$descritivo' )";
		
		$InsercaoSQL = mysql_query("$StringSQL") or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.");
		echo "Posto enviado com sucesso!";
		
		$retornaPosto = "SELECT posto_id, posto_arquivo, posto_descritivo FROM tbluploadposto ORDER BY posto_id DESC LIMIT 1"; //retorna o �ltimo registro
		
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
						
							
		
		echo '<meta HTTP-EQUIV="Refresh" CONTENT="20; URL=http://localhost/NET/sysdoc_usuario.php">';
		echo "<a href='sysdoc_usuario.php'><p>Voltar</p></a>";
		}
		
		
		
		
		
	

?>