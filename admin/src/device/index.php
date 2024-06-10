<?php

session_start();
require_once "../../../src/functions.php";
require_once "../../src/usuario/function.php";
require_once "function.php";
$pdo = require_once "../../../src/connection.php";
protegePagina($pdo); //SOMENTE USUARIO LOGADO


//USUARIO LOGADO
$usuario = getUsuario($pdo);

 //RETORNO
 $retorno_json = array();
 $retorno_json['status'] = "erro";
 $json_return = true;

//OPERACAO
$operacao = "";
$nome  = " ";
$suite = " ";


//SOMENTE GET
if (($_SERVER['REQUEST_METHOD'] == 'GET'))
{

    if (isset($_GET['op']) )
    {

        $operacao = protect($_GET['op']);

        //LISTA TODAS SUITES
        if ($operacao == "todos_device")
        {
                $retorno_json['status'] = "sucesso";
                $retorno_json['data'] = busca_all_device($pdo);
                
        }

    }

    

}
//METODO POST
else if (($_SERVER['REQUEST_METHOD'] == 'POST')){
   
    if (isset($_POST['op']) )
    {
        
       
        $operacao = $_POST['op'];

       
           //DELETAR
            if($operacao == "deletar"){
            if (  isset( $_POST['id_device'] )){
            

                $device = protect( $_POST['id_device']);
                $retorno_json['status'] = deletar_device($pdo,$device) ? "sucesso":"erro";
                
             }

         }


     



    }
     
    
}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 


