<?php

// Definir cabeçalhos para permitir acesso CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');


require_once "../../src/var_system.php";
require_once "../../src/functions.php";
$pdo = require_once "../../src/connection.php";


$response = ['mensagem' => 'erro'];

// Verificar se o token está presente na requisição
if (isset($_GET['token'])) {
    $token = protect($_GET['token']);
    $id_suite = protect($_GET['id']);
    $cliente = protect($_GET['cliente']);
    $servico = protect($_GET['servico']);


    if (true) {
        // Atualizar dados no banco de dados, com bloco try-catch para 
        //capturar exceções PDO ao executar a consulta SQL e fornecer 
        //mensagens de erro detalhadas.
        try {
            $sql = "UPDATE suites_portas SET cliente=?, servico=?, visto=?, WHERE id_suite=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cliente, $servico, $id_suite]);
            $response['mensagem'] = 'sucesso';
        } catch (PDOException $e) {
            $response['mensagem'] = 'erro: ' . $e->getMessage();
        }
    } else {
        $response['mensagem'] = 'erro: parâmetros obrigatórios ausentes';
    }
} else {
    $response['mensagem'] = 'erro: token não fornecido';
}

// Retornar resposta como JSON
echo json_encode($response);
