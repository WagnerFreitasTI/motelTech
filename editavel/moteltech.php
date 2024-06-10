<?php
session_start();
require_once "src/var_system.php";
require_once "src/functions.php";
require_once "src/user/function.php";
require_once "src/suite/function.php";
$pdo = require_once "src/connection.php";


if (($_SERVER['REQUEST_METHOD'] == 'GET')) {

   
    $qrcode =  getQueryParam('poa_rs') ?  protect($_GET['poa_rs']) : "null";
    $cliente =  getQueryParam('goesconect') ?  protect($_GET['goesconect']) : "null";
    

    if(($cliente  == "medieval") & (valida_qrcode($pdo,$qrcode))){    
        $id_suite = recebe_suite_id($pdo,$qrcode);
        $nome_usuario = recebe_nome_user();
        set_suite($pdo,$nome_usuario ,$id_suite);
        set_reload_page($pdo,$id_suite);
        header('Location: /home');
    }else{
        echo "<span style='color:red;'> Acesso não autorizado </span>";
    
    }
  

}else{
    echo "<span style='color:red;'> Acesso não autorizado </span>";
 
}










?>