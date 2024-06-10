<?php




function get_iluminacao_nome($pdo,$id_suite){

	$sql = "SELECT *  FROM suites_iluminacao_nome where id_suite=?  ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
}


function get_iluminacao_status($pdo,$id_suite){

	$sql = "SELECT *  FROM suites_iluminacao where id_suite=?  ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
}


