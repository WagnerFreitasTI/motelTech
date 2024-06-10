var tempo_atualiza_pagina; //ATUALIZA STATUS RELE

//RENDERIZA SUITES
$(document).ready(function () {
 
    var row_contente = $('#row_contente'); 
    row_contente.hide();
    let timerInterval
    Swal.fire({
      title: 'Carregando dados',
      html: '',
      timer: 500,
      timerProgressBar: true,
      didOpen: () => {
       Swal.showLoading()
       const swalContainer = Swal.getContainer()
       swalContainer.classList.add('custom-swal-container')
      
       atualiza_suite();
      
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {

      row_contente.show();
      tempo_atualiza_pagina = setInterval(atualiza_suite, 3000);
      if (result.dismiss === Swal.DismissReason.timer) {

      }
    })

  

});

//ATUALIZA SUITE
function atualiza_suite() {

    const id_suite = document.getElementById("id_suite").value;
    var row_suite = $('#row_suite'); 
    var row_erro = $('#erro_conn'); 


    $.ajax({
        url: '../../src/suite/index',
        method: 'GET',
        dataType: 'html',
        data: 'op=by_id&id='+id_suite
    })

        .done(function (data) {
        
            try {
                var obj_json = JSON.parse(data);
                 
              
                if(suite_online(obj_json['hw']['visto'])){
                     
                //STATUS SUITE
                const cor_status_suite = get_background_suite(obj_json['hw']['status_suite']);
                document.getElementById('bg_' + id_suite).className = 'card card-body bg-'+cor_status_suite+' danger text-white';

                //LAMPADA PRINCIPAL
                var status = obj_json['iluminacao']['principal'] == 1 ? true : false;
                $("#luz_principal").prop("checked", status);

                 //LAMPADA LUSTRE
                status = obj_json['iluminacao']['lustre'] == 1 ? true : false;
                 $("#luz_lustre").prop("checked", status);

                //LAMPADA CORTINA
                status = obj_json['iluminacao']['cortina'] == 1 ? true : false;
                $("#luz_cortina").prop("checked", status);

                //LAMPADA CRIADO MUDO
                status = obj_json['iluminacao']['criado_mudo'] == 1 ? true : false;
                $("#luz_criado_mudo").prop("checked", status);

                //LAMPADA WC PIA
                status = obj_json['iluminacao']['wc_pia'] == 1 ? true : false;
                $("#luz_wc_pia").prop("checked", status);

                //LAMPADA WC BOX
                status = obj_json['iluminacao']['wc_box'] == 1 ? true : false;
                $("#luz_wc_box").prop("checked", status);
 
                //PORTA CLIENTE
                status = obj_json['portas']['cliente'] == 1 ? true : false;
                if(status){
                    $("#porta_cliente").removeClass("bg-roxo");
                    $("#porta_cliente").addClass("bg-dark");
                }else{
                    $("#porta_cliente").removeClass("bg-dark");
                    $("#porta_cliente").addClass("bg-roxo");
                }
        
                //PORTA SERVICO
                status = obj_json['portas']['servico'] == 1 ? true : false;
                if(status){
                    $("#porta_servico").removeClass("bg-roxo");
                    $("#porta_servico").addClass("bg-dark");
                }else{
                    $("#porta_servico").removeClass("bg-dark");
                    $("#porta_servico").addClass("bg-roxo ");
                }
        

                //STATUS CHAPINHA
                status = obj_json['chapinha']['status'] == 1 ? true : false;
                if(status){
                    $("#chapinha").removeClass("bg-dark");
                    $("#chapinha").addClass("bg-roxo");
                    var tempo = formatarTempoRestante(obj_json['chapinha']['tempo_restante'] , obj_json['chapinha']['tempo_total'] ) ;
                    $("#tempo_chapinha").text(tempo);
                }else{
                    $("#chapinha").removeClass("bg-roxo");
                    $("#chapinha").addClass("bg-dark");
                    $("#tempo_chapinha").text("Desligada");
                    
                }

                row_erro.hide();
                row_suite.show();
             }else{
                row_erro.show();
                row_suite.hide();
             }
                

                

            } catch (e) {
                mensagem_danger("Houve um erro ao recuperar a suite");
                row_erro.show();

            }


        }).fail(function (data) {
            // var mensagem = "<center><strong>Erro! Ao atualizar maquinas</strong></center>";
            //mostraDialogo(mensagem, 'danger', 500);
            row_erro.show();
        });



}

//RECEBE A COR DO BACKGROUND DA SUITE
function get_background_suite(status){

    var status_suite = "dark";
    
    if(status == "1"){
    status_suite = "success";
    }else if(status == "2"){
    status_suite = "danger";
    }else if(status == "3"){
    status_suite = "primary";
    }
    
     return  status_suite
    
}

//CALCULA TEMPO RESTANTE DA CHAPINHA RELE    
function formatarTempoRestante(total, restante) {
        var minutosTotal = Math.floor(total / 60);
        var minutosRestante = Math.floor(restante / 60);
        var segundosTotal = total % 60;
        var segundosRestante = restante % 60;
      
        var tempoFormatadoTotal = ("0" + minutosTotal).slice(-2) + ":" + ("0" + segundosTotal).slice(-2);
        var tempoFormatadoRestante = ("0" + minutosRestante).slice(-2) + ":" + ("0" + segundosRestante).slice(-2);
      
        return tempoFormatadoTotal ;
}

//MUDA STATUS DA LAMPADA NO HW
function toogle_lampada_suite(id) {
 
    Swal.fire({
        title: 'Alterar?',
        text: "Deseja realmente alterar o status da lâmpada?",
       
    
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const ip_suite = document.getElementById("ip_suite").value;
            clearTimeout(tempo_atualiza_pagina)
            tempo_atualiza_pagina = setInterval(atualiza_suite, 3000);

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=toogle_iluminacao&ipv4='+ip_suite+'&lampada='+id
            })
            
                .done(function (data) {
                    console.log(data)
            
                    if(!(data === "null" || data === null)){
                        try {
                            var obj_json = JSON.parse(data);
                
                            if (obj_json['mensagem'] === "sucesso") {
                                toogle_checkbox(id,obj_json['status']);
                                mensagem_sucesso("Status alterado com sucesso");
                            }else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }
                            else {
                                mensagem_danger("Houve um erro");
                            }
                
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                
                        }
                    }else{
                        toogle_checkbox(id,0);
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
            
        }
      })


}

//MUDA STATUS DA LAMPADA NO HW
function toogle_all_lampada_suite(status) {
 
    Swal.fire({
        title: 'Alterar?',
        text: "Deseja realmente alterar o status de todas as lâmpada?",
       
    
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const ip_suite = document.getElementById("ip_suite").value;
            const id_suite = document.getElementById("id_suite").value;
            clearTimeout(tempo_atualiza_pagina)
            tempo_atualiza_pagina = setInterval(atualiza_suite, 3000);

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=toogle_all_iluminacao&ipv4='+ip_suite+'&status='+status+'&id='+id_suite
            })
            
                .done(function (data) {
                    console.log(data)
                    console.log(status)
                    console.log(id_suite)
            
                    if(!(data === "null" || data === null)){
                        try {
                            var obj_json = JSON.parse(data);
                
                            if (obj_json['mensagem'] === "sucesso") {
                                toogle_checkbox(1,status);
                                toogle_checkbox(2,status);
                                toogle_checkbox(3,status);
                                toogle_checkbox(4,status);
                                toogle_checkbox(5,status);
                                toogle_checkbox(6,status);
                                mensagem_sucesso("Status alterado com sucesso");
                                clearTimeout(tempo_atualiza_pagina)
                                tempo_atualiza_pagina = setInterval(atualiza_suite, 3000);

                            } else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                
                        }
                    }else{
                        toogle_checkbox(id,0);
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
            
        }
      })


}

//MUDAR STATUS DO CHECKBOX DA LAMPADA
function toogle_checkbox(id, status){
    var index = " ";
    if(id == 1){
        index = "#luz_principal";
    }else if(id == 2){
        index = "#luz_lustre";
    }else if(id == 3){
        index = "#luz_cortina";
    }else if(id == 4){
        index = "#luz_criado_mudo";
    }else if(id == 5){
        index = "#luz_wc_pia";
    }else if(id == 6){
        index = "#luz_wc_box";
    }

  if(status == 1){
    $(index).prop("checked", true);
  }else{
    $(index).prop("checked", false);
  }

}

//MANDAR TEXTO 
function texto_to_audio(){
    Swal.fire({
        title: 'Enviar áudio?',
        text: "Deseja realmente enviar o áudio para o cliente?",
       
    
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero enviar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;
            const mensage = document.getElementById("mensagem_alexa").value;
              if((mensage.trim() !== "")){


            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=enviar_audio&id='+id_suite+'&texto='+mensage
            })
            
                .done(function (data) {
                   
                  
            
                    if(!(data === "null" || data === null) ){
                        try {
                            var obj_json = JSON.parse(data);
                
                            if (obj_json['mensagem'] === "sucesso") {
                               
                                $("#mensagem_alexa").text(" ");
                                mensagem_sucesso("Áudio enviado com sucesso");

                      

    
                            } else {
                                mensagem_danger("Houve um erro");
                            }
                
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                
                        }
                    }else{
                    
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
            }else{
                mensagem_danger("Preencha o campo de mensagem!");
            }
        }
      })
}

//VERIFICA DATA ONLINE OU OFF
function suite_online(dataHora) {

    var status = false;

    // Converter a string para um objeto Date
    const dataHoraFornecida = new Date(dataHora);

    // Obter a data e hora atual
    const agora = new Date();

    // Calcular a diferença em milissegundos
    const diferenca = agora.getTime() - dataHoraFornecida.getTime();

    // Verificar se a diferença é menor ou igual a 2 minutos em milissegundos
    if (Math.abs(diferenca) <= 60000) {
        status = true;

    }

    return status;
}

//MUDA STATUS DO RGB DA SUITE 
function suite_rgb_change(cor){
    Swal.fire({
        title: 'Alterar RGB?',
        text: "Deseja realmente alterar a cor do RGB?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=alterar_rgb&id='+id_suite+'&cor='+cor
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Cor alterada com sucesso");
                            }  else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })
}



//CALL RECEPCAO TO SUITE
function suite_call(){
    Swal.fire({
        title: 'Ligar para suíte?',
        text: "Deseja realmente ligar para suíte?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero ligar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=call_suite&id='+id_suite
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando de ligação enviado com sucesso");
                            } else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })
}


//MUDA AUDIO E VIDEO
function suite_audio_video(index){
    Swal.fire({
        title: 'Alterar?',
        text: "Deseja realmente alterar o Áudio e Vídeo?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=audio_video&id='+id_suite+'&index='+index
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando enviado com sucesso");
                            } else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            } else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })
}

//MUDA CENARIO
function suite_cenario(index){
    Swal.fire({
        title: 'Alterar?',
        text: "Deseja realmente alterar o Cenário?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=cenario&id='+id_suite+'&index='+index
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando enviado com sucesso");
                            }  else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })
}


//ABRE SUITE DETALHES
function suite_load_qrcode(qrcode){
    var url = "http://192.168.0.11/moteltech?goesconect=medieval&poa_rs="+qrcode;
    
    window.open(url, "_blank");
}

//LIGA  AR CONDICIONADO
function liga_arcondicionado(){

    Swal.fire({
        title: 'Ligar?',
        text: "Deseja realmente ligar o Ar-Condicionado?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero ligar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=arcondicionado&id='+id_suite+'&status=1'
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando enviado com sucesso");
                            }  else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })

}

//DESLIGA  AR CONDICIONADO
function desliga_arcondicionado(){

    Swal.fire({
        title: 'Desligar?',
        text: "Deseja realmente desligar o Ar-Condicionado?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero desligar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;

            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=arcondicionado&id='+id_suite+'&status=2'
            })
            
                .done(function (data) {
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando enviado com sucesso");
                            }  else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })

}

//TEMPERATURA AR CONDICIONADO
//PRESSIONA O ENTER
$(document).keypress(function (e) {
    if (e.which == 13) {
        const temp_ar = document.getElementById("temp_ar").value;
        if(temp_ar>0){
            temperatura_arcondicionado();
        }
      
    }
});
function temperatura_arcondicionado(){

    Swal.fire({
        title: 'Temperatura?',
        text: "Deseja realmente alterar a temperatura o Ar-Condicionado?",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#212529',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            
            const id_suite = document.getElementById("id_suite").value;
            const temp_ar = document.getElementById("temp_ar").value;
            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=arcondicionado_temp&id='+id_suite+'&temp='+temp_ar
            })
            
                .done(function (data) {
                    document.getElementById("temp_ar").value = " ";
                   console.log(data)
                    if(!(data === "null" || data === null) ){

                        try {
                            var obj_json = JSON.parse(data);
                            if (obj_json['mensagem'] === "sucesso") {
                                mensagem_sucesso("Comando enviado com sucesso");
                            }  else  if (obj_json['mensagem'] === "nivel") {
                                mensagem_danger("Você não tem permissão");
                            }else {
                                mensagem_danger("Houve um erro");
                            }
                        } catch (e) {
                            mensagem_danger("Houve um erro inesperado "+e);
                        }

                    }else{
                        mensagem_danger("Suíte não responde!");
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
           
        }
      })

}