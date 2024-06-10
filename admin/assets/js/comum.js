



function alterar_senha() {
    Swal.fire({
      title: 'Alteração de senha',
      html:
      ` <div class="mb-3">
        <label class="form-label">Senha antiga</label>
        <div class="form-control-feedback form-control-feedback-start">
            <input type="text" class="form-control" placeholder=" " id="senha_antiga" name="senha_antiga">
            <div class="form-control-feedback-icon">
            <i class="ph-lock text-muted"></i>
            </div>
        </div>
      </div>` +
      ` <div class="mb-3">
      <label class="form-label">Nova senha</label>
      <div class="form-control-feedback form-control-feedback-start">
          <input type="text" class="form-control" placeholder=" " id="nova_senha" name="nova_senha">
          <div class="form-control-feedback-icon">
          <i class="ph-lock text-muted"></i>
          </div>
      </div>
    </div>` ,
      showCancelButton: true,
      confirmButtonText: 'Enviar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#9700bd',
      cancelButtonColor: '#212529',
      preConfirm: () => {
        const senha_antiga = Swal.getPopup().querySelector('#senha_antiga').value;
        const nova_senha = Swal.getPopup().querySelector('#nova_senha').value;
        return { senha_antiga: senha_antiga, nova_senha: nova_senha };
      }
    }).then((result) => {
      if (result.isConfirmed) {

        const senha_antiga = result.value.senha_antiga;
        const nova_senha = result.value.nova_senha;
        if((senha_antiga.trim() !== "") && (nova_senha.trim() !== "")){
        $.ajax({
            url: '../../src/usuario/usuario',
            method: 'POST',
            dataType: 'html',
            data: 'op=alterar_senha&antiga='+senha_antiga+'&nova='+nova_senha
        })
    
            .done(function (data) {
             
    
                try {
                  var obj_json = JSON.parse(data);
                  if (obj_json['mensagem'] === "sucesso") {
                    mensagem_sucesso("Senha alterada com sucesso");
                    location.replace("../../sair");
                  }else{
                    mensagem_danger("Senha antiga incorreta!");
                    setTimeout(alterar_senha, 2000);
                  }
               
    
    
                } catch (e) {
                    mensagem_danger("Houve um erro inesperado");
                    setTimeout(alterar_senha, 2000);
    
                }
    
    
            }).fail(function (data) {
              
    
            });

        }else{
            mensagem_danger("Preencha todos os campos!");
            setTimeout(alterar_senha, 2000);
        }
       

        
      }
    });
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