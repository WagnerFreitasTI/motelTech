var id_device = document.getElementById("id_device");
var op_device = document.getElementById("op_device");
var nome_device = document.getElementById("nome_device");
var titulo_modal_device  = document.getElementById("titulo_modal_device");


//INICIA
$(document).ready(function () {
    busca_tabela(true)
});



//BUSCA TABELA SUITE
function busca_tabela(renderiza) {
    $.ajax({
        url: "../../src/device/index",
        method: 'GET',
        dataType: 'html',
        data: 'op=todos_device'
    })

        .done(function (data) {

            console.log(data)

            //  try {
            var obj_json = JSON.parse(data);
            console.log(obj_json)
            var tabela = $('#tabela_device tbody');
            tabela.empty();
            tabela.html('');
            if (obj_json['status'] === "sucesso") {
                $.each(obj_json['data'], function (index, item) {
                    var linha = $('<tr>');


                    linha.append($('<td>').text( item.id));
                    linha.append($('<td>').text(item.nome));
                    var rssi = item.ssid + " - " + qualidade_rssi(item.rssi); 
                    linha.append($('<td>').html(rssi));
                    linha.append($('<td>').text(item.ipv4));
                    linha.append($('<td>').text(item.visto));

                    //EDITAR
                    var botao = ' ';
                    botao += '<span id="deletar" class="delete-icon" onClick="deletar_device('+item.id+')">&#10006;</span> '
                    linha.append($('<td>').html(botao));

                    tabela.append(linha);

                });

                if (renderiza) {
                    $('#tabela_device').DataTable({
                        // "language": lang_datatable,
                        "pageLength": 5,
                        "lengthChange": false,
                        "searching": false,
                        "info": false
                    });
                   
                }

            }

            // } catch (e) {
            //    mensagem_danger("Houve um erro inesperado");

            //  }

        }).fail(function (data) {

            mensagem_danger("Houve uma falha no sistema");
        });
}







//DELETAR 
function deletar_device(id) {

    Swal.fire({
        title: 'Deletar!',
        text: "Deseja realmente deletar?",
        icon: 'error',
        showCancelButton: true,
        backdrop: `rgba(60,60,60,0.8)`,
        confirmButtonText: 'Sim, quero deletar!',
        confirmButtonColor: "#c03221"
    }).then((result) => {
        if (result.isConfirmed) {


            $.ajax({
                url: "../../src/device/index.php",
                method: 'POST',
                dataType: 'html',
                data: 'op=deletar&id_device='+id,
            })

                .done(function (data) {
                    console.log(data)
                    try {
                        var obj_json = JSON.parse(data);
                        if (obj_json['status'] === "sucesso") {
                            busca_tabela(false);
                            mensagem_sucesso("O device foi deletado com sucesso.");
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



function qualidade_rssi(rssi) {
    rssi = Math.abs(rssi);
    let html = "<span class=\"text-danger\">Sem sinal</span>";
  
    if (rssi >= 50 && rssi <= 59) {
      html = "<span class=\"text-success\">Excelente</span>";
    } else if (rssi >= 60 && rssi <= 69) {
      html = "<span class=\"text-info\">Ótimo</span>";
    } else if (rssi >= 70 && rssi <= 79) {
      html = "<span class=\"text-warning\">Bom</span>";
    } else if (rssi >= 80 && rssi <= 89) {
      html = "<span class=\"text-danger\">Baixo</span>";
    } else if (rssi >= 90) {
      html = "<span class=\"text-danger\">Muito Baixo</span>";
    }
  
    return html;
  }