<?php

protege_acesso($acesso_pc);

$ipv4  = get_ip_cliente();
$istablet = is_tablet($pdo, $ipv4);



//VALIDA SE E TABLET
if (!$istablet) {
	//VALIDA ACESSO
	$nome_usuario = recebe_nome_user();
	$id_suite = valida_user($pdo, $nome_usuario);

	if ($id_suite == 0) {
		echo "<span style='color:red;'> Acesso não autorizado - home</span>";
		exit(0);
	}
} else {

	$tablet  = get_tablet($pdo, $ipv4);
	$id_suite = $tablet['id_suite'];
}


//OBJETO SUITE
$suite = recebe_suite($pdo, $id_suite);



//VALIDA TOKEN SUITE
if (!$istablet) {
	if (!$suite || !check_token($suite['token'])) {
		echo "<span style='color:red;'> Suite não encontrada </span>";
		exit(0);
	}
} else {
	remove_reload_page($pdo, $id_suite);
}
