<?php




function get_tv($pdo,$id_suite){

	$sql = "SELECT *  FROM suites_tv where id_suite=?  ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_suite]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
}



