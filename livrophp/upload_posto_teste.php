<?php
if( $_SERVER['REQUEST_METHOD']=='POST' )
{
        var_dump( $_FILES );//apenas para debug
 
 
        $servidor = 'ftp.psiti.w.pw';
        $caminho_absoluto = '/home/u187528061/public_html/uploads/';
        $arquivo = $_FILES['arquivo'];
 
        $con_id = ftp_connect($servidor) or die( 'Não conectou em: '.$servidor );
        ftp_login( $con_id, 'u187528061.valdemir', 'castelo0925' );
 
        ftp_put( $con_id, $caminho_absoluto.$arquivo['name'], $arquivo['tmp_name'], FTP_BINARY );
		echo "enviado";
}

?>