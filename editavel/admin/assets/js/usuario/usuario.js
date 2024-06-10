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
        data: 'op=todos_usuarios'
    })

        .done(function (data) {

            console.log(data)

            //  try {
            var obj_json = JSON.parse(data);
            console.log(obj_json)
            var tabela = $('#tabela_usuarios tbody');
            tabela.empty();
            tabela.html('');
            if (obj_json['status'] === "sucesso") {
                $.each(obj_json['data'], function (index, item) {
                    var linha = $('<tr style="text-align: center; ">');


                    linha.append($('<td>').text( item.id));
                    linha.append($('<td>').text(item.nome));
                    linha.append($('<td>').html(item.login));
                    
                    linha.append($('<td>').text(get_nivel_usuario(item.nivel) ));
                    linha.append($('<td>').html(get_status_usuario(item.status) ));

                    //EDITAR
                    var botao = '<span id="editar" class="edit-icon" onClick="editar_usuario(this) "> &#9998; </span> ';
                    botao += '<span id="deletar" class="delete-icon" onClick="deletar_usuario('+item.id+',this)">&#10006;</span> '
                  
                    linha.append($('<td>').html(botao));

                    tabela.append(linha);

                });

                if (renderiza) {
                    $('#tabela_usuarios').DataTable({
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

function get_nivel_usuario(nivel){
    var str_nivel = "nehum"
    if(nivel == 1){
        str_nivel = "Recepcionista"
    }else if(nivel == 2){
        str_nivel = "Direção"
    }else{
        str_nivel = "Root"
    }
return str_nivel;
}

function get_status_usuario(status){
    var status_str = " ";
  if(status == 1){
    status_str = '<span class="badge bg-success align-self-center rounded-pill ms-auto">Ativo</span>';
  }else{
    status_str = '<span class="badge bg-danger align-self-center rounded-pill ms-auto">Desativado</span>';
  }
  return status_str;
}


//ADICIONAR USUARIO
function adicionar_usuario() {
    Swal.fire({
      title: 'Adicionar Usuário',
      html:
      ` <div class="mb-1">
        <label class="form-label">Nome</label>
        <div class="form-control-feedback form-control-feedback-start">
            <input type="text" class="form-control" placeholder=" " id="nome" name="nome">
            <div class="form-control-feedback-icon">
            <i class="ph-address-book  text-muted"></i>
            </div>
        </div>
      </div>` +
      ` <div class="mb-1">
      <label class="form-label">Login</label>
      <div class="form-control-feedback form-control-feedback-start">
          <input type="text" class="form-control" placeholder=" " id="login" name="login">
          <div class="form-control-feedback-icon">
          <i class="ph-at  text-muted"></i>
          </div>
      </div>
    </div>` +
    ` <div class="mb-1">
    <label class="form-label">Senha</label>
    <div class="form-control-feedback form-control-feedback-start">
        <input type="text" class="form-control" placeholder=" " id="senha" name="senha">
        <div class="form-control-feedback-icon">
        <i class="ph-lock text-muted"></i>
        </div>
    </div>
  </div>` +
  ` <div class="mb-1">
  <label class="form-label">Nível</label>
  <div class="form-control-feedback form-control-feedback-start">
  <select class="form-select form-select-lg"  id="nivel" name="nivel">
  <option value="1">Recepcionista</option>
  <option value="2">Direção</option>
</select>
      
  </div>
</div>`,
      showCancelButton: true,
      confirmButtonText: 'Adicionar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#9700bd',
      cancelButtonColor: '#212529',
      preConfirm: () => {
        const nome = Swal.getPopup().querySelector('#nome').value;
        const login = Swal.getPopup().querySelector('#login').value;
        const senha = Swal.getPopup().querySelector('#senha').value;
        const nivel = Swal.getPopup().querySelector('#nivel').value;

        return { nome: nome, login: login, senha: senha , nivel: nivel };
      }
    }).then((result) => {
      if (result.isConfirmed) {

        const nome = result.value.nome;
        const login = result.value.login;
        const senha = result.value.senha;
        const nivel = result.value.nivel;
        if((nome.trim() !== "") && (login.trim() !== "")  && (senha.trim() !== "") && (nivel.trim() !== "")){
        $.ajax({
            url: '../../src/usuario/usuario',
            method: 'POST',
            dataType: 'html',
            data: 'op=adicionar&nome='+nome+'&login='+login+'&senha='+senha+'&nivel='+nivel
        })
    
            .done(function (data) {
             console.log(data)
    
                try {
                  var obj_json = JSON.parse(data);
                  if (obj_json['mensagem'] === "sucesso") {
                    busca_tabela(false);
                    mensagem_sucesso("Usuário "+nome+" foi adicionado com sucesso");
                    
                  }else if (obj_json['mensagem'] === "existe") {
                    mensagem_danger("Login já existe!");
                    setTimeout(adicionar_usuario, 2000);
                  }else{
                    mensagem_danger("Houve um erro");
                    setTimeout(adicionar_usuario, 2000);
                  }
               
    
    
                } catch (e) {
                    mensagem_danger("Houve um erro inesperado");
                    setTimeout(adicionar_usuario, 2000);
    
                }
    
    
            }).fail(function (data) {
              
    
            });

        }else{
            mensagem_danger("Preencha todos os campos!");
            setTimeout(adicionar_usuario, 2000);
        }
       

        
      }
    });
  }


//DELETAR USUARIO
function deletar_usuario(id,elemento) {

    Swal.fire({
        title: 'Deletar?',
        text: "Deseja realmente deletar o usuário?",
       
    
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          },
        showCancelButton: true,
        confirmButtonColor: '#9700bd',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero deletar!',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../src/usuario/usuario',
                method: 'POST',
                dataType: 'html',
                data: 'op=excluir&id_usuario='+id
            })
            
                .done(function (data) {
            console.log(data)
                    try {
                        var obj_json = JSON.parse(data);
            
                        if (obj_json['mensagem'] === "sucesso") {
                            mensagem_sucesso("Usuário deletado com sucesso");
                            $(elemento).closest('tr').remove();

                        } else {
                            mensagem_danger("Houve um erro");
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



//ADICIONAR USUARIO
function editar_usuario(editar) {

    var linha = editar.parentNode.parentNode
    var dados = linha.querySelectorAll("td")


    Swal.fire({
      title: 'Adicionar Usuário',
      html:
      `             
      <input type="hidden"  id="id" name="id" value="${dados[0].textContent}">
      <div class="mb-1">
        <label class="form-label">Nome</label>
        <div class="form-control-feedback form-control-feedback-start">
            <input type="text" class="form-control" placeholder=" " id="nome" name="nome" value="${dados[1].textContent}">
            <div class="form-control-feedback-icon">
            <i class="ph-address-book  text-muted"></i>
            </div>
        </div>
      </div>` +
      ` <div class="mb-1">
      <label class="form-label">Login</label>
      <div class="form-control-feedback form-control-feedback-start">
          <input type="text" class="form-control" placeholder=" " id="login" name="login" value="${dados[2].textContent}">
          <div class="form-control-feedback-icon">
          <i class="ph-at  text-muted"></i>
          </div>
      </div>
    </div>` +
    ` <div class="mb-1">
    <label class="form-label">Senha</label>
    <div class="form-control-feedback form-control-feedback-start">
        <input type="text" class="form-control" placeholder=" " id="senha" name="senha" >
        <div class="form-control-feedback-icon">
        <i class="ph-lock text-muted"></i>
        </div>
    </div>
  </div>` +
  ` <div class="mb-1">
  <label class="form-label">Nível</label>
  <div class="form-control-feedback form-control-feedback-start">
  <select class="form-select form-select-lg"  id="nivel" name="nivel" >
  <option value="1">Recepcionista</option>
  <option value="2">Direção</option>
  </select>
      
   </div>
  </div>`+
  ` <div class="mb-1">
  <label class="form-label">Status</label>
  <div class="form-control-feedback form-control-feedback-start">
  <select class="form-select form-select-lg"  id="status_user" name="status_user" >
  <option value="0">Desativado</option>
  <option value="1">Ativo</option>
  </select>
      
   </div>
  </div>`,

      showCancelButton: true,
      confirmButtonText: 'Editar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#9700bd',
      cancelButtonColor: '#212529',
      didOpen: () => {
        setSelect("nivel", dados[3].textContent)
        setSelect("status_user", dados[4].textContent)
      },
  
      preConfirm: () => {
        const id = Swal.getPopup().querySelector('#id').value;
        const nome = Swal.getPopup().querySelector('#nome').value;
        const login = Swal.getPopup().querySelector('#login').value;
        const senha = Swal.getPopup().querySelector('#senha').value;
        const nivel = Swal.getPopup().querySelector('#nivel').value;
        const status_user = Swal.getPopup().querySelector('#status_user').value;
       
        return { nome: nome, login: login, senha: senha , nivel: nivel, id:id, status_user:status_user };
      }
      
    }).then((result) => {
     
      if (result.isConfirmed) {
        const id = result.value.id;
        const nome = result.value.nome;
        const login = result.value.login;
        const senha = result.value.senha;
        const nivel = result.value.nivel;
        const status_user = result.value.status_user;

        if((nome.trim() !== "") && (login.trim() !== "")  && (nivel.trim() !== "")){
        $.ajax({
            url: '../../src/usuario/usuario',
            method: 'POST',
            dataType: 'html',
            data: 'op=editar&nome='+nome+'&login='+login+'&senha='+senha+'&nivel='+nivel+'&id='+id+'&status='+status_user
        })
    
            .done(function (data) {
             console.log(data)
    
                try {
                  var obj_json = JSON.parse(data);
                  if (obj_json['mensagem'] === "sucesso") {
                    busca_tabela(false)
                    mensagem_sucesso("Usuário "+nome+" foi editado com sucesso");
                    
                   
                  }else if (obj_json['mensagem'] === "existe") {
                    mensagem_danger("Login já existe!");
                    setTimeout(editar_usuario(editar), 5000);
                  }else{
                    mensagem_danger("Houve um erro");
                    setTimeout(editar_usuario(editar), 5000);
                  }
               
    
    
                } catch (e) {
                    mensagem_danger("Houve um erro inesperado");
                    setTimeout(editar_usuario(editar), 5000);
    
                }
    
    
            }).fail(function (data) {
              
    
            });

        }else{
            mensagem_danger("Preencha todos os campos!");
            setTimeout(editar_usuario(editar), 5000);
        }
       

        
      }
    });
  }

