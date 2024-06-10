<?php


function valida_user($pdo,$token){
    $sql = "SELECT id  FROM suites where token=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$token]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return isset($stmt['id']) ? $stmt['id']: 0;
}




