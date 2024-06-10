var time_out_status_rele;


$(document).ready(function() {

    recebe_status_rele();
   


});


//RECE STATUS RELE
function recebe_status_rele() {
    var url_send = url_node_red + "/automacao/" + suite + "/saida/status/" + suite_token;

    $.ajax({
        url: url_send,
        method: 'GET',
        dataType: 'html',
        data: ''
    })

    .done(function(data) {

       // console.log(data)

        try {
            var myObj = JSON.parse(data);
            muda_botao("#r1", myObj['s1'])
            muda_botao("#r2", myObj['s2'])
            muda_botao("#r3", myObj['s3'])
            muda_botao("#r4", myObj['s4'])
            muda_botao("#r5", myObj['s5'])
            muda_botao("#r6", myObj['s6'])
            if(qtd_lampada >6){
            muda_botao("#r7", myObj['s7'])
            }
           

            clearTimeout(time_out_status_rele)
            time_out_status_rele = setInterval(recebe_status_rele, 2000);

        } catch (err) {

        }


    }).fail(function(data) {


    });
}

//SET RELE     
function set_status_rele(id, index) {

    var operacao = "null"

    if ($(id).hasClass('OffButton')) {
        operacao = 1
    } else {
        operacao = 0
    }


   

    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 6000);

    var url_send = url_node_red + "/automacao/suite/" + suite + "/saida/" + index + "/set/" + operacao + "/" + suite_token;

    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })

        .done(function(data) {

            console.log(data)


            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    muda_botao(id, operacao);
                    console.log("Sucesso")
                    clearTimeout(aviso_erro)
                    clearTimeout(time_out_status_rele)
                    time_out_status_rele = setInterval(recebe_status_rele, 4000);
                }

            } catch (err) {

            }


        }).fail(function(data) {


        });

}


//ALL   
//ON
//OFF
function set_all(tipo) {

    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 5000);


    ///automacao/suite/:suite/saida/:saida/set/:status/:token
    var url_send = url_node_red + "/automacao/suite/" + suite + "/saida/1/set/" + tipo + "/" + suite_token;
    console.log(url_send)
    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })

        .done(function(data) {

            console.log(data)

            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    var novo_status = 0;

                    if (tipo == "2") {
                        novo_status = 1;
                    }

                    muda_botao("#r1", novo_status)
                    muda_botao("#r2", novo_status)
                    muda_botao("#r3", novo_status)
                    muda_botao("#r4", novo_status)
                    muda_botao("#r5", novo_status)
                    muda_botao("#r6", novo_status)

                    clearTimeout(aviso_erro)

                    clearTimeout(time_out_status_rele)
                    time_out_status_rele = setInterval(recebe_status_rele, 5000);
                }

            } catch (err) {

            }


        }).fail(function(data) {


        });

}


//STATUS DO BOTAO HTML
function muda_botao(index, status) {
    var btn = document.getElementById(index)

    if (status === 1) {
        $(index).removeClass("button");
        $(index).addClass("OnButton");
        $(index).removeClass("OffButton");
    } else {
        $(index).removeClass("button");
        $(index).addClass("OffButton");
        $(index).removeClass("OnButton");
    }



}

//SET AR
function set_rgb(cor) {

    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 5000);

    var url_send = url_node_red + "/automacao/suite/" + suite + "/rgb/" + cor + "/" + suite_token;

    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })
        .done(function(data) {

            console.log(data)
            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    clearTimeout(aviso_erro)
                    mensagem_sucesso("Comando enviado")
                }

            } catch (err) {

            }



        }).fail(function(data) {


        });


}


//SET AR
function set_ar(temp) {

    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 5000);

    var url_send = url_node_red + "/automacao/suite/" + suite + "/ar/" + temp + "/" + suite_token;
    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })

        .done(function(data) {

            console.log(data)


            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    clearTimeout(aviso_erro)
                    mensagem_sucesso("Comando enviado")
                }

            } catch (err) {

            }



        }).fail(function(data) {


        });

}

//SET CENARIO
function set_cenario(cena) {

    console.log("Set Cenario")
    console.log(cena)

    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 5000);

    var url_send = url_node_red + "/automacao/suite/" + suite + "/cenario/" + cena + "/" + suite_token;

    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })

        .done(function(data) {

            console.log(data)


            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    clearTimeout(aviso_erro)
                    mensagem_sucesso("Comando enviado")
                }

            } catch (err) {

            }



        }).fail(function(data) {


        });

}

//Recepcao
function liga_recepcao() {

    console.log("Liga Recepcao")


    var operacao = "null"


    //DISPARA ERRO
    aviso_erro = setTimeout(function() {
        mensagem_danger("Houve um erro ao enviar o comando ")
    }, 5000);

    var url_send = url_node_red + "/automacao/suite/" + suite + "/liga/recepcao/" + suite_token;

    $.ajax({
            url: url_send,
            method: 'GET',
            dataType: 'html',
            data: ''
        })

        .done(function(data) {

            console.log(data)


            try {
                var myObj = JSON.parse(data);

                if ((myObj['mensagem'] === 'sucesso')) {
                    clearTimeout(aviso_erro)
                    mensagem_sucesso("Comando enviado")
                }

            } catch (err) {

            }



        }).fail(function(data) {


        });
}