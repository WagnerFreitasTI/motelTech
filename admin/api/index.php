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
$response = ['mensagem' => 'erro'];

// Função para proteger e retornar parâmetro GET ou null se não estiver definido
function getProtectedParam($paramName)
{
    return isset($_GET[$paramName]) ? protect($_GET[$paramName]) : null;
}

// Verificar se o token está presente
if (isset($_GET['token'])) {
    $token = getProtectedParam('token');
    $id_suite = getProtectedParam('id');
    $ssid = getProtectedParam('ssid');
    $senha = getProtectedParam('senha');
    $ipv4 = getProtectedParam('ipv4');
    $rssi = getProtectedParam('rssi');
    $status_suite = getProtectedParam('status_suite');
    $fw = getProtectedParam('fw');
    $mac = getProtectedParam('mac');

    // Validar parâmetro id_suite
    if (true) {
        try {
            $sql = "UPDATE device SET mac = ?, fw = ?, ssid = ?, senha = ?, ipv4 = ?, rssi = ?, status_suite = ?, visto = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mac, $fw, $ssid, $senha, $ipv4, $rssi, $status_suite, $id_suite]);
            $response['mensagem'] = 'sucesso';
        } catch (PDOException $e) {
            $response['mensagem'] = 'erro: ' . $e->getMessage();
        }
    } else {
        $response['mensagem'] = 'erro: parâmetro id_suite inválido';
    }
} else {
    $response['mensagem'] = 'erro: token não fornecido';
}

// Enviar resposta como JSON
echo json_encode($response);
