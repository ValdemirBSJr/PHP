<?php
session_start();
 if(!isset($_SESSION['NAMECLI']))
             {
              die("Para que você possa apagar um pedido, tem que primeiro selecionar um cliente válido");
             }
             
             else
             {
              
              



$indicePedidoArray = $_POST['idform'];
unset($_SESSION['CARRINHO'][$indicePedidoArray]);

			 }
?>
