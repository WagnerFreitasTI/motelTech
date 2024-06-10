<?php 



//LISTA TODOS AS SUITES
function busca_all_suite($pdo){
    
	$sql = "SELECT suites.id as id, suites.nome as nome, device.nome as hardware  FROM suites 
	LEFT JOIN device ON device.id = suites.id_device
	
	";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}


//ALTERA PRODUTO BY ID
function alterar_suite($pdo,$id,$nome, $hardware){

    $sql = "UPDATE suites  SET  nome=?, id_device=?  WHERE id =?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$nome,$hardware,$id]);

	
	return true;
}

//ADICIONAR
function  adicionar_suite($pdo,$nome, $hardware){

    $sql = "INSERT INTO suites (nome,id_device) VALUES (?,?)"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$nome,$hardware]);
	return true;
}

//DELETAR
function deletar_suite($pdo,$id){
		$sql = "DELETE FROM suites   WHERE id =?"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id]);
		
	return true;
}