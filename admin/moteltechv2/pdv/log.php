<?php
// pdv.php

// Função para exibir o conteúdo de um arquivo
function exibirConteudoArquivo($nomeArquivo)
{
    if (file_exists($nomeArquivo)) {
        $conteudo = file_get_contents($nomeArquivo);
        echo nl2br(htmlspecialchars($conteudo));
    } else {
        echo "Arquivo não encontrado.";
    }
}

$nomeArquivo = "c:/nodered/pdvSetSuite.log";
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MotelTech - PDV Logs</title>

    <!-- CSS -->
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f8f8;
            border-bottom: 1px solid #ccc;
            padding: 10px;
        }

        .card-title {
            font-weight: bold;
            margin: 0;
        }

        .card-body {
            padding: 20px;
            max-height: 400px;
            overflow-y: auto;
        }

        .back-button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Main content -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Logs do PDV</h5>
            </div>
            <div class="card-body" id="logs-container">
                <?php exibirConteudoArquivo($nomeArquivo); ?>
            </div>
        </div>
        <button class="back-button" onclick="history.back()">Voltar</button>
    </div>
</body>

</html>
