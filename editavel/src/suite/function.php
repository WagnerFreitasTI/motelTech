<?php


function set_suite($pdo,$token,$id_suite){

    //ALTERA O TOKEN DA SUITE EM TODA NOVA CONEXAO
	$sql = "UPDATE suites  SET  token=? WHERE token =? "; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute(["goesconnect",$token]);


	 //ALTERA O TOKEN DA SUITE EM TODA NOVA CONEXAO
	 $sql = "UPDATE suites  SET  token=? WHERE id =? "; 
	 $stmt = $pdo->prepare($sql);
	 $stmt->execute([$token,$id_suite]);

	$_SESSION['token_suite'] = $token;
}


function valida_qrcode($pdo,$qrcode){
	$sql = "SELECT *  FROM suites where qrcode=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$qrcode]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
}

function check_token($token_suite){
	if (isset($_SESSION['token_suite'])) {
		$token_usuario = $_SESSION['token_suite'];

		if($token_suite != $token_usuario ){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
	
}

function recebe_suite($pdo,$id_suite){
    $sql = "SELECT *  FROM suites where id=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;
}

function recebe_suite_id($pdo,$qrcode){
    $sql = "SELECT *  FROM suites where qrcode=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$qrcode]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt['id'];
}


function set_reload_page($pdo,$id_suite){
	$sql = "INSERT IGNORE INTO   reload_page (id_suite) VALUES (?)"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
    
}

function remove_reload_page($pdo,$id_suite){
	$sql = "DELETE FROM reload_page   WHERE id_suite=?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
    if($stmt->rowCount() > 0){
		return  true;
	}
	return false;
}

function get_reload_page($pdo,$id_suite){
	$sql = "SELECT *  FROM reload_page where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
	return false;
}
