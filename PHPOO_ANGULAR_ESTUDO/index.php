<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="pt-br">
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ESTUDOS PHP OO E ANGULAR</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="JS/controller.js"></script>
    
    </head>
    <body>
        
        
         <!-- COMEÇO DA NAVBAR-->
      
      <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ESTUDOS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">ESTUDOS PÁGINA 2</a></li>
      
    </ul>
  </div>
     </nav>

      <!-- FIM DA NAVBAR-->
      
    <div class="jumbotron">
        <h1>VIVENDO E APRENDENDO</h1>
            <p>Bem-vindo e bons estudos</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Fazer algo</a></p>

    </div>
      
        
        
    
      
      
<p>Tente mudar os nomes.</p>

<div  ng-app="meuApp" ng-controller="meuController">

Primeiro Nome: <input type="text" ng-model="primeiroNome"><br>
Último Nome: <input type="text" ng-model="ultimoNome"><br>
<br>
Nome Completo: {{primeiroNome + " " + ultimoNome}}

</div>

<br>


        
        
        
        
        
        
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </body>
</html>
