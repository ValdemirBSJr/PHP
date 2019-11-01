

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>
<link rel="shortcut icon" href="favicon.ico"type="image/x-icon"/>
<title>**USUÁRIO**</title>
<link href="format.css" rel="stylesheet" type="text/css" />



</head>

<body>


<ul class="menuhorizontal">
<li class="btnesquerdo"><a href="#">ARQUIVAR POSTO</a></li>
<li><a href="#">ARQUIVAR DOCUMENTO DIVERSO</a></li>
<li><a href="#">PESQUISAR</a></li>
<li><a href="#">SAIR</a></li>

</ul>

<br><br>
<h1>Sysdoc do usuário</h1>

	<form name="enviar_arquivo"method="post" action="upload_posto.php" enctype="multipart/form-data">
<fieldset>
	<label>Originador:
<input name="originador" type="text" tabindex="1" size="15" disabled value="Olá">
</label>
<label>data_originador:
<input name="data_originador" type="text" tabindex="2" size="16" value="<?php echo date("d/m/Y H:i:s", time()); ?>" disabled>
<label>Arquivo:
<input name="arquivo" type="file" tabindex="1" size="15">
</label>
<label>Voucher's do arquivo:
<input name="voucher" type="text" tabindex="1" size="15" placeholder="Aqui vai o voucher">
</label>

<p><input type="submit" name="Submit" value="Enviar" tabindex="3"></P>

</label>
</fieldset>
</form>
<a href="http://www.psiti.w.pw/uploads/formulas_excel(1).pdf" target="_blank">Download</a>

</body>

</html>