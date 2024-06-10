<?php


//LISTA TODOS OS USUARIO
function busca_all_usuario($pdo){
    
	$sql = "SELECT *  FROM usuario  where nivel > '0' ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}



//ADICIONAR 
function adicionar_usuario($pdo,$login,$senha,$nome,$nivel,$status){
    $sql = "INSERT INTO usuario (login,senha,nome,nivel,status) VALUES (?,?,?,?,?)"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$login,$senha,$nome,$nivel,$status]);
    
	if($stmt->rowCount() > 0){
	return  true;
	}
	return  false;
}


//ALTERA 
function alterar_usuario($pdo,$id,$login,$senha,$nome,$nivel,$status){
    $sql = "UPDATE usuario  SET login=?,senha=?,nome=?,nivel=?,status=?  WHERE id =?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$login,$senha,$nome,$nivel,$status,$id]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
}

//DELETAR 
function deletar_usuario($pdo,$id){
    $sql = "DELETE FROM usuario   WHERE id =?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
    if($stmt->rowCount() > 0){
		
		return  true;
	}
	return false;
}
