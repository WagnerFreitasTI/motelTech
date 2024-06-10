var id_suite = document.getElementById("id_suite");
var op_suite = document.getElementById("op_suite");
var nome_suite = document.getElementById("nome_suite");
var hardware_suite = document.getElementById("hardware_suite");
var titulo_modal_suite = document.getElementById("titulo_modal");


//INICIA
$(document).ready(function () {
    busca_tabela(true)
    busca_hardware();
});



//BUSCA TABELA SUITE
function busca_tabela(renderiza) {
    $.ajax({
        url: "../../src/suite/index",
        method: 'GET',
        dataType: 'html',
        data: 'op=todas_suites'
    })

        .done(function (data) {

            console.log(data)

            //  try {
            var obj_json = JSON.parse(data);
            var tabela = $('#tabela_suite tbody');
            tabela.empty();
            tabela.html('');
            if (obj_json['status'] === "sucesso") {
                $.each(obj_json['data'], function (index, item) {
                    var linha = $('<tr>');


                    linha.append($('<td>').text(item.id));
                    linha.append($('<td>').text(item.nome));
                    linha.append($('<td>').text(item.hardware));

                    //EDITAR
                    var botao = '<span id="editar" class="edit-icon" onClick="editar_suite(this)"> &#9998; </span>'
                    botao += '<span id="deletar" class="delete-icon" onClick="deletar_suite(' + item.id + ')">&#10006;</span> '
                    linha.append($('<td>').html(botao));

                    tabela.append(linha);

                });

                if (renderiza) {
                    $('#tabela_suite').DataTable({
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


//ADICIONAR SUITE
$(document).ready(function () {
    $("#adicionar_suite").on("click", function () {
        $('#titulo_modal_suite').text("Adicionar suite");
        $('#nome_suite').val(" ");
        $('#op_suite').val("adicionar");
        $('#id_suite').val(" ");


        $("#modal_novo").modal('show');

    });
});


//EDITAR VARIAVEL  
function editar_suite(botaoEditar) {
    // obter a linha da tabela correspondente ao botão de editar clicado
    var linha = botaoEditar.parentNode.parentNode
    linha.id = "editar-suite";

    // obter os dados da linha
    var dados = linha.querySelectorAll("td")

    // preencher os campos do modal com os dados da linha
    id_suite.value = dados[0].textContent
    op_suite.value = "editar"
    nome_suite.value = dados[1].textContent
    setSelect("hardware_suite", dados[2].textContent)




    // abrir o modal
    $('#titulo_modal_suite').text("Editar suite");
    $("#modal_novo").modal('show');



}

//ACAO EDITAR ADICIONAR
$(document).ready(function () {
    $("#salvar_suite").on("click", function () {

        $.ajax({
            url: "../../src/suite/index.php",
            method: 'POST',
            dataType: 'html',
            data: $('#form_suite').serialize(),
        })

            .done(function (data) {
                console.log(data)

                console.log($('#form_suite').serialize())
                try {
                    var obj_json = JSON.parse(data);

                    if (obj_json['status'] === "sucesso") {
                        busca_tabela(false);
                        $("#modal_novo").modal('hide');
                        mensagem_sucesso("Sucesso");
                    } else if (obj_json['status'] === "existe") {
                        mensagem_warning("Já existe");
                    } else {
                        mensagem_warning("Modifique primeiro");
                    }

                } catch (e) {
                    mensagem_danger("Houve um erro inesperado");

                }

            }).fail(function (data) {

                mensagem_danger("Houve um erro inesperado");
            });


    });
});

//DELETAR 
function deletar_suite(id) {

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
                url: "../../src/suite/index.php",
                method: 'POST',
                dataType: 'html',
                data: 'op_suite=deletar&id_suite=' + id,
            })

                .done(function (data) {
                    console.log(data)
                    try {
                        var obj_json = JSON.parse(data);
                        if (obj_json['status'] === "sucesso") {
                            busca_tabela(false);
                            mensagem_sucesso("A suite foi deletado com sucesso.");
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

//BUSCA TABELA SUITE
function busca_hardware() {
    $.ajax({
        url: "../../src/device/index",
        method: 'GET',
        dataType: 'html',
        data: 'op=todos_device'
    })

        .done(function (data) {

            //LIMPA AS OPCOES AS OPCOES
            while (hardware_suite.firstChild) {
                hardware_suite.removeChild(hardware_suite.firstChild);
            }



            console.log(data)

            //  try {
            var obj_json = JSON.parse(data);

            if (obj_json['status'] === "sucesso") {
                $.each(obj_json['data'], function (index, item) {

                   //PREENCHE SELECT BOX VARIAVEL MQTT
                   let newOption = document.createElement('option');
                   newOption.value =  item.id;
                   newOption.textContent = item.nome;
                   hardware_suite.appendChild(newOption);

                });



            }

            // } catch (e) {
            //    mensagem_danger("Houve um erro inesperado");

            //  }

        }).fail(function (data) {

            mensagem_danger("Houve uma falha no sistema");
        });
}
