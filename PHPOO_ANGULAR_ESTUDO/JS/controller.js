/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//iniciamos a aplicação


var aplicativo = angular.module('meuApp', []);

//função que atribui a saida john doe
aplicativo.controller('meuController',  function($scope) {
    $scope.primeiroNome= "Zé";
    $scope.ultimoNome= "Ninguém";
    
  
});






