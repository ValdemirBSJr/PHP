<?php
if (isset($_POST['enviar']))
    {
        echo 'Nome: ' .$_POST['nome'].'<br>';
        echo 'Idade: ' . $_POST['idade']. '<br>';
    }
    
    class soma
    {
        
        public $saldo = 200;
        
        public function saldo()
        {
            
            echo "Este é seu saldo: " . $this ->saldo;
        }
        
        public function sacar ($valor)
        {
            if ($valor <= $this->saldo)
            {
                $this->saldo -=$valor;
                echo "Este é seu saldo: " .$this->saldo;
            }
        
        }

        
        
    }
    
    class contaPoupanca extends soma
    {
        //public function     
    }
    
    $conta = new soma();
    echo $conta->saldo()."<br>";
    
    echo $conta->sacar(100)."<br>";
?>
<html>
    
    <head></head>
    
    <body>
        
<?php

    $valor = 0;

    while ($valor < 5)
    {
    
    echo "Imprime valor de " . $valor . " a 5. </br>";
    
    $valor = $valor + 1;
    
    }

?>
    
    <form method="post" action="">
        Nome: <br>
        <input type="text" name="nome" /><br>
        Idade: <br>
        <input type="text" name="idade" /><br>
        <input type="submit" name="enviar" value="Enviar" /><br>
        
    </form>
        
        
    </body>
    
    
    
    
</html>