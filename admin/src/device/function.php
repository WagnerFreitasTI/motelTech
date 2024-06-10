<?php 



//LISTA TODOS
function busca_all_device($pdo){
    
	$sql = "SELECT *  FROM device ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}




//DELETAR
function deletar_device($pdo,$id){
		$sql = "DELETE FROM device   WHERE id =?"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id]);
		
	return true;
}