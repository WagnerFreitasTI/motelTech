//INICIA
$(document).ready(function () {
    busca_tabela(true)
});


//BUSCA TABELA 
function busca_tabela(renderiza) {

    $.ajax({
        url: '../../src/usuario/usuario',
        method: 'GET',
        dataType: 'html',
        data: 'op=logs'
    })

        .done(function (data) {

            console.log(data)

            //  try {
            var obj_json = JSON.parse(data);
            console.log(obj_json)
            var tabela = $('#tabela_usuarios_log tbody');
            tabela.empty();
            tabela.html('');
            if (obj_json['status'] === "sucesso") {

                $.each(obj_json['data'], function (index, item) {
                    var linha = $('<tr style="text-align: center; ">');


                    linha.append($('<td>').text( item.id));
                    linha.append($('<td>').text(item.nome));
                    linha.append($('<td>').html(item.datatime));
                    tabela.append(linha);

                });



                if (renderiza) {
                    $('#tabela_usuarios_log').DataTable({
                        // "language": lang_datatable,
                        "pageLength": 4,
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




