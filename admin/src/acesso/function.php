<?php



//LISTA TODOS
function busca_all_acesso($pdo)
{

	$sql = "SELECT users.id as id_user, 
	 suites.nome as suite,
	 users.device_name as device_name , 
	 users.navegador as navegador,
	 users.visto as visto


	 FROM users 
	LEFT JOIN suites ON suites.id = users.id_suite
	";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//DELETAR
function deletar_acesso($pdo, $id)
{
	$sql = "DELETE FROM users   WHERE id =?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);

	return true;
}
