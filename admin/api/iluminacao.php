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
		$principal = protect($_GET['principal']);
        $lustre = protect($_GET['lustre']);
        $cortina = protect($_GET['cortina']);
        $criado = protect($_GET['criado']);
        $pia = protect($_GET['pia']);
        $box = protect($_GET['box']);

		if(true){
            $sql = "UPDATE suites_iluminacao  SET  principal=?, lustre=?, cortina=?, criado_mudo=?, wc_pia=?, wc_box=? ,visto=?   WHERE id_suite =?"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$principal,$lustre,$cortina,$criado,$pia,$box,$data_hora_sistema,$id_suite ]);
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