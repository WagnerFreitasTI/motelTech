<?php

//LISTA TODOS OS USUARIO
function busca_all_usuario($pdo,$usuario){
    if($usuario['nivel'] == "3"){
		$sql = "SELECT *  FROM usuario   ";
	}else{
		$sql = "SELECT *  FROM usuario  where nivel > '0' and  nivel < '3' ";
	}
	
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

//LISTA TODOS OS USUARIO
function busca_logs($pdo){
  
	$sql = "SELECT usuario_log.id as id, usuario_log.datatime as datatime, usuario.nome as nome  FROM usuario_log 
	INNER JOIN usuario ON usuario.id = usuario_log.id_usuario   
	order by usuario_log.datatime DESC
	";
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
function busca_usuario_login($pdo,$login){
	
	
  
	$sql = "SELECT *  FROM usuario WHERE login = ?   LIMIT 1 ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$login]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
   
}

function busca_usuario_login_id($pdo,$login,$id){
	
	
  
	$sql = "SELECT *  FROM usuario WHERE login = ? and id <>?  LIMIT 1 ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$login,$id]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
   
}


//ALTERA 
function alterar_usuario($pdo,$id,$login,$senha,$nome,$nivel,$status){
	

	if(strlen($senha) > 0){
		$sql = "UPDATE usuario  SET login=?,senha=?,nome=?,nivel=?,status=?  WHERE id =?"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$login,$senha,$nome,$nivel,$status,$id]);
	}else{
		$sql = "UPDATE usuario  SET login=?,nome=?,nivel=?,status=?  WHERE id =?"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$login,$nome,$nivel,$status,$id]);
	}
  

	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
}
//DELETAR 
function deletar_usuario($pdo,$id){
    $sql = "DELETE FROM usuario   WHERE id=?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
    if($stmt->rowCount() > 0){
		return  true;
	}
	return false;
}
//ALTERA  SENHA
function alterar_senha($pdo,$id,$antiga,$nova){
    $sql = "UPDATE usuario  SET senha=?  WHERE id =? and senha=?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$nova,$id,$antiga]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
}