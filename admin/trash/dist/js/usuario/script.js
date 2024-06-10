
//PRESSIONA O ENTER
$(document).keypress(function (e) {
    if (e.which == 13) {
        request_login();
    }
});


$(document).ready(function () {
    $("#autenticar").click(function () {
        event.preventDefault();
        request_login();
    });
});

function request_login() {

    var form = $("#form_login");
    var mensagem = "";

    $.ajax({
        url: "src/usuario/autenticacao.php",
        method: "POST",
        dataType: "html",
        data: form.serialize()
    }).done(function (data) {
     

        if (data === "success") {
            mensagem = " Logado com sucesso!";
            mensagem_sucesso(mensagem);
            window.location.href = "sistema/home";
        } else if (data === "user") {
            mensagem = " Preencha o campo Usuário!";

        } else if (data === "pass") {
            mensagem = " Preencha o campo Senha!";

        } else if (data === "error") {
            mensagem = "Dados incorreto!";

        }
        else {
            mensagem = " Preencha todos os campos!";

        }


        mensagem_danger(mensagem)

    }).fail(function (data) {

        mensagem = "Não foi possivel, erro no servidor!";
        mensagem_danger(mensagem)
    });

}


