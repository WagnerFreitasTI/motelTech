<?php
session_start();

require_once "function.php";
require_once "../functions.php";
require_once "../var_system.php";
$pdo = require_once "../connection.php";


$retorno_json['mensagem'] = "erro";

//SOMENTE GET
if (($_SERVER['REQUEST_METHOD'] == 'GET'))
{

    if (isset($_GET['op']) )
    {

        $operacao = protect($_GET['op']);

        //
        if ($operacao == "reload")
        { 
            if (  isset( $_GET['id_suite'] )){
            
                $id_suite = protect($_GET['id_suite']);
                $retorno_json['mensagem'] = "sucesso";
                $retorno_json['reload'] = get_reload_page($pdo,$id_suite);
                
             }

               

        } 
     }

    

}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 