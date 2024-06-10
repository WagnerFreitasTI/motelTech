
var lang_datatable = {
    "lengthMenu": "Mostrar _MENU_ registros por página",
    "zeroRecords": "Nenhum registro encontrado",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
    "infoFiltered": "(filtrado de _MAX_ registros no total)",
    "search": "Pesquisar:",
    "paginate": {
        "first": "Primeiro",
        "last": "Último",
        "next": "Próximo",
        "previous": "Anterior"
    }
};


function isTablet() {
  var userAgent = navigator.userAgent.toLowerCase();
  var keywords = ["tablet", "ipad", "android"];

  for (var i = 0; i < keywords.length; i++) {
    if (userAgent.indexOf(keywords[i]) !== -1) {
      return true;
    }
  }

  return false;
}

function mensagem_danger(mensagem) {
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Atenção',
        backdrop: `
    rgba(60,60,60,0.8)`,
        title: mensagem,
        showConfirmButton: false,
        timer: 3000
    });

}

function mensagem_warning(mensagem) {
  Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'Atenção',
      backdrop: `
  rgba(60,60,60,0.8)`,
      title: mensagem,
      showConfirmButton: false,
      timer: 3000
  });

}

function mensagem_sucesso(mensagem) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        backdrop: `
    rgba(60,60,60,0.8)`,
        title: mensagem,
        showConfirmButton: false,
        timer: 1000
    });

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


  //MUDA SELECT BY TEXTO 
function setSelect(idSelect, text) {
  var select = document.getElementById(idSelect);
  for (var i = 0; i < select.options.length; i++) {
      if (select.options[i].text === text) {
          select.selectedIndex = i;
          break;
      }
  }
}



  //Recepcao
function liga_recepcao() {

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


//CONSULTA RELOAD PAGE
$(document).ready(function () {
  if(is_tablet){ 
      setInterval(atualiza_page, 3000);
  }
});

function atualiza_page() {
  
  if(is_tablet){ 
  $.ajax({
      url: '../src/suite/index',
      method: 'GET',
      dataType: 'html',
      data: 'op=reload&id_suite='+suite
  })

      .done(function (data) {
   
         console.log(data)
       
            
          try {
              var obj_json = JSON.parse(data);
              if (obj_json['mensagem'] === "sucesso" && (obj_json['reload'] == true)) {
                
                location.reload();

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

}
