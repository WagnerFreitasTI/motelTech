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

     

		if(true){
            $sql = "UPDATE suites_tv   SET  status=?   WHERE id_suite =?"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$status,$id_suite ]);
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