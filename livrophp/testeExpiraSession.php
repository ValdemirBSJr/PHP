
<?php

/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(30);
$cache_expire = session_cache_expire();

/* Inicia a sessão */
session_start();
echo "O limitador de cache esta definido agora como $cache_limiter<br />"; 
echo "As sessões em cache irão expirar em $cache_expire minutos";
?>
