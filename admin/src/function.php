<?php


function request_api($url){


// Inicializar a sessão curl
$curl = curl_init($url);

// Definir as opções de requisição
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Retorna o resultado como uma string
curl_setopt($curl, CURLOPT_POST, true); // Define o método da requisição como POST
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json', // Define o cabeçalho como JSON

]);

// Executar a requisição e obter a resposta
$response = curl_exec($curl);

// Verificar se houve algum erro
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    // Tratar o erro de acordo com a necessidade
}

// Fechar a sessão curl
curl_close($curl);

// Processar a resposta
return $response; // Converte a resposta JSON em um array associativo


}
?>
