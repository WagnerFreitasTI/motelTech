<?php 

session_start();


require_once "../../../src/var_system.php";

require_once "../../../src/functions.php";
$pdo = require_once "../../../src/connection.php";
require_once "function.php";
require_once "func_usuario.php";

protegePagina($pdo); //SOMENTE USUARIO LOGADO


//USUARIO LOGADO
$usuario = getUsuario($pdo);

 //RETORNO
 $retorno_json = array();

 $json_return = true;

//OPERACAO
$operacao = "";



//SOMENTE GET
if (($_SERVER['REQUEST_METHOD'] == 'GET'))
{

    if (getQueryParam('op') )
    {

        $operacao = protect($_GET['op']);

        //VERIFICA USUARIO DISPONIVEL
        if ($operacao == "todos_usuarios")
        {      
           

            if(!($usuario['nivel'] === "1")){
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = busca_all_usuario($pdo,$usuario);
               }else{
                $retorno_json['status'] = "erro";
               }
               
                
        } 
        //ATUALIZA DASH
        else if ($operacao == "dashboard")
        {
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = dashboard_usuario($pdo);

        }
        //LOGS
        else if ($operacao == "logs")
        {      
           

                if(!($usuario['nivel'] === "1")){
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = busca_logs($pdo);
               }else{
                $retorno_json['status'] = "erro";
               }
               
                
        } 
      
        

    }

    

}
//METODO POST
else if (($_SERVER['REQUEST_METHOD'] == 'POST')){

  
    if (postQueryParam('op') )
    {

        $operacao = protect($_POST['op']);

        //ALTERAR SENHA 
        if ($operacao == "alterar_senha")  {
            if (  postQueryParam('antiga') &&   postQueryParam('nova')  ){
            $id_usuario  = $usuario['id'];
            $antiga  = protect($_POST['antiga']);
            $nova  = protect($_POST['nova']);
           

            $retorno_json['mensagem'] = alterar_senha($pdo,$id_usuario,$antiga,$nova) ? "sucesso":"erro";
   
             }  
        }
        
        //ADICIONAR
        else if ($operacao == "adicionar")  {
            if (  postQueryParam('nome') &&   postQueryParam('login') &&   postQueryParam('senha')  &&   postQueryParam('nivel') ){

                if(!($usuario['nivel'] === "1")){
                    $nome  = protect($_POST['nome']);
                    $login  = protect($_POST['login']);
                    $senha  = protect($_POST['senha']);
                    $nivel  = protect($_POST['nivel']);

                    if(!busca_usuario_login($pdo,$login)){
                        $retorno_json['mensagem'] = adicionar_usuario($pdo,$login,$senha,$nome,$nivel,"1") ? "sucesso":"erro";

                    }else{
                        $retorno_json['mensagem'] = "existe";
                    }
                   

                }else{
                    $retorno_json['mensagem'] = "erro";
                }
           
           
   
             }  
        }

        //EXCLUIR
        else if ($operacao == "excluir")  {
            if (  postQueryParam('id_usuario') ){
               
                if(!($usuario['nivel'] === "1")){
                    $id_usuario  = protect($_POST['id_usuario']);
                        $retorno_json['mensagem'] = deletar_usuario($pdo,$id_usuario) ? "sucesso":"erro";
                      
                    }else{
                    $retorno_json['mensagem'] = "erro";
                }
              
             }  
        }

          //EDITAR
          else if ($operacao == "editar")  {
            if ( postQueryParam('status') && postQueryParam('nome') &&   postQueryParam('login') &&   postQueryParam('id')  &&   postQueryParam('nivel') ){

                if(!($usuario['nivel'] === "1")){
                    $nome  = protect($_POST['nome']);
                    $login  = protect($_POST['login']);
                    $senha  = protect($_POST['senha']);
                    $nivel  = protect($_POST['nivel']);
                    $id  = protect($_POST['id']);
                    $status  = protect($_POST['status']);

                    if(!busca_usuario_login_id($pdo,$login,$id)){
                        $retorno_json['mensagem'] = alterar_usuario($pdo,$id,$login,$senha,$nome,$nivel,$status) ? "sucesso":"erro";

                    }else{
                        $retorno_json['mensagem'] = "existe";
                    }
                   

                }else{
                    $retorno_json['mensagem'] = "erro";
                }
           
           
   
             }  
        }
 
    }

}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 