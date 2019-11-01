<html>
<head>

</head>
<body background="background_<?php echo date("w"); ?>.jpg"> 
<?php 

echo "<p>O grupo data/hora atual é: " .date("r")."</p>"; 
echo "<p>O dia da semana atual é:  ".date("l")."</p>";
echo"<p>O número de segundos até hoje da data do meu nascimento (09/02/1984) é:  ".mktime(10,30,0,2,9,1984)."</p>";
echo "<p>Convertendo o valor de '445181400' em uma data não nerd (rsrsrsrs) Fica:  " .date("l",mktime(10,30,0,2,9,1884))."<sup>Mãe disse que tá errado rsrsrsrs nasci na quinta. Aonde tá o erro?</sup></p>";
echo "<p>O nome do dia da semana aparece ao fundo</p>";
?>
</body>
</html>