


//INICIA
$(document).ready(function () {
    busca_tabela(true)
});



//BUSCA TABELA SUITE
function busca_tabela(renderiza) {
    $.ajax({
        url: "../../src/acesso/index",
        method: 'GET',
        dataType: 'html',
        data: 'op=todos_acesso'
    })

        .done(function (data) {

        

            //  try {
            var obj_json = JSON.parse(data);
            var tabela = $('#tabela_acesso tbody');
            tabela.empty();
            tabela.html('');
            if (obj_json['status'] === "sucesso") {
                $.each(obj_json['data'], function (index, item) {
                    var linha = $('<tr>');
                    var nome_suite ="Sem suite"
                    if (item.suite !== null) {
                        nome_suite = item.suite
                        
                    }
                   


                    linha.append($('<td>').text( item.id_user));
                    linha.append($('<td>').text(item.device_name));
                    linha.append($('<td>').text(item.navegador));

                    linha.append($('<td>').text(nome_suite));
                    linha.append($('<td>').text(item.visto));
              

                    //EDITAR
                    var botao = ' ';
                    botao += '<span id="deletar" class="delete-icon" onClick="deletar_device('+item.id_user+')">&#10006;</span> '
                    linha.append($('<td>').html(botao));

                    tabela.append(linha);

                });

                if (renderiza) {
                    $('#tabela_acesso').DataTable({
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
                url: "../../src/acesso/index.php",
                method: 'POST',
                dataType: 'html',
                data: 'op=deletar&id_acesso='+id,
            })

                .done(function (data) {
                 
                    try {
                        var obj_json = JSON.parse(data);
                        if (obj_json['status'] === "sucesso") {
                            busca_tabela(false);
                            mensagem_sucesso("O acesso foi deletado com sucesso.");
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