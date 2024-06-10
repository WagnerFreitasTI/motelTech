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
		$cliente = protect($_GET['cliente']);
        $servico = protect($_GET['servico']);
     

		if(true){
            $sql = "UPDATE suites_portas  SET  cliente=?, servico=?,visto=?   WHERE id_suite =?"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cliente,$servico,$data_hora_sistema,$id_suite ]);
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