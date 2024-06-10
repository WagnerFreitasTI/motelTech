
//RENDERIZA SUITES
$(document).ready(function () {




    $.ajax({
        url: '../../src/suite/index',
        method: 'GET',
        dataType: 'html',
        data: 'op=todas_suites'
    })

        .done(function (data) {
       
      
            try {
                var obj_json = JSON.parse(data);
                if (obj_json['mensagem'] === "sucesso" && (obj_json['suites'].length > 0)) {
                $('#suites').html("");

                for (var i = 0; i < obj_json['suites'].length; i++) {
                  
                 var html = get_html_suite(obj_json['suites'][i]);
                  $('#suites').prepend(html);
                }

                setInterval(atualiza_suites, 3000);

                } else {
                    console.log("nao existe")
                }

            } catch (e) {
                mensagem_danger("Houve um erro ao recuperar as máquinas");
                console.log(e)

            }

        }).fail(function (data) {
           mensagem_danger("Houve um erro inesperado");
        });

  

});

//ATUALIZA SUITES
function atualiza_suites() {

    $.ajax({
        url: '../../src/suite/index',
        method: 'GET',
        dataType: 'html',
        data: 'op=todas_suites_home'
    })

        .done(function (data) {
            console.log(data)
       
            
            try {
                var obj_json = JSON.parse(data);
                if (obj_json['mensagem'] === "sucesso" && (obj_json['suites'].length > 0)) {
                 
                    for (var i = 0; i < obj_json['suites'].length; i++) {
                        //STATUS SUITE
                        set_html_suite(obj_json['suites'][i]);
                        //ICONES
                        existe_lampada_ligada(obj_json['suites'][i]);
                        existe_porta_aberta(obj_json['suites'][i]);
                        existe_chapinha_ligada(obj_json['suites'][i]);
                        existe_tv_ligada(obj_json['suites'][i]);
                    }

                } else {
                    console.log("nao existe")
                }


            } catch (e) {
                mensagem_danger("Houve um erro ao recuperar as maquinas");
                console.log(e)

            }


        }).fail(function (data) {
            // var mensagem = "<center><strong>Erro! Ao atualizar maquinas</strong></center>";
            //mostraDialogo(mensagem, 'danger', 500);

        });



}



//RECEBE HTML DA SUITE
function get_html_suite(obj_json) {

    //STATUS 
    var url_suite = " ";
    var status_suite_mensagem = '  <span  >Sem conexão...</span> '
    var status_suite = "dark"
    if (suite_online(obj_json['visto'])) {
        status_suite = get_background_suite(obj_json['status_suite']);
        url_suite = "suite_load(" + obj_json['id'] + " )";
        status_suite_mensagem = " &nbsp;";
    }
    if (status_suite === 'redBlink') {
        setInterval(function () {
            var cardElement = document.getElementById(`bg_${obj_json['id']}`);
            cardElement.classList.add('red'); // Certifique-se de que 'red' está sendo aplicada corretamente
            console.log('Classe adicionada:', cardElement.classList); // Adicione isso para verificar se a classe 'red' está sendo aplicada
        }, 2000); // Intervalo de 3 segundos
        

        var html = ` <div class="col-lg-3" style="width:200px">

                <div class="card text-white" id="bg_${obj_json['id']}">
                    <div class="card-body">
                        <div class="d-flex align-items-center" style="margin-top:-15px">

                          <span style="margin-left: -10px" onClick="${url_suite}">
                         
                          <h2 class="mb-0 text-lg"> ${obj_json['numero']} 
                          <span style="font-size: 10px;">
                           ${obj_json['nome']}
                         </span>
                          </h2> 
                         
                          </span>


                            <div class="dropdown d-inline-flex ms-auto">
                         
                                <a href="#" class="text-white align-items-center"
                                    data-bs-toggle="dropdown">
                                    <i class="ph-arrows-clockwise"></i>
                                </a>
                                <div class="dropdown-menu">

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '1')">
                                        <i class="ph-number-zero me-2"></i>
                                        Desocupada
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '3')">
                                        <i class="ph-magnifying-glass me-2" ></i>
                                        Limpeza / Manutenção
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '2')">
                                        <i class="ph-users me-2"></i>
                                        Ocupada
                                    </a>
                                    
                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '4')">
                                        <i class="ph-wrench me-2"></i>
                                        Standby
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '5')">
                                        <i class="ph ph-door me-2"></i>
                                        Conferência
                                    </a>

                                </div>
                            </div>
                           
                        </div>

                        <div>
                            <div class="ph-door" style="opacity: 0.1;" id="icon_porta_${obj_json['id']}"></div>
                            <div class="ph-lightbulb" style="opacity: 0.1;" id="icon_iluminacao_${obj_json['id']}"> </div>
                            <div class="ph-wind" style="opacity: 0.1;" id="icon_ar_${obj_json['id']}"></div>
                            <div class="ph-plug" style="opacity: 0.1;" id="icon_tomada_${obj_json['id']}"></div>
                            <div class="ph-television-simple" style="opacity: 0.1;" id="icon_tv_${obj_json['id']}"></div>
                            <div class="ph-music-notes-simple" style="opacity: 0.1;" id="icon_audio_${obj_json['id']}"></div>    
                        </div> 
                      
                    </div>  
                   <div id="msg_erro_suite_${obj_json['id']}" style="font-size:10px;margin-top:-20px;text-align:center"> 
                      ${status_suite_mensagem}
                  </div>
                  
                </div>
           
            </div>`;

        return html;
    } else {

        var html = ` <div class="col-lg-3" style="width:200px">

                <div class="card bg-${status_suite} text-white" id="bg_${obj_json['id']}">
                    <div class="card-body">
                        <div class="d-flex align-items-center" style="margin-top:-15px">

                          <span style="margin-left: -10px" onClick="${url_suite}">
                         
                          <h2 class="mb-0 text-lg"> ${obj_json['numero']} 
                          <span style="font-size: 10px;">
                           ${obj_json['nome']}
                         </span>
                          </h2> 
                         
                          </span>


                            <div class="dropdown d-inline-flex ms-auto">
                         
                                <a href="#" class="text-white align-items-center"
                                    data-bs-toggle="dropdown">
                                    <i class="ph-arrows-clockwise"></i>
                                </a>
                                <div class="dropdown-menu">

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '1')">
                                        <i class="ph-number-zero me-2"></i>
                                        Desocupada
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '3')">
                                        <i class="ph-magnifying-glass me-2" ></i>
                                        Limpeza / Manutenção
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '2')">
                                        <i class="ph-users me-2"></i>
                                        Ocupada
                                    </a>
                                    
                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '4')">
                                        <i class="ph-wrench me-2"></i>
                                        Standby
                                    </a>

                                    <a  class="dropdown-item" onClick="atualiza_status_suite(${obj_json['id']},'${obj_json['ipv4']}', '5')">
                                        <i class="ph ph-door me-2"></i>
                                        Conferência
                                    </a>

                                </div>
                            </div>
                           
                        </div>

                        <div>
                            <div class="ph-door" style="opacity: 0.1;" id="icon_porta_${obj_json['id']}"></div>
                            <div class="ph-lightbulb" style="opacity: 0.1;" id="icon_iluminacao_${obj_json['id']}"> </div>
                            <div class="ph-wind" style="opacity: 0.1;" id="icon_ar_${obj_json['id']}"></div>
                            <div class="ph-plug" style="opacity: 0.1;" id="icon_tomada_${obj_json['id']}"></div>
                            <div class="ph-television-simple" style="opacity: 0.1;" id="icon_tv_${obj_json['id']}"></div>
                            <div class="ph-music-notes-simple" style="opacity: 0.1;" id="icon_audio_${obj_json['id']}"></div>    
                        </div> 
                      
                    </div>  
                   <div id="msg_erro_suite_${obj_json['id']}" style="font-size:10px;margin-top:-20px;text-align:center"> 
                      ${status_suite_mensagem}
                  </div>
                  
                </div>
           
            </div>`;

        return html;

    }
}

//RECEBE HTML DA SUITE
function set_html_suite(obj_json) {

    var classe_nova ="dark"
      //STATUS  

      if(suite_online( obj_json['visto'])){
      
        var classe_nova = get_background_suite(obj_json['status_suite']);
        var index = "#msg_erro_suite_"+obj_json['id'];
        $(index).html("&nbsp;");
      }else{
        var index = "#msg_erro_suite_"+obj_json['id'];
        $(index).text("Sem conexão...");
       
      }
    
     document.getElementById('bg_' + obj_json['id']).className = 'card bg-'+classe_nova+' text-white';
    
}

//ATUALIZA STATUS
function atualiza_status_suite(id, ipv4, status) {

    Swal.fire({
        title: 'Alterar?',
        text: "Deseja realmente alterar o status da suíte?",
        icon: 'error',
    
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero alterar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../src/suite/index',
                method: 'POST',
                dataType: 'html',
                data: 'op=set_status&status_suite='+status+'&ipv4='+ipv4+'&id_suite='+id
            })
            
                .done(function (data) {
                console.log(data)
                    try {
                        var obj_json = JSON.parse(data);
            
                        if (obj_json['mensagem'] === "sucesso") {
                            var classe_nova = get_background_suite(obj_json['status']);
                            document.getElementById('bg_' + id).className = 'card bg-'+classe_nova+' text-white';
                            mensagem_sucesso("Status alterado com sucesso");

                        } else if(obj_json['mensagem'] === "pdv"){
                            mensagem_danger("PDV Está online");
                        }else if(obj_json['mensagem'] === "nivel"){
                            mensagem_danger("Você não tem permissão!");
                        }else {
                            mensagem_warning("Houve um erro");
                        }
            
                    } catch (e) {
                        mensagem_danger("Houve um erro inesperado");
            
                    }
            
                }).fail(function (data) {
                    mensagem_danger("Houve um erro inesperado");
            
                });
            
        }
      })


}


function get_background_suite(status) {

    var status_suite = "dark";

    if (status == "1") {
        status_suite = "success";
    } else if (status == "2") {
        status_suite = "danger";
    } else if (status == "3") {
        status_suite = "primary";
    } else if (status == "4") {
        status_suite = "primary";
    } else if (status == "5") {
        status_suite = "redBlink";
    }

    return status_suite

}

//VERIFICA DATA ONLINE OU OFF
function suite_online(dataHora) {
    var status = false;

    // Converter a string para um objeto Date
    const dataHoraFornecida = new Date(dataHora);

    // Obter a data e hora atual
    const agora = new Date();

    // Definir um intervalo de dois anos em milissegundos
    const doisAnosEmMilissegundos = 2 * 365 * 24 * 60 * 60 * 1000;

    // Calcular a diferença em milissegundos
    const diferenca = agora.getTime() - dataHoraFornecida.getTime();

    // Verificar se a diferença é menor ou igual a dois anos em milissegundos
    if (Math.abs(diferenca) <= doisAnosEmMilissegundos) {
        status = true;
    }

    return status;
}

//ABRE SUITE DETALHES
function suite_load(id){
    var url = "../suite/?id="+id;
    location.replace(url);
}

//ALTERA OPACIDADE
function altera_icon_suite(suite,icon,opacidade){

    var element;
    var index;
  
    //PORTA
    if(icon == 1){
        index = "icon_porta_"+suite
        element = document.getElementById(index);
    }
    //LAMPADA
    else  if(icon == 2){
        index = "icon_iluminacao_"+suite
        element = document.getElementById(index);
       
    }
    //AR
    else  if(icon == 3){
        index = "icon_ar_"+suite
        element = document.getElementById(index);
    }
    //CHAPINHA
    else  if(icon == 4){
        index = "icon_tomada_"+suite
        element = document.getElementById(index);
    }
    //TV
    else  if(icon == 5){
        index = "icon_tv_"+suite
        element = document.getElementById(index);
    }
    //AUDIO
    else  if(icon == 6){
        index = "icon_audio_"+suite
        element = document.getElementById(index);
    }

    element.style.opacity = opacidade;
    
}

//EXISTE LAMPADA LIGADA
function existe_lampada_ligada(json){
 
var existe = false;

if(suite_online(json['visto'])){
 if(json['l1'] == "1"){
    existe = true;
 }else if(json['l2'] == "1"){
    existe = true;
 }else if(json['l3'] == "1"){
    existe = true;
 }else if(json['l4'] == "1"){
    existe = true;
 }else if(json['l5'] == "1"){
    existe = true;
 }else if(json['l6'] == "1"){
    existe = true;
 }
}

 if(existe){
    altera_icon_suite(json['id'],2,"1")
 }else{
    altera_icon_suite(json['id'],2,"0.1")
 }


}

//EXISTE PORTA ABERTA
function existe_porta_aberta(json){
 
    var existe = false;
    
    if(suite_online(json['visto'])){
     if(json['porta_cliente'] == "0"){
        existe = true;
     }else if(json['porta_servico'] == "0"){
        existe = true;
     }
    }
    
     if(existe){
        altera_icon_suite(json['id'],1,"1")
     }else{
        altera_icon_suite(json['id'],1,"0.1")
     }
    
    
}

//EXISTE CHAPINHA
function existe_chapinha_ligada(json){
 
    var existe = false;
    
    if(suite_online(json['visto'])){
     if(json['chapinha'] == "1"){
        existe = true;
     }
    }
    
     if(existe){
        altera_icon_suite(json['id'],4,"1")
     }else{
        altera_icon_suite(json['id'],4,"0.1")
     }
    
    
}

//EXISTE TV
function existe_tv_ligada(json){
 
    var existe = false;
    
    if(suite_online(json['visto'])){
     if(json['tv'] == "1"){
        existe = true;
     }
    }
    
     if(existe){
        altera_icon_suite(json['id'],5,"1")
     }else{
        altera_icon_suite(json['id'],5,"0.1")
     }
    
    
}