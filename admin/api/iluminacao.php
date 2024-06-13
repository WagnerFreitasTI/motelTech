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
    $token = protect($_GET['token']);
    $id_suite = protect($_GET['id']);
    $principal = protect($_GET['principal']);
    $lustre = protect($_GET['lustre']);
    $cortina = protect($_GET['cortina']);
    $criado = protect($_GET['criado']);
    $pia = protect($_GET['pia']);
    $box = protect($_GET['box']);

    // Validar parâmetros
    if (true) {
        try {
            $sql = "UPDATE suites_iluminacao SET principal=?, lustre=?, cortina=?, criado_mudo=?, wc_pia=?, wc_box=?, visto=? WHERE id_suite=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$principal, $lustre, $cortina, $criado, $pia, $box, $id_suite]);
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

// Enviar resposta como JSON
echo json_encode($return);
?>




header('Content-type: application/json');
echo json_encode($return);