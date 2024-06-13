<?php
// Definir cabeçalhos para permitir acesso CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

// Incluir arquivos necessários
require_once "../../src/var_system.php";
require_once "../../src/functions.php";
$pdo = require_once "../../src/connection.php";

// Inicializar resposta padrão
$return = ['mensagem' => 'erro'];

// Verificar se o token está presente
if (isset($_GET['token'])) {
    // Proteger e definir parâmetros
    $token = protect($_GET['token']);
    $id_suite = protect($_GET['id']);
    $status = protect($_GET['status']);

    if (true) {
        // Preparar e executar a consulta SQL
        $sql = "UPDATE suites_tv SET status=? WHERE id_suite=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$status, $id_suite]);
        $return['mensagem'] = 'sucesso';
    } else {
        // Se algum dos parâmetros estiver faltando ou vazio, define a mensagem de erro
        $return['mensagem'] = 'erro: parâmetros inválidos';
    }
} else {
    // Se o token não estiver presente, define a mensagem de erro
    $return['mensagem'] = 'erro: token não fornecido';
}

// Enviar resposta como JSON
echo json_encode($return);
