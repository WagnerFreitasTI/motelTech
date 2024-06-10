<?php 

//GET STATUS PDV
function get_status_pdv($pdo){

	$sql = "SELECT * FROM sistema"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
    if($stmt->rowCount() > 0){
		$stmt =	$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt['status_pdv'] == "1"){
			return true;
		}
	}
	return false;
    
}

//LISTA TODOS AS SUITES by HOME
function busca_all_suite_home($pdo){
    
	$sql = "SELECT  device.status_suite as status_suite, device.visto as visto,
				    suites.numero as numero, suites.nome  as nome , suites.id  as id,
					suites_iluminacao.principal as l1,	suites_iluminacao.lustre as l2,
					suites_iluminacao.cortina as l3,	suites_iluminacao.criado_mudo as l4,
					suites_iluminacao.wc_pia as l5,	suites_iluminacao.wc_box as l6,
					suites_portas.cliente as porta_cliente, suites_portas.servico as porta_servico,
					suites_chapinha.status as chapinha,
					suites_tv.status as tv
					
	FROM suites 
	INNER JOIN device ON device.id_suite = suites.id_device
	INNER JOIN suites_iluminacao ON suites_iluminacao.id_suite = suites.id_device
	INNER JOIN suites_portas ON suites_portas.id_suite = suites.id_device
	INNER JOIN suites_chapinha ON suites_chapinha.id_suite = suites.id_device
	INNER JOIN suites_tv ON suites_tv.id_suite = suites.id_device
	order by suites.id desc
	";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

//LISTA TODOS AS SUITES
function busca_all_suite($pdo){
    
	$sql = "SELECT  *
	
	 FROM suites 
	INNER JOIN device ON device.id_suite = suites.id_device
  
	order by suites.id desc
	";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}

//ALTERA PRODUTO BY ID
function alterar_suite($pdo,$id,$nome, $hardware){

    $sql = "UPDATE suites  SET  nome=?, id_device=?  WHERE id =?"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$nome,$hardware,$id]);

	
	return true;
}

//ADICIONAR
function  adicionar_suite($pdo,$nome, $hardware){

    $sql = "INSERT INTO suites (nome,id_device) VALUES (?,?)"; 
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$nome,$hardware]);
	return true;
}

//DELETAR
function deletar_suite($pdo,$id){
		$sql = "DELETE FROM suites   WHERE id =?"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$id]);
		
	return true;
}

//REQUEST API 
function alterar_status_suite_hardware($url) {

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);


    $response = curl_exec($curl);
	error_log($response);

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);

    }


    curl_close($curl);

    // Processar a resposta
    return json_decode($response, true); // Converte a resposta JSON em um array associativo

}

//REQUEST API REST POST 
function reequest_api_post($url) {

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);


    $response = curl_exec($curl);


    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);

    }


    curl_close($curl);

    // Processar a resposta
    return json_decode($response, true); // Converte a resposta JSON em um array associativo

}

function recebe_suite_by_id($pdo,$id){
	$sql = "SELECT *  FROM suites where id=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_view($pdo,$id){
		if(getQueryParam($id)){
			$id_suite = protect($_GET[$id]);
		   //OBJETO MAQUINA
			$suite = recebe_suite_by_id($pdo, $id_suite);
			if (!$suite)
			{
				header("Location: ..\home");
				exit(0);
			}
			
		}else{
			header("Location: ..\home");
			exit(0);
		}
	
		return  $suite;

}

function recebe_suite_iluminacao($pdo,$id){
	$sql = "SELECT *  FROM suites_iluminacao where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_portas($pdo,$id){
	$sql = "SELECT *  FROM  suites_portas  where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_chapinha($pdo,$id){
	$sql = "SELECT *  FROM  suites_chapinha  where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_hw($pdo,$id){
	$sql = "SELECT *  FROM  device  where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_tv($pdo,$id){
	$sql = "SELECT *  FROM  suites_tv  where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}


function recebe_suite_status_by_ip($pdo,$ipv4){
	$sql = "SELECT status_suite as status  FROM  device  where ipv4=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$ipv4]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}

function recebe_suite_status_by_id($pdo,$id){
	$sql = "SELECT status_suite as status  FROM  device  where id_suite=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$stmt =  $stmt->fetch(PDO::FETCH_ASSOC);
    return (gettype($stmt) == 'array') ? $stmt:null;

}