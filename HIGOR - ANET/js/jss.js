//BEGIN OF SIDENAV


$( document ).ready(function(){//begin
   
        
        $(".button-collapse").sideNav();// end of sidenav
        
        $('.slider').slider({full_width: true}); //inicialize the slider
        
 $('.imgPop').magnificPopup({type:'image'});
        
        //MASKS JQUERY
        $("#fone").mask("(00) 0000-00009");
        $("#fone2").mask("(00) 0000-00009");
        $("#numero").mask("0000000000");
        $("#troco").maskMoney({symbol:"R$ ",showSymbol:true, decimal:",",thousands:"."})
        
        //END MASKS
        
        //BEGIN TROCO
          $('#queroTroco').click(function() {
        if ($(this).is(':checked')) {
            $('#divTroco').show('fast');
        }
        else
        {
            $('#divTroco').hide('fast');
            $('#troco').val("");
        }
    });
        
        //END TROCO
        
        
         //BEGIN SENHAS
          $('#alterSenha').click(function() {
        if ($(this).is(':checked')) {
            $('#senhas').show('fast');
        }
        else
        {
            $('#senhas').hide('fast');
            
        }
    });
        
        //END SENHAS
        
       //FUNCTION RETURN USER
        $("#loginCli").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        var email = $('#emailLogin').val();
        var senha = $('#senhaLogin').val();
        $(".loading").toggle();
        
		$.post('verifyLogin.php',{clienteEmail:email, clienteSenha:senha},
		function call_back(data){
			$("#resultLogin").html(data);
            
            //GET NAME OF USER
            var nameUser = $("#resultName").attr("value");
            
            
            if (typeof nameUser != 'undefined') {
                $("#loginResultName").html("Ol&aacute, " + nameUser + "!");
                $("#loginResultNave").html("Ol&aacute, " + nameUser + "!");
                $("#basket").attr("onclick", "$('#modalCostumers').openModal();");
                $("#cart").attr("href", "carrinho.php");
                $("#cart").attr("onclick", "");
                $("#cartSidenav").attr("href", "carrinho.php");
                $("#cartSidenav").attr("onclick", "");
                $("#cad").attr("onclick", "$('#iflog').openModal();");
                $("#cadSidenav").attr("onclick", "$('#iflog').openModal();");
                $("#cad").attr("href", "#");
                $("#cadSidenav").attr("href", "#");
                $(".returnClientName").html(nameUser);
                
                Materialize.toast('Bem-vindo '+nameUser+'! Aproveite nossos sushis!', 3000, 'rounded');
                window.setTimeout(function aguardaMensagem() { window.location.replace("/index");}, 3000);
                
            }
            if (typeof nameUser == 'undefined')
            {
               Materialize.toast('Login ou senha inválida! Tente novamente.', 3000, 'rounded');
                window.setTimeout(function aguardaMensagem() { window.location.replace("/index");}, 3000); 
            }
           
            
            //END GET NAME OF USER
            $(".loading").toggle();
              //$('.button-collapse').sideNav('show');
             // location.reload();  //Estou recarregando a página pra evitar bug das mensagens duplicadas, Esse bug é do materialize nunca mais usar saporra
           //Materialize.toast('Bem-vindo '+nameUser+'! Aproveite nossos sushis!', 3000, 'rounded');
          // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 3000);
           //$('.page-content').load('index.php .page-content');
           
		});
        
	});// END FUCTION RETURN USER
        
        
        
        //FUNCTION LOGOUT
        $(".logout").click(function() {		
        
		$.post('logout.php',{},
		function call_back(data){
			$("#resultLogin").html(data);
            
            //GET NAME OF USER
            var nameUser = $("#resultName").attr("value");
            
            if (typeof nameUser != 'undefined' || nameUser !='logoutSucefull') {
                $("#loginResultName").html("Login/Cadastro");
                $("#loginResultNave").html("Login/Cadastro");
                $("#basket").attr("onclick", "$('#ifnotlog').openModal();");
                $("#cart").attr("href", "#");
                $("#cart").attr("onclick", "$('#ifnotlog').openModal();");
                $("#cartSidenav").attr("href", "#");
                $("#cartSidenav").attr("onclick", "$('#ifnotlog').openModal();");
                
                //window.location.replace("index.php"); //redirect page
                
                
                $('.button-collapse').sideNav('hide');
                
                Materialize.toast('Logout efetuado com sucesso!', 3000, 'rounded');
                window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 3000);
            }
            
                
              
		});
        
        this.off("click");
        
	});// END LOGOUT
        
        
        
        
        //FUNCTION VERIFY USER
        $("#UserFormButton").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        
        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val();
        var endereco = $('#endereco').val();
        var numero = $('#numero').val();
        var complemento = $('#complemento').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confsenha = $('#confSenha').val();
        
       // $(".loading").toggle();
       
       
      if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() =="" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "" || $('#senha').val() == "" || $('#confSenha').val() == "" || $('#senha').val() != $('#confSenha').val())
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        CalculaDistancia();
        
        $('#nameUser').html(nome + " "+ sobrenome);
        $('#addressUser').html(endereco);
        $('#numberAddress').html(numero);
        $('#complUser').html(complemento);
        $('#emailUser').html(email);
        $('#foneUser').html(fone);
        $('#fone2User').html(fone2);
        
        $('#UserCad').openModal();
        
        ///////AQUI
		//$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, Fone:fone, Fone2:fone2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Senha:senha, ConfSenha:confsenha},
		//function call_back(data){
		//	$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER
            //$(".loading").toggle();
              //$('.button-collapse').sideNav('show');
              
           
	//	});
        ///////AQUI
       }
        
	});// END FUCTION VERIFY USER
        
        
        
    //BEGIN REGISTER USER
     $("#userCadForm").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        //opcao da pesquisa do arquivo
        var opcao = 1;
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val().replace(/[^\d]+/g,'');
        
        var foneFormat = fone.replace(/[^\d]+/g,'');
        var foneFormat2 = fone2.replace(/[^\d]+/g,'');
        
        var endereco = $('#endereco').val().trim();
        var numero = $('#numero').val().trim();
        var complemento = $('#complemento').val().trim();
        var email = $('#email').val().trim();
        var senha = $('#senha').val().trim();
        var confsenha = $('#confSenha').val().trim();
        
       // $(".loading").toggle();
        
            
      if (($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "" || $('#senha').val() == "" || $('#confSenha').val() == "") || $('#senha').val() != $('#confSenha').val())
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        
        
        var distancia = $('#distancia').html();
        var tempo = $('#tempo').html();
        var endGoogle = $('#endGoogle').html();
        
		$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, Fone:foneFormat, Fone2:foneFormat2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Senha:senha, Distancia:distancia, Tempo:tempo, EndGoogle:endGoogle},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER
            //$(".loading").toggle();
              $('.button-collapse').sideNav('hide');
              
           
		});
        
        $('#nome').val("");
        $('#sobrenome').val("");
        $('#fone').val("");
        $('#fone2').val("");
        $('#endereco').val("");
        $('#numero').val("");
        $('#complemento').val("");
        $('#email').val("");
        $('#senha').val("");
        $('#confSenha').val("");
        $('#senha').val("") ;
        $('#confSenha').val("");
        
        window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 7000); //função que espera 3 segundos antes de redirecionar
            
        
       }
        
	});// END FUCTION REGISTER USER
     
        
  //FUNCTION ADD ON CART
  $("button.waves-effect").on('click', function(e){
        
        var nameUser = $("#resultName").attr("value");
        var idButton = $(this).attr("id");
        var qtCart = $("#range"+idButton).val();
       var total = $('#coin' + idButton).html().replace(',','.');
       
       if (typeof $('#StatusSelect'+idButton).attr('class') != 'undefined') {
        
        var descriptSushi = $('#title' + idButton).html() + ' de ' + $('#StatusSelect'+idButton+' option:selected').text();
        
       }
       else {
       
       var descriptSushi = $('#title' + idButton).html();
       
       }
       
       
      if (typeof nameUser == 'undefined') {
         
                         
        Materialize.toast('Voc&ecirc deve estar logado para realizar pedidos!', 3000, 'rounded');
        
       
        
            }
            else {
                
                if ($('#StatusSelect'+idButton+' option:selected').val() == "noSelect") {
        Materialize.toast('Voc&ecirc deve selecionar um tipo desse pedido antes!', 3000, 'rounded');
       }
       
       else {
                
                $.post('insertCart.php',{IdPedido:idButton, Qtde:qtCart, PedidoTotal:total, Descricao:descriptSushi},
		function call_back(data){
			$("#resultLogin").html(data);
            
                Materialize.toast(nameUser + ', Seu pedido foi adicionado ao carrinho! Pedido: ' +descriptSushi + '. Valor R$: ' +total +'.>> <a class="waves-effect waves-light red darken-2 btn" href="carrinho.php">IR PARA O CARRINHO</a>', 5000, 'rounded');
                
                
                 });
                
                var count = parseInt($("#cartBadge").html());
                  
                 if (count == 0) {
                         
                        $("#sushis").html(1);
                        
                        $("#cartBadge").html(1);
                        $("#cartSidenavBadge").html(1);
                         $("#cartBadge").attr("class","new badge red darken-1");
                        $("#cartSidenavBadge").attr("class","new badge red darken-1");
                }
                
   
                else  {
                        //var valueSushi = parseInt($("#sushis").html());
                        //var countSushi = valueSushi + 1;
                        count ++;
                        $("#sushis").html(count);
                        $("#cartBadge").html(count);
                        $("#cartSidenavBadge").html(count);
                        
                }
              
                        
       }
                
            }
            
    });
//END FUNCTION CART


//BEGIN IMPUT NAME ON MODAL OF LOGIN
$("#cad, #cadSidenav").click(function() {

        //GET NAME OF USER
            var nameUser = $("#resultName").attr("value");
        
        if (typeof nameUser != 'undefined') {
                $(".returnClientName").html(nameUser);
                $("#loginResultNave").html(nameUser);
                
            }

});
//END IMPUT NAME ON MODAL OF LOGIN
 
 //GET VALUE OF RANGE AND MULTIPLY THAT       
$("input[type='range']" ).on('mouseup', function () {
    
    var idRange = $(this).attr("id");
    
    var numsStr = idRange.replace(/[^0-9]/g,''); //get only numbers
    
    var qtde = parseFloat(this.value);
    
    var valueUnitBrute = $('#coin' + numsStr).html(); 
    var valueUnitBruteReplace =   valueUnitBrute.replace(',','.'); //transform string in float value acept again
        
    
   if ($('#resultado' + numsStr).html() == "") {
    var valueUnit = parseFloat(valueUnitBruteReplace);
    var results = valueUnit * qtde;
    
    $('#coin' + numsStr).html(converterFloatReal(results));
    $('#resultado' + numsStr).html(valueUnit);
    $('#qtdeCart' + numsStr).html(qtde);
   }
   
   if ($('#resultado' + numsStr).html() != "") {
    var valueUnit = parseFloat($('#resultado'+ numsStr).html());
    var results = valueUnit * qtde;
    
    $('#coin' + numsStr).html(converterFloatReal(results));
     $('#qtdeCart' + numsStr).html(qtde);
     
     
   }
    
    
    
    
    
    
}); 
  //END OF RANGE GET      
        
       
       //BEGIN CART EDIT
    $(".modal-trigger").on('click', function(e){

     var idLine = $(this).attr("id");
     $("#line"+ idLine).hide("slow");
     
     var totalGeralBrute = $("#totalGeral").html().replace(',','.');
     var linharetiradaBrute = $("#coin"+idLine).html().replace(',','.');
     
     var totalGeral = parseFloat(totalGeralBrute);
     var linharetirada = parseFloat(linharetiradaBrute);
     var valorSubtraido = totalGeral - linharetirada;
     
     if (valorSubtraido < 0) {
		  valorSubtraido = 0;
		}
        
        $("#totalGeral").html(converterFloatReal(valorSubtraido));
        $("#totalGeralPagamento").html(converterFloatReal(valorSubtraido));
        $("#totalGeralMaquineta").html(converterFloatReal(valorSubtraido));
        
        
        var count = parseInt($("#cartBadge").html());
        
           
                 if (count <= 1) {
                         
                        $("#sushis").html(0);
                        
                        $("#cartBadge").html(0);
                        $("#cartSidenavBadge").html(0);
                         $("#cartBadge").attr("class","badge transparent hide");
                        $("#cartSidenavBadge").attr("class","badge transparent hide");
                }
                
                
                else if (count > 1)  {
                        //var valueSushi = parseInt($("#sushis").html());
                        //var countSushi = valueSushi + 1;
                        count --;
                        $("#sushis").html(count);
                        $("#cartBadge").html(count);
                        $("#cartSidenavBadge").html(count);
                        
                }
                
                
     $.post('deleteCart.php',{idform:idLine},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
             Materialize.toast('Pedido retirado do carrinho!', 3000, 'rounded'); 
           
		});
     

    });
//end CARTEDIT
        
        
        //BEGIN FUCTION FINISHIED CAR
      $("#cartFinish").click(function() {
                 
              $("#cartPage").hide("fast");
              $("#cartPayment").show("fast");
           
		});
      
       $("#returnCart").click(function() {
                 
              $("#cartPayment").hide("fast");
              $("#cartPage").show("fast");
           
		});
      
      //END  FUCTION FINISHIED CAR
      
      
      
      //BEGIN FUCTION FINALIZE BUY
     $("#pagamentoDinheiro, #pagamentoMaquineta").click(function() {
        
        $("#loading2").show();
        
        //opcao da pesquisa do arquivo
        var opcao = 2;
        
        var modalidade = $(this).attr('id');
        
        if (modalidade == "pagamentoMaquineta") {
            
            var opcaoPagamento = 1;    
                
            var totalBrute = $("#totalGeralMaquineta").html().replace(',','.');
            var total = parseFloat(totalBrute);
            var troco = 0;
            var freteBrute = $("#freteCarrinho").html();
            var freteFloat = freteBrute.replace(',','.');
            var frete = parseFloat(freteFloat);
            
              $.post('bdEngine.php',{opcaoSQL:opcao, Troco:troco, Total:total, Frete:frete, OpcaoPagamento:opcaoPagamento},
		function call_back(data){
			$("#resultLogin").html(data);
                          
           $("#cartPayment").hide("fast");              
           $("#finishPayment").show("fast"); 
          window.setTimeout(function aguardaMensagem() {$("#modalCostumers").load("insertCostumers.php", $("#modalCostumers").openModal());}, 3000);
           Materialize.toast('Pedido realizado com sucesso! Acompanhe a entrega do seu pedido na cesta! ', 3000, 'rounded');
           
           $("#cartBadge").attr("class","badge transparent hide");
           $("#cartSidenavBadge").attr("class","badge transparent hide");
           
           $("#loading2").hide();
           
		});
        }
        if (modalidade =="pagamentoDinheiro") {
                
                var opcaoPagamento = 0;
           
           if (($("#queroTroco").is(":checked") && $('#troco').val() != "")) {
                
             var trocoBrute = $('#troco').val().replace(',','.'); 
             var troco = parseFloat(trocoBrute);
             var freteBrute = $("#freteCarrinho").html();
             var freteFloat = freteBrute;
             var frete = parseFloat(freteFloat);
             var totalBrute = $("#totalGeralPagamento").html().replace(',','.');
             var total = parseFloat(totalBrute);
             
                if (troco <= total) {
                Materialize.toast('O valor do troco deve ser maior do que o do pedido!', 3000, 'rounded');
                this.off("click");
               }
                else {
                
                   $.post('bdEngine.php',{opcaoSQL:opcao, Troco:troco, Total:total, Frete:frete, OpcaoPagamento:opcaoPagamento},
		function call_back(data){
			$("#resultLogin").html(data);
                          
            $("#cartPayment").hide("fast");              
           $("#finishPayment").show("fast");
           window.setTimeout(function aguardaMensagem() {$("#modalCostumers").load("insertCostumers.php", $("#modalCostumers").openModal());}, 3000);
           Materialize.toast('Pedido realizado com sucesso! Acompanhe a entrega do seu pedido na cesta! ', 3000, 'rounded');
           
           $("#cartBadge").attr("class","badge transparent hide");
           $("#cartSidenavBadge").attr("class","badge transparent hide");
           
           $("#loading2").hide();
           
		});
             }
             
             
             
                
           }
           if (($("#queroTroco").is(":checked") && $('#troco').val() == "")) {
                
            Materialize.toast('Favor informar o valor do troco!', 3000, 'rounded');
                      this.off("click");  
                
           }
           
           if (!$("#queroTroco").is(":checked")) {
                
             var troco = 0;
             var freteBrute = $("#freteCarrinho").html();
             var freteFloat = freteBrute.replace(',','.');
             var frete = parseFloat(freteFloat);
             var totalBrute = $("#totalGeralPagamento").html().replace(',','.');
             var total = parseFloat(totalBrute);
                
                 $.post('bdEngine.php',{opcaoSQL:opcao, Troco:troco, Total:total, Frete:frete, OpcaoPagamento:opcaoPagamento},
		function call_back(data){
			$("#resultLogin").html(data);
            
            $("#cartPayment").hide("fast");              
           $("#finishPayment").show("fast");
           window.setTimeout(function aguardaMensagem() {$("#modalCostumers").load("insertCostumers.php", $("#modalCostumers").openModal());}, 3000);
           Materialize.toast('Pedido realizado com sucesso! Acompanhe a entrega do seu pedido na cesta! ', 3000, 'rounded');
           
           $("#cartBadge").attr("class","badge transparent hide");
           $("#cartSidenavBadge").attr("class","badge transparent hide");
           
           $("#loading2").hide();
           
           
		});
                
             
            
           }
                
            
             
           
        }
//           
           
        
        
        
        
       
        
	});// END FUCTION FINALIZE BUY
      
     
     //BEGIN SHOW MODAL COSTUMERS
$("#basket, #basketSidenav").click(function() {

        $("#modalCostumers").load("insertCostumers.php", $("#modalCostumers").openModal());

});
//END SHOW MODAL COSTUMERS
      
   
   //FUNCTION VERIFY USER ALTER
        $("#UserFormButtonAlter").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        
        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val();
        var endereco = $('#endereco').val();
        var numero = $('#numero').val();
        var complemento = $('#complemento').val();
        var email = $('#email').val();
        var senha = $('#senha').val();
        var confsenha = $('#confSenha').val();
        
       // $(".loading").toggle();
       
       
     if ($("#alterSenha").is(":checked")) {
                
                var subOpcao = 0;
                
                if (($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "" || $('#senha').val() == "" || $('#confSenha').val() == "") || $('#senha').val() != $('#confSenha').val())
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        CalculaDistancia();
        
       $('#nameUser').html(nome + " "+ sobrenome);
        $('#addressUser').html(endereco);
        $('#numberAddress').html(numero);
        $('#complUser').html(complemento);
        $('#emailUser').html(email);
        $('#foneUser').html(fone);
        $('#fone2User').html(fone2);
        
        $('#UserCad').openModal();
              
           
        
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
            
        
       }
                
        }
        if (!$("#alterSenha").is(":checked")) {
                
                var subOpcao = 1;
                
                if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "")
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        CalculaDistancia();
        
        $('#nameUser').html(nome + " "+ sobrenome);
        $('#addressUser').html(endereco);
        $('#numberAddress').html(numero);
        $('#complUser').html(complemento);
        $('#emailUser').html(email);
        $('#foneUser').html(fone);
        $('#fone2User').html(fone2);
        
        $('#UserCad').openModal();
        
       }
       
        }
        
	});// END FUCTION VERIFY USER ALTER
   
   
    //BEGIN ALTER USER
     $("#UserRecForm").click(function() {
                // $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        //opcao da pesquisa do arquivo
        var opcao = 3;
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val().replace(/[^\d]+/g,'');
        
        var foneFormat = fone.replace(/[^\d]+/g,'');
        var foneFormat2 = fone2.replace(/[^\d]+/g,'');
        
        var endereco = $('#endereco').val().trim();
        var numero = $('#numero').val().trim();
        var complemento = $('#complemento').val().trim();
        var email = $('#email').val().trim();
        var senha = $('#senha').val().trim();
        var confsenha = $('#confSenha').val().trim();
        
       // $(".loading").toggle();
       
        if ($("#alterSenha").is(":checked")) {
                
                var subOpcao = 0;
                
                if (($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "" || $('#senha').val() == "" || $('#confSenha').val() == "") || $('#senha').val() != $('#confSenha').val())
                        {
                         $('#ifnotvalidate').openModal();
                        }
       else
       {
        
        var distancia = $('#distancia').html();
        var tempo = $('#tempo').html();
        var endGoogle = $('#endGoogle').html();
        
		$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, SubOpcao:subOpcao, Fone:foneFormat, Fone2:foneFormat2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Senha:senha, Distancia:distancia, Tempo:tempo, EndGoogle:endGoogle},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER
            //$(".loading").toggle();
              $('.button-collapse').sideNav('hide');
              
           
		});
        
        $('#nome').val("");
        $('#sobrenome').val("");
        $('#fone').val("");
        $('#fone2').val("");
        $('#endereco').val("");
        $('#numero').val("");
        $('#complemento').val("");
        $('#email').val("");
        $('#senha').val("");
        $('#confSenha').val("");
        $('#senha').val("") ;
        $('#confSenha').val("");
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
         this.off("click");    
        
       }
                
        }
        if (!$("#alterSenha").is(":checked")) {
                
                var subOpcao = 1;
                
                if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "")
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        var distancia = $('#distancia').html();
        var tempo = $('#tempo').html();
        var endGoogle = $('#endGoogle').html();
        
		$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, SubOpcao:subOpcao, Fone:foneFormat, Fone2:foneFormat2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Senha:senha, Distancia:distancia, Tempo:tempo, EndGoogle:endGoogle},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER
            //$(".loading").toggle();
              $('.button-collapse').sideNav('hide');
              
           
		});
        
        $('#nome').val("");
        $('#sobrenome').val("");
        $('#fone').val("");
        $('#fone2').val("");
        $('#endereco').val("");
        $('#numero').val("");
        $('#complemento').val("");
        $('#email').val("");
        $('#senha').val("");
        $('#confSenha').val("");
        $('#senha').val("") ;
        $('#confSenha').val("");
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
            
        
       }
                
        }
        
            
        
	});// END FUCTION ALTER USER
   
   
      //BEGIN FUCTION FORGOT PASSWORD
      $("#lostPass").click(function() {
                 
              $("#formLogin").hide("fast");
              $("#loginCli").hide("fast");
              $("#lostPass").hide("fast");
              
              
              $("#formForgotPass").attr("class","col s12");
              $("#recoverPass").attr("class","modal-action modal-close waves-effect waves-green btn red darken-2 hoverable");
              
              $("#titleLogin").html("Recupera&ccedil&atildeo de senha");
              $("#exampleLogin").html("Digite seu email cadastrado em nosso site que enviaremos um email para mudan&ccedila de senha, em seguide clique em recuperar a senha.");
              $("#resultRequestPass").html("");
              
              $('#emailForgotPass').val("");
              
		});
      
       $("#returnPass").click(function() {
                 
              $("#loginCli").show("fast");
              $("#formLogin").show("fast");
              $("#lostPass").show("fast");
           
              $("#formForgotPass").attr("class","col s12 hide");
              $("#recoverPass").attr("class","modal-action modal-close waves-effect waves-green btn red darken-2 hoverable hide");
              
              $("#titleLogin").html("Login de usu&aacuterios");
              $("#exampleLogin").html("Logue para continuar");
              
              $("#resultRequestPass").html("");
              
               $('#emailForgotPass').val("");
              
		});
      
      //END  FUCTION FORGOT PASSWORD
      
      
      //FUNCTION REQUEST NEW PASSWORD 
        $("#recoverPass").click(function() {
                 //$('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
         $("#loading2").show(); 
        
        var email = $('#emailForgotPass').val();
        var opcao = 0;
       // $(".loading").toggle();
        
		$.post('bdEngine.php',{clienteEmail:email, opcaoSQL:opcao},
		function call_back(data){
			$("#resultRequestPass").html(data);
            
            $("#loading2").hide(); 
           
		});
        
	});// END FUCTION REQUEST NEW PASSWORD
        
        
         //FUNCTION SUCESS NEW PASSWORD 
        $("#UserFormButtonAlterPass").click(function() {
                 //$('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        var senha = $('#senha').val();
        var confSenha = $('#confSenha').val();
        var opcao = 4;
        var token = $("#token").html();
        var code = $("#code").html();
       // $(".loading").toggle();
       
       if ((senha == "" || confSenha == "") || senha != confSenha)
       {
         $('#ifnotvalidate').openModal();
       }
       else
       {
        
                 $.post('bdEngine.php',{clienteSenha:senha, opcaoSQL:opcao, Code:code, Token:token},
                        function call_back(data){
                        $("#resultConfPass").html(data);
            
           
                        });
        
         this.off("click");    
       }
        
		
        
	});// END FUCTION SUCESS NEW PASSWORD 
      
      
     
     //FUNCTION ADMIN LOGIN
        $("#loginAdmin").click(function() {
                 //$('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        var login = $('#adminLogin').val().trim();
        var senha = $('#senhaLogin').val().trim();
        var opcao = 5;
       // $(".loading").toggle();
        
		$.post('bdEngine.php',{AdmLogin:login, AdmSenha:senha, opcaoSQL:opcao},
		function call_back(data){
			$("#resultLogin").html(data);
            
            //GET NAME OF USER
            var nameUser = $("#resultName").attr("value");
            
            
            if (typeof nameUser != 'undefined') {
                
                
                Materialize.toast('Bem-vindo '+nameUser+'!', 3000, 'rounded');
                window.setTimeout(function aguardaMensagem() { window.location.replace("administraCpanel.php");}, 3000);
                
            }
            if (typeof nameUser == 'undefined')
            {
               Materialize.toast('Login ou senha inválida! Tente novamente.', 3000, 'rounded');
                //window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 3000);
                 this.off("click");
            }
            
           
		});
        
        this.off("click");
        
	});// END FUCTION ADMIN LOGIN
     
      
      
      //BEGIN OPEN CLOSE STORE
      
      $('#abreFecha').change(function() {
        
        var opcao = 6;
        
        if($(this).is(":checked")) {
            var returnVal = 1;
            //$(this).attr("checked", returnVal);
        }
        else
        {
             var returnVal = 0;    
        }
        
        $.post('bdEngine.php',{opcaoSQL:opcao, Retorno:returnVal},
                        function call_back(data){
                        $("#resultMarket").html(data);
            
           
                        });
        
        
             
    });
      
      //END OPEN CLOSE STORE
      
      
        //BEGIN EDIT BUY
    $(".btn-floating").on('click', function(e){

     var idLine = $(this).attr("id");
     var idStatusPedido = $('#StatusPedido' + idLine).val();
     var time = $("#time" + idLine).val().trim();
     var opcao = 7;
                
      //alert(idLine +", " + idStatusPedido +", " + time + ", " + opcao);          
     $.post('bdEngine.php',{idform:idLine, opcaoSQL:opcao, idStatusPedido:idStatusPedido, Time: time},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
             Materialize.toast('Pedido atualizado.', 2000, 'rounded');
             
            // window.setTimeout(function aguardaMensagem() { window.location.replace("administraCpanel.php");}, 3000);
           
		});
     
this.off("click");
     
    });
//end  EDIT BUY
      
      
      
      //FUNCTION RETURN CLIENT BY ADMIN
        $("#searchClient").click(function() {
                 //$('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        var fone = $('#clienteConsulta').val();
        var opcao = 8;
       // $(".loading").toggle();
        
		$.post('bdEngine.php',{Fone:fone, opcaoSQL:opcao},
		function call_back(data){
			$("#resultClient").html(data);
            
           
		});
        
	});// END CONFIRM CLIENT BY ADMIN
      
      
      
            //FUNCTION RETURN CLIENT BY ADMIN
        $("#confirmClient").click(function() {
                 //$('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        var idCli = $('#idCli').html();
        var opcao = 9;
       // $(".loading").toggle();
        
		$.post('bdEngine.php',{IDCLI:idCli, opcaoSQL:opcao},
		function call_back(data){
			$("#resultClient").html(data);
            
            var nameUser = $("#resultNameAdm").attr("value");
            
            
            if (typeof nameUser != 'undefined') {
                
                
                Materialize.toast('Cliente escolhido: '+nameUser+'!', 2000, 'rounded');
                window.setTimeout(function aguardaMensagem() { window.open("index.php", "_blank");}, 2000);
                
            }
            if (typeof nameUser == 'undefined')
            {
               Materialize.toast('Cliente invalido!!!.', 3000, 'rounded');
                //window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 3000);
                 
            }
            
           
		});
        
        $('#returnClientModal').closeModal();
        this.off("click");
        
	});// END CONFIRM CLIENT BY ADMIN
      
      
       //FUNCTION VERIFY BY ADM
        $("#UserFormButtonADMVERIFY").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        
        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val();
        var endereco = $('#endereco').val();
        var numero = $('#numero').val();
        var complemento = $('#complemento').val();
        var email = $('#email').val();
        //var senha = $('#senha').val();
       // var confsenha = $('#confSenha').val();
        
       // $(".loading").toggle();
       
       
      if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() =="" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "")
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        CalculaDistancia();
        
        $('#nameUser').html(nome + " "+ sobrenome);
        $('#addressUser').html(endereco);
        $('#numberAddress').html(numero);
        $('#complUser').html(complemento);
        $('#emailUser').html(email);
        $('#foneUser').html(fone);
        $('#fone2User').html(fone2);
        
        $('#UserCad').openModal();
        
        ///////AQUI
		//$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, Fone:fone, Fone2:fone2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Senha:senha, ConfSenha:confsenha},
		//function call_back(data){
		//	$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER
            //$(".loading").toggle();
              //$('.button-collapse').sideNav('show');
              
           
	//	});
        ///////AQUI
       }
       //$("#loading2").hide();
        this.off("click");
        
	});// END FUCTION VERIFY BY ADM
      
      
      
       //BEGIN REGISTER USER BY ADM
     $("#userCadFormByAdm").click(function() {
                // $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        $("#loading2").show();
        
        //opcao da pesquisa do arquivo
        var opcao = 10;
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val().replace(/[^\d]+/g,'');
        
        var foneFormat = fone.replace(/[^\d]+/g,'');
        var foneFormat2 = fone2.replace(/[^\d]+/g,'');
        
        var endereco = $('#endereco').val().trim();
        var numero = $('#numero').val().trim();
        var complemento = $('#complemento').val().trim();
        var email = $('#email').val().trim();
        //var senha = $('#senha').val().trim();
        //var confsenha = $('#confSenha').val().trim();
        
       // $(".loading").toggle();
        
            
      if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "")
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
        
        
        
        var distancia = $('#distancia').html();
        var tempo = $('#tempo').html();
        var endGoogle = $('#endGoogle').html();
        
		$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, Fone:foneFormat, Fone2:foneFormat2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Distancia:distancia, Tempo:tempo, EndGoogle:endGoogle},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
            
        $('#nome').val("");
        $('#sobrenome').val("");
        $('#fone').val("");
        $('#fone2').val("");
        $('#endereco').val("");
        $('#numero').val("");
        $('#complemento').val("");
        $('#email').val("");
            
            //END GET NAME OF USER
            //$(".loading").toggle();
             // $('.button-collapse').sideNav('hide');
              
           $("#loading2").hide(); 
		});
        
        
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
           
        
       }
       
       $('#UserCad').closeModal();
       
       this.off("click");
        
	});// END FUCTION REGISTER USER BY ADM
      
      
       //FUNCTION VERIFY USER ALTER BY ADM
        $("#UserFormButtonAlterAdm").click(function() {
                 $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        
        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val();
        var endereco = $('#endereco').val();
        var numero = $('#numero').val();
        var complemento = $('#complemento').val();
        var email = $('#email').val();
        
        
       // $(".loading").toggle();
       
       
                
        
     if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "" )
      {
        $('#ifnotvalidate').openModal();
      }
       else
       {
       
        CalculaDistancia();
        
       $('#nameUser').html(nome + " "+ sobrenome);
        $('#addressUser').html(endereco);
        $('#numberAddress').html(numero);
        $('#complUser').html(complemento);
        $('#emailUser').html(email);
        $('#foneUser').html(fone);
        $('#fone2User').html(fone2);
        
        $('#UserCad').openModal();
              
           
        
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
            
        
       }
                
        
        
	});// END FUCTION VERIFY USER ALTER ADM
      
      
      //BEGIN ALTER USER BY ADM
     $("#UserRecFormAdm").click(function() {
                // $('.button-collapse').sideNav('hide');
		//var texto = document.getElementById("clienteConsulta").value;
        
        
        //opcao da pesquisa do arquivo
        var opcao = 3;
        var nome = $('#nome').val().trim();
        var sobrenome = $('#sobrenome').val().trim();
        var fone = $('#fone').val();
        var fone2 = $('#fone2').val().replace(/[^\d]+/g,'');
        
        var foneFormat = fone.replace(/[^\d]+/g,'');
        var foneFormat2 = fone2.replace(/[^\d]+/g,'');
        
        var endereco = $('#endereco').val().trim();
        var numero = $('#numero').val().trim();
        var complemento = $('#complemento').val().trim();
        var email = $('#email').val().trim();
        
       // $(".loading").toggle();
       
       
                
                if ($('#nome').val() == "" || $('#sobrenome').val() == "" || $('#fone').val() == "" || $('#fone2').val() == "" || $('#endereco').val() == "" || $('#numero').val() == "" || $('#complemento').val() == "" || $('#email').val() == "")
                        {
                         $('#ifnotvalidate').openModal();
                        }
      
        var subopcao = 1;
        var distancia = $('#distancia').html();
        var tempo = $('#tempo').html();
        var endGoogle = $('#endGoogle').html();
        
		$.post('bdEngine.php',{Nome:nome, Sobrenome:sobrenome, opcaoSQL:opcao, SubOpcao:subopcao, Fone:foneFormat, Fone2:foneFormat2, Endereco:endereco, Numero:numero, Complemento:complemento, Email:email, Distancia:distancia, Tempo:tempo, EndGoogle:endGoogle},
		function call_back(data){
			$("#resultLogin").html(data);
            
            
            
           
            
            //END GET NAME OF USER BY ADM
            //$(".loading").toggle();
              $('.button-collapse').sideNav('hide');
              
           
		});
        
        $('#nome').val("");
        $('#sobrenome').val("");
        $('#fone').val("");
        $('#fone2').val("");
        $('#endereco').val("");
        $('#numero').val("");
        $('#complemento').val("");
        $('#email').val("");

        $('#UserCad').closeModal();
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
         this.off("click");    
        
       
       
        
       // window.setTimeout(function aguardaMensagem() { window.location.replace("index.php");}, 5000); //função que espera 3 segundos antes de redirecionar
            
      
        
	});// END FUCTION ALTER USER BY ADM
      
      
      
      
      
      
        
        });//end READY FUNCTION


function converterFloatReal(valor){
  var inteiro = null, decimal = null, c = null, j = null;
  var aux = new Array();
  valor = ""+valor;
  c = valor.indexOf(".",0);
  //encontrou o ponto na string
  if(c > 0){
     //separa as partes em inteiro e decimal
     inteiro = valor.substring(0,c);
     decimal = valor.substring(c+1,valor.length);
     if(decimal.length === 1) {
decimal += "0";
}
  }else{
     inteiro = valor;
  }
   
  //pega a parte inteiro de 3 em 3 partes
  for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
     aux[c]=inteiro.substring(j-3,j);
  }
   
  //percorre a string acrescentando os pontos
  inteiro = "";
  for(c = aux.length-1; c >= 0; c--){
     inteiro += aux[c]+'.';
  }
  //retirando o ultimo ponto e finalizando a parte inteiro
   
  inteiro = inteiro.substring(0,inteiro.length-1);
   
  decimal = parseInt(decimal);
  if(isNaN(decimal)){
     decimal = "00";
  }else{
     decimal = ""+decimal;
     if(decimal.length === 1){
        decimal = "0"+decimal;
     }
  }
  valor = inteiro+","+decimal;
  return valor;
}
   //########### PEGANDO A DISTANCIA E O TEMPO
   
    function CalculaDistancia() {
            $('#mapsresults').html('Aguarde...');
            //Instanciar o DistanceMatrixService
            var service = new google.maps.DistanceMatrixService();
            //executar o DistanceMatrixService
            service.getDistanceMatrix(
              {
                  //Origem
                  origins: ['Rua Siqueira Campos, 40, Cabedelo, Paraiba, Brasil'],
                  //Destino
                  destinations: [$("#endereco").val() +', '+ $("#numero").val() + ', Paraiba, Brasil'],
                  //Modo (DRIVING | WALKING | BICYCLING)
                  travelMode: google.maps.TravelMode.DRIVING,
                  //Sistema de medida (METRIC | IMPERIAL)
                  unitSystem: google.maps.UnitSystem.METRIC
                  //Vai chamar o callback
              }, callback);
        }
        //Tratar o retorno do DistanceMatrixService
        function callback(response, status) {
            //Verificar o Status
            if (status != google.maps.DistanceMatrixStatus.OK)
                //Se o status não for "OK"
                {
                $('#endGoogle').htm('0');
                 $('#distancia').html('0');
                 $('#tempo').html('0');
                }
                 else {
                //Se o status for OK
                //Endereço de origem = response.originAddresses
                //Endereço de destino = response.destinationAddresses
                //Distância = response.rows[0].elements[0].distance.text
                //Duração = response.rows[0].elements[0].duration.text
                
                //$('#mapsresults').html("<strong>Origem</strong>: " + response.originAddresses +
                //    "<br /><strong>Destino:</strong> " + response.destinationAddresses +
                //    "<br /><strong>Distância</strong>: " + response.rows[0].elements[0].distance.text +
                //    " <br /><strong>Duração</strong>: " + response.rows[0].elements[0].duration.text
                //    );
                
                 $('#endGoogle').html(response.destinationAddresses);
                 $('#distancia').html(response.rows[0].elements[0].distance.text);
                 $('#tempo').html(response.rows[0].elements[0].duration.text);
                //Atualizar o mapa
               // $("#map").attr("src", "https://maps.google.com/maps?saddr=" + response.originAddresses + "&daddr=" + response.destinationAddresses + "&output=embed");
            }
        }
        //###################################### FIM DO DISTANCIA TEMPO       
      
      //AQUI FICA FORA DA CHAMADA JQUERY MAS USA FUNCOES DELES
        
        function loadSushis() {
                
                
                 //Carregar DIV de "loading"
	//	document.getElementById('result').style.display = 'block';
	//           
	//
	//var id      = document.getElementById("fixed-header-drawer-exp").value; //Aqui eu pegava o critpério da busca que era o nome do filme, mas não preciso disso
	////var id = "tudo"; //atribuo um valor qualquer. Ele será descartado, se precisasse realizar a busca atribuia
	//var result  = document.getElementById("result");
	//var XMLHttp = generateXMLHttp();
	//XMLHttp.open("get", "getData.php?id=" + id, true);
	//XMLHttp.onreadystatechange = function(){
	//	if (XMLHttp.readyState == 4)
	//		if (XMLHttp.status == 200){
	//			result.innerHTML = XMLHttp.responseText;
	//		} else {
	//			result.innerHTML = "Um erro ocorreu: " + XMLHttp.statusText;
	//		}
	//};
	//XMLHttp.send(null);
                
//                var opcao = 0;
//                
//                $.post('bdEngine.php',{opcaoSQL:opcao},
//                
//                function call_back(data){
//			$("#sushis").html(data);
//            
//            
//            });
                
                
              //Abaixo carrega      
                //$("#sushis").html("OIA OS SUSHIS JA!");
               // var opcao = 0;
               //var dados = opcao;
               // 
               // $.ajax({
               //         type: 'POST',
               //         url: 'bdEngine.php',
               //         async: true,
               //         data: opcao,
               //         success: function call_back(opcao) {
               //          //$('#sushis').html("OIA OS SUSHIS JA AJAX!");
               //          //location.reload();
               //                $("#sushis").html(opcao); 
               //                }
               //         
               //        });

                
                }
 
  