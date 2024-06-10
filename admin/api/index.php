<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

require_once "../../src/var_system.php";
require_once "../../src/functions.php";

$pdo = require_once "../../src/connection.php";


$return['mensagem'] = "erro";


  


if (isset($_GET['token']) )
{

        $token = protect($_GET['token']);
		$id_suite = protect($_GET['id']);
		$ssid = protect($_GET['ssid']);
        $senha = protect($_GET['senha']);
        $ipv4 = protect($_GET['ipv4']);
        $rssi = protect($_GET['rssi']);
        $status_suite = protect($_GET['status_suite']);
        $fw = protect($_GET['fw']);
        $mac = protect($_GET['mac']);


    
   

         
		if(true){
            $sql = "UPDATE device  SET mac=?, fw=?, ssid=?, senha=?, ipv4=?, rssi=?, status_suite=?,visto=? WHERE id =?"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mac,$fw,$ssid,$senha,$ipv4,$rssi,$status_suite,$data_hora_sistema,$id_suite ]);

            $return['mensagem'] = "sucesso";
        }




}
else
{
    $return['mensagem'] = "erro";
   
}




header('Content-type: application/json');
echo json_encode($return);
?>