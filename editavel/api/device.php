<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');


require_once "../src/var_system.php";
require_once "../src/functions.php";

$pdo = require_once "../src/connection.php";

//RETORNO
$retorno_json = array();
$retorno_json['status'] = "erro";

if (($_SERVER['REQUEST_METHOD'] == 'GET'))
{    

   
    if (getQueryParam('nome') &&
        getQueryParam('ssid') &&
        getQueryParam('senha') &&
        getQueryParam('ipv4') &&
        getQueryParam('rssi') &&
        getQueryParam('token') )
    {
        $token = protect($_GET['token']);

        if($token_sistema == $token){
            $nome = protect($_GET['nome']);
            $ssid = protect($_GET['ssid']);
            $rssi = protect($_GET['rssi']);
            $senha = protect($_GET['senha']);
            $ipv4 = protect($_GET['ipv4']);
    
            $sql = "INSERT IGNORE INTO device  (nome,ssid,rssi,senha,ipv4)  VALUES (?,?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$nome,$ssid,$rssi,$senha,$ipv4]); 
            
            
                $sql = "UPDATE device  SET  ssid=?,senha=?,ipv4=?,rssi=?,ipv4=?  WHERE nome =?"; 
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$ssid,$senha,$ipv4,$rssi,$ipv4,$nome]);


                
                $retorno_json['status'] = "sucesso";
           


           
        }else{
            $retorno_json['status'] = "token invalido";
        }
       


    }else{
        $retorno_json['status'] = "falta parametros";
    }



}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 