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
		$status = protect($_GET['status']);
        $tempo_restante = protect($_GET['tempo_restante']);
        $tempo_total = protect($_GET['tempo_total']);
        

		if(true){
            $sql = "UPDATE suites_chapinha  SET  status=?, tempo_restante=?, tempo_total=?, visto=?   WHERE id_suite =?"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$status,$tempo_restante,$tempo_total,$data_hora_sistema,$id_suite]);
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