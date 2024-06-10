<?php 

session_start();

require_once "../var_system.php";
require_once "../functions.php";
require_once "function.php";
require_once "func_usuario.php";

$pdo = require_once "../connection.php";
protegePagina($pdo); //SOMENTE USUARIO LOGADO


//USUARIO LOGADO
$usuario = getUsuario($pdo);

 //RETORNO
 $retorno_json = array();
 $retorno_json['status'] = "erro";
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
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = busca_all_usuario($pdo);
                
        } 
        //ATUALIZA DASH
        else if ($operacao == "dashboard")
        {
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = dashboard_usuario($pdo);

        }
      
        

    }

    

}
//METODO POST
else if (($_SERVER['REQUEST_METHOD'] == 'POST')){

  
    if (postQueryParam('op') )
    {

        $operacao = protect($_POST['op']);

        //EDITAR 
        if ($operacao == "editar")  {
            if (  postQueryParam('id_usuario') && 
            postQueryParam('login') && 
            postQueryParam('senha') && 
            postQueryParam('nome')  &&
            postQueryParam('nivel')  &&
            postQueryParam('status') 
             ){
            $id_usuario  = protect($_POST['id_usuario']);
            $login  = protect($_POST['login']);
            $senha  = protect($_POST['senha']);
            $nome  = protect($_POST['nome']);
            $nivel  = protect($_POST['nivel']);
            $status  = protect($_POST['status']);

            $retorno_json['status'] = alterar_usuario($pdo, $id_usuario,$login,$senha,$nome,$nivel,$status) ? "sucesso":"erro";
   
             }
             
                
                
        }
        
       //DELETAR 
       else  if ($operacao == "deletar")
         {
            
            if (postQueryParam('id_usuario') ){
 
                $id_usuario = protect($_POST['id_usuario']);
                $retorno_json['status'] = deletar_usuario($pdo,$id_usuario) ? "sucesso":"erro";
      
            }
                 
                 
         }

         //ADICIONAR 
       else if ($operacao == "adicionar")
        {
            if (postQueryParam('login') && 
                postQueryParam('senha')  && 
                postQueryParam('nome')  &&
                postQueryParam('nivel')  &&
                postQueryParam('status') 
             ){

                $login  = protect($_POST['login']);
                $senha  = protect($_POST['senha']);
                $nome  = protect($_POST['nome']);
                $nivel  = protect($_POST['nivel']);
                $status  = protect($_POST['status']);

                $retorno_json['status'] = adicionar_usuario($pdo,$login,$senha,$nome,$nivel,$status) ? "sucesso":"existe";


      
            }
             
                
                
        }

    }

}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 


