<?php
     define('DIR_DOWNLOAD','/home/u187528061/public_html/uploads/'); //define o diretorio de dowload
        //$arquivo = $_GET['arquivo'];
       $arquivo = "Novo Documento de Texto.txt"; //aqui receberemos o valor por get como acima. Funcionando!!!!
 
 
        if(stripos($arquivo, './') !== false || stripos($arquivo, '../') !== false){ //aqui testa se voc� vai tentar baixar arquivos da pasta certa, n�o permitindo de outra
                exit('Opera��o DOWNLOAD inv�lida');
        }
        $arquivo = DIR_DOWNLOAD.$arquivo;
        if(!file_exists($arquivo)){
                exit('Opera��o DOWNLOAD inv�lida');
        }      
               
    header('Content-type: octet/stream');
    header('Content-disposition: attachment; filename="'.basename($arquivo).'";');
    header('Content-Length: '.filesize($arquivo));
    readfile($arquivo);
    exit;



?>