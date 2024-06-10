<?php


function is_tablet($pdo,$ipv4){

	$sql = "SELECT *  FROM tablets where ipv4=? and status='1' ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$ipv4]);
	if($stmt->rowCount() > 0){	
		return  true;
	}
    return false;
}


function get_tablet($pdo,$ipv4){

	$sql = "SELECT *  FROM tablets where ipv4=? and status='1' ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$ipv4]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
}



