<?php



function recebe_device($pdo,$id){
    $sql = "SELECT *  FROM device where id=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt ;
}




