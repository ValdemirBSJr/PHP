    //função que verifica compatibilidade browser com ajax
    
    //Remove loading para só aparecer quando chamar o envento
	 document.getElementById('result').style.display = 'none';
    
    function generateXMLHttp(){
        if (typeof XMLHttpRequest != "undefined"){
        return new XMLHttpRequest();
    }
        else{	
        if (window.ActiveXObject){
            var versions = ["MSXML2.XMLHttp.5.0",
                            "MSXML2.XMLHttp.4.0",
                            "MSXML2.XMLHttp.3.0",
                            "MSXML2.XMLHttp",
                            "Microsoft.XMLHttp"
                            ];
            }
    }
    for (var i=0; i < versions.length; i++){
        try{
            return new ActiveXObject(versions[i]);
            }catch(e){}
    }
    alert('Olá, usuário! Seu navegador não pode trabalhar com Ajax! Sugerimos fortemente que você utilize outro navegador mais moderno para tal.');
    
    }
    
    //Função que concatena os dados passados do formulario em um array para ser passado via XML para GET
    
        function generateFieldsValues(formInsert){
        var strReturn = new Array();
        for(var i=0; i < formInsert.elements.length; i++){
        var str = encodeURIComponent(formInsert.elements[i].name);
        str += "=";
        str += encodeURIComponent(formInsert.elements[i].value);
        strReturn.push(str);
        }
    return strReturn.join("&");
    }
    
    
    //função para enviar a solicitação
    
          function getById() {
            
            //Carregar DIV de "loading"
		document.getElementById('result').style.display = 'block';
            
    var id = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;
    var result = document.getElementById("result");
    var XMLHttp = generateXMLHttp();
    XMLHttp.open("get", "login.php?login=" + id + "&senha=" + senha, true);
    XMLHttp.onreadystatechange = function(){
    if (XMLHttp.readyState == 4)
    if (XMLHttp.status == 200){
    result.innerHTML = XMLHttp.responseText;
    window.open('diario.html', '_self'); //Aqui abre a janela do sistema [FUNCIONA]
    } else {
    result.innerHTML = "Um erro ocorreu: " + XMLHttp.statusText;
    }
    };
    XMLHttp.send(null);
    }