if(typeof(Storage) !== "undefined") {
    
    //alert ("Compativel com localstorage");
    
    var monitor = setInterval(meuVerificador, 25000);
    
    
    
    
} else {
    alert ("Seu navegador é imcompativel para esta pagina. Utilize o forefox ou o chrome. Duvidas, contate o desenvolvedor.");
}

function meuVerificador() {
        
        if (!window.localStorage.getItem('contador') || (parseInt(window.localStorage.getItem('contador')) > parseInt($('#totalPedidosPendentes').html()))) {
            
            var conta = $('#totalPedidosPendentes').html();
            window.localStorage.setItem('contador', conta);
                
        }
        if (window.localStorage.getItem('contador')) {
            
            var conta = window.localStorage.getItem('contador');
            
            if (conta < parseInt($('#totalPedidosPendentes').html())) {
                
                window.localStorage.setItem('contador', $('#totalPedidosPendentes').html());
                //alert ("mudou!");
                
                $("#audioum").html("<audio autoplay><source src='sound/ring.mp3' type='audio/mpeg'>Seu navegador não possui suporte ao elemento audio</audio>");
                
                
            }
            
            if (conta == parseInt($('#totalPedidosPendentes').html())) {
                //alert (" nao mudou!");
                //$("#audioum").html("<audio autoplay><source src='sound/ring.mp3' type='audio/mpeg'>Seu navegador não possui suporte ao elemento audio</audio>");
            
            }
            
           window.setTimeout(function aguardaMensagem() { location.reload();}, 10000);
            
        }
        
    }