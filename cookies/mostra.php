<?php

if (isset($_COOKIE['cuqui'])) //verifiqua se o cookie existe
{
setcookie("cuqui", $_COOKIE['cuqui'], time() + 60 * 1); //cookie vive por um minuto
echo $_COOKIE['cuqui'];
}
else
{
echo "O cookie expirou";
}


?>