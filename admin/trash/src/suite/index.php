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
if (($_SERVER['REQUEST_METHOD'] == 'GET')) {

    if (isset($_GET['op'])) {

        $operacao = protect($_GET['op']);

        //LISTA TODAS SUITES
        if ($operacao == "todas_suites") {
            $retorno_json['status'] = "sucesso";
            $retorno_json['data'] = busca_all_suite($pdo);
        }
    }
}
//METODO POST
else if (($_SERVER['REQUEST_METHOD'] == 'POST')) {

    if (isset($_POST['op_suite'])) {


        $operacao = $_POST['op_suite'];

        //EDITAR 
        if ($operacao == "editar") {


            if (isset($_POST['id_suite']) && isset($_POST['nome_suite'])) {


                $suite = protect($_POST['id_suite']);
                $nome = protect($_POST['nome_suite']);
                $hardware = protect($_POST['hardware_suite']);

                $retorno_json['status'] = alterar_suite($pdo, $suite, $nome, $hardware) ? "sucesso" : "erro";
            }
        }

        //ADICIONAR
        else if ($operacao == "adicionar") {
            if (
                isset($_POST['nome_suite']) &&
                isset($_POST['hardware_suite'])

            ) {


                $nome = protect($_POST['nome_suite']);
                $hardware = protect($_POST['hardware_suite']);
                $retorno_json['status'] = adicionar_suite($pdo, $nome, $hardware) ? "sucesso" : "erro";
            }
        }
        //DELETAR
        else if ($operacao == "deletar") {
            if (isset($_POST['id_suite'])) {


                $suite = protect($_POST['id_suite']);
                $retorno_json['status'] = deletar_suite($pdo, $suite) ? "sucesso" : "erro";
            }
        }
    }
}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json);
