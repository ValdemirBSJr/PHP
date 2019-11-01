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





mysql_connect("mysql.hostinger.com.br", "u187528061_valdb", "castelo0925") or die (mysql_error());
mysql_select_db("u187528061_netdb") or die (mysql_error());

//vamos pegar o indice do combobox principal
$escolha_busca = $_POST['perfil'];

if ($escolha_busca == 1)
{
$data = $_POST['data'];
//aqui pegamos a data e transformamos no formato mysql
list($dia,$mes,$ano) = explode("/",$data); //aqui usamos a funcao explode que divide uma string em array de acordo com um caractere
$dataMySQL = $ano."-".$mes."-".$dia;
//$dataVerificada = mysql_real_escape_string($dataMySQL); //verifica se há erros no que vai ser buscado


	$escolha_posto = $_POST['tratamento_pos_data']; //aqui pegamos o tipo de posto que ele quer
	if ($escolha_posto == 1) //com posto tratados
	{
	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_data_orig = '$dataMySQL' AND posto_tratado = 1";
	
	}
	elseif ($escolha_posto == 2) //com posto não tratados
	{
	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_data_orig = '$dataMySQL' AND posto_tratado = 0";
	}
	elseif ($escolha_posto == 3) //com posto não tratados
	{
	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_data_orig = '$dataMySQL'";
	
	}

}


elseif ($escolha_busca == 2) //busca por intevalo de data
{
	$dataini = $_POST['dataini'];
	$datafin = $_POST['datafin'];
	
	list($diaini,$mesini,$anoini) = explode("/",$dataini); //aqui explodimos a string pra reorganizar no formato padrão MYSQL
	list($diafin,$mesfin,$anofin) = explode("/",$datafin);
	
	$datainSQL = $anoini."-".$mesini."-".$diaini;
	$datafiSQL = $anofin."-".$mesfin."-".$diafin;
	
		if (strtotime($datafiSQL) < strtotime($datainSQL)) //aqui verificamos se a data final é maior que a inicial
		{
		$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_data_orig BETWEEN '$datainSQL' AND '$datafiSQL'";
			echo "Data Inválida! a data final tem que ser maior que a inicial. Favor verificar!";
			echo '<meta HTTP-EQUIV="Refresh" CONTENT="4; URL=http://www.psiti.w.pw/testenet/busca_posto.php">';
			echo "<a href='http://www.psiti.w.pw/testenet/busca_posto.php'><p>Voltar</p></a>";
		}
		else
		{
		$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_data_orig BETWEEN '$datainSQL' AND '$datafiSQL'";
		}
}

elseif ($escolha_busca == 3) //busca por voucher
{
	$posto = $_POST['voucher']; //aqui capto o número do posto unico VOUCHER
	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_descritivo LIKE '%$posto%'";
}

elseif ($escolha_busca == 4) //busca por id do processo
{
$posto_id = $_POST['id_busca']; 
	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_id = '$posto_id'";
}

elseif ($escolha_busca == 5) //busca por originador
{
$originador = $_POST['id_criador']; 
$data_orig = $_POST['data_criador'];

list ($diac, $mesc, $anoc) = explode("/", $data_orig);
$dataorig = $anoc."-".$mesc."-".$diac;

	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_originador = '$originador' AND posto_data_orig = '$dataorig'";
}

elseif ($escolha_busca == 6) //busca por tratador
{
$tratador = $_POST['id_tratador']; 
$data_trat = $_POST['data_tratador'];

list ($diat, $mest, $anot) = explode("/", $data_trat);
$dataotrat = $anot."-".$mest."-".$diat;

	$StringSQL = "SELECT * FROM tbluploadposto WHERE posto_demanda_tratad = '$tratador' AND posto_data_orig = '$dataotrat'";
}

	
	$conectarSQL = mysql_query($StringSQL) or die ("Erro no acesso ao servidor/BD. Contato o ADMINISTRADOR.".mysql_error());
	
	echo "<h1 align='center'>Resultado da pesquisa:</h1>";
	
	$linhas_pendencias = 0;
	

	echo "<table height='180' width='75%' style='border-collapse: collapse;  border-top: 4px solid #000000; border-bottom: 4px solid #000000'>";
	echo "<tr>";
	
	
	echo "<td><strong>ID do Processo</strong></td>";
	echo "<td><strong>Originador</strong></td>";
	echo "<td><strong>Data da origem</strong></td>";
	echo "<td><strong>Arquivo</strong></td>";
	echo "<td><strong>Descritivo</strong></td>";
	echo "<td><strong>Tratado pelo posto?</strong></td>";
	echo "<td><strong>Data do tratamento</strong></td>";
	echo "<td><strong>Posto Responsável</strong></td>";
	
	echo "</tr>";
	
	
	while ($StringSQL = mysql_fetch_array($conectarSQL))
	{
		if ($linhas_pendencias/2 == 0) //aqui testamos se a linha é par, se for, colore o fundo da tabela com azul
			{
				echo "<tr bgcolor='#ADD8E6' style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}
		else
			{
			
				echo "<tr style='border-collapse: collapse;  border-bottom: 2px solid #0000FF'>";
			}	
			$data_originado = $StringSQL["posto_data_orig"]; //aqui fazemos a conversão tbm para que a data apareça dd/mm/aaaa e não formato SQL. usamos a funcao strtotime pra tal
			$data_convertida = strtotime($data_originado);
			
			$data_tratamento = $StringSQL["posto_data_tratado"];
			$data_tratad_convertida = strtotime($data_tratamento);
			
				if ($data_tratad_convertida == null)
					{
						$data_trat = "-";
					}
				
				else
					{
						$data_trat = date('d/m/Y', $data_tratad_convertida);
					}
					
				
				
				$tratado = $StringSQL["posto_tratado"];
				
				if ($tratado == 0)
					{
						$tratad = "NAO";
					}
				else
					{
						$tratad = "SIM";
					}
	
		 
		echo "<td><input type='text' size='11' name='txt' value='".$id_posto = $StringSQL["posto_id"]."' Use readonly='true'></form></td>";
		echo "<td><a href='originador_posto.php' target='_blank' title='Clique para visualizar lista de originadores'>". $originador_posto = $StringSQL["posto_originador"]."</a></td>";
		echo "<td>". date('d/m/Y', $data_convertida)."</td>"; //aqui imputamos a data já convertida
		echo "<td><a href='http://www.psiti.w.pw/uploads/". $arquivo_posto = $StringSQL["posto_arquivo"]."' target='_blank' title='Clique no link para visualizar o documento'>CLIQUE AQUI</a></td>";
		echo "<td>". $descritivo_posto = $StringSQL["posto_descritivo"]."</td>";
		echo "<td>".$tratad."</td>";
		echo "<td>".$data_trat."</td>";
		echo "<td><a href='tratador_posto.php' target='_blank' title='Clique para visualizar lista de tratadores'>". $tratador_posto = $StringSQL["posto_tratador"]."</a></td>";
		
		
		echo "</tr>";
		$linhas_pendencias = $linhas_pendencias + 1; //contador das linhas para atribuir nomes aos forms
	}
	
	echo "</table>";


	

	mysql_free_result($conectarSQL);
	
	echo "<a href='busca_posto.php'><p>Voltar para busca</p></a>";

?>