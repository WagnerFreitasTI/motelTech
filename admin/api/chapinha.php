<!--Este script PHP permite atualizar o status e os
tempos de uma suite em um banco de dados a partir
de parâmetros fornecidos via GET(API), protegendo
os inputs contra injeção de SQL e retornando
uma resposta em JSON indicando sucesso ou erro.-->

<?php
// Definir cabeçalhos para permitir acesso CORS
define('ALLOW_ORIGIN', 'Access-Control-Allow-Origin:*');
define('ALLOW_HEADERS', 'Access-Control-Allow-Headers:*');
define('CONTENT_TYPE_JSON', 'Content-type: application/json');

header(ALLOW_ORIGIN);
header(ALLOW_HEADERS);

require_once "../../src/var_system.php";
require_once "../../src/functions.php";

$pdo = require_once "../../src/connection.php";

$return = ['mensagem' => 'erro'];

if (isset($_GET['token'])) {
    $token = protect($_GET['token']);
    $id_suite = protect($_GET['id']);
    $status = protect($_GET['status']);
    $tempo_restante = protect($_GET['tempo_restante']);
    $tempo_total = protect($_GET['tempo_total']);

    // Validação dos parâmetros
    if ($id_suite && $status && $tempo_restante && $tempo_total) {
        try {
            $sql = "UPDATE suites_chapinha SET status = ?, tempo_restante = ?, tempo_total = ?, visto = ? WHERE id_suite = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$status, $tempo_restante, $tempo_total, $data_hora_sistema, $id_suite]);
            $return['mensagem'] = 'sucesso';
        } catch (PDOException $e) {
            $return['mensagem'] = 'erro: ' . $e->getMessage();
        }
    } else {
        $return['mensagem'] = 'erro: parâmetros inválidos';
    }
} else {
    $return['mensagem'] = 'erro: token não fornecido';
}

header(CONTENT_TYPE_JSON);
echo json_encode($return);
?>