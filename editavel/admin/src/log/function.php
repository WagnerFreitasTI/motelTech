<?php 

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