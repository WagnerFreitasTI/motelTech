//SET CENARIO
function set_audio(audio) {

    console.log("Set AUDIO")
    console.log(audio)

    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 2000);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        var conteudo = this.responseText


        try {
            var myObj = JSON.parse(this.responseText);

            if ((myObj['mensagem'] === 'sucesso')) {
                clearTimeout(aviso_erro)
                mensagem_sucesso("Comando enviado")
            }

        } catch (err) {

        }



    };



    var url_send = url_node_red + "/automacao/suite/" + suite + "/audio/" + audio + "/" + suite_token;

    xhttp.open("GET", url_send, true);
    xhttp.send();

}

//Recepcao
function liga_recepcao() {

    console.log("Liga Recepcao")
    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 2000);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        var conteudo = this.responseText


        try {
            var myObj = JSON.parse(this.responseText);

            if ((myObj['mensagem'] === 'sucesso')) {
                clearTimeout(aviso_erro)
                mensagem_sucesso("Comando enviado")
            }

        } catch (err) {

        }



    };

    // /automacao/suite/:suite/liga/recepcao/:token

    var url_send = url_node_red + "/automacao/suite/" + suite + "/liga/recepcao/" + suite_token;

    xhttp.open("GET", url_send, true);
    xhttp.send();

}

//SET TV
function set_tv(comando) {

    console.log("Set TV")
    var operacao = "null"

    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 2000);

    // /automacao/suite/:suite/tv/:status/:token
    var url_send = url_node_red + "/automacao/suite/" + suite + "/tv/" + comando + "/" + suite_token;

    $.ajax({
        url: url_send,
        method: 'GET',
        dataType: 'html',
        data: ''
    })
    
        .done(function (data) {
          // console.log(url_send)
          //console.log(data)
           try {
            var myObj = JSON.parse(data);

            if ((myObj['mensagem'] === 'sucesso')) {
               
               
                if(comando == 1){
                    document.getElementById('status_tv').innerHTML  ="Ligado"
                    
                }else {
                    document.getElementById('status_tv').innerHTML  ="Desligado"
                }

                clearTimeout(aviso_erro)
                mensagem_sucesso("Comando enviado")

            }

        } catch (err) {

        }
    
        }).fail(function (data) {
            mensagem_danger("Houve um erro inesperado");
    
        });



}

//SET VOLUME
function set_tv_vol(comando) {
    console.log("Set TV  VOL")

    var operacao = "null"

    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 2000);

    // /automacao/suite/:suite/tv/:operacao/:token
    var url_send = url_node_red + "/automacao/suite/" + suite + "/tv/vol/" + comando + "/" + suite_token;

    $.ajax({
        url: url_send,
        method: 'GET',
        dataType: 'html',
        data: ''
    })
    
        .done(function (data) {
       
           try {
            var myObj = JSON.parse(data);

            if ((myObj['mensagem'] === 'sucesso')) {
                clearTimeout(aviso_erro)
                mensagem_sucesso("Comando enviado")
            }else{
                mensagem_danger("Houve um erro inesperado");
            }

        } catch (err) {

        }
    
        }).fail(function (data) {
            mensagem_danger("Houve um erro inesperado");
    
        });



}