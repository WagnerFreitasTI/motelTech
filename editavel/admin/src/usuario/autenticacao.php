<?php
session_start();
require_once "../../../src/functions.php";
$pdo = require_once "../../../src/connection.php";

require_once "function.php";


$login = "";
$senha = "null";
$mensagem = "erro";

if (($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['login']) and isset($_POST['senha']))
{
    $login = protect($_POST['login']);
    $senha = protect($_POST['senha']);

    if (empty($login))
    {
        $mensagem = "user";
    }
    elseif (empty($senha))
    {
        $mensagem = "pass";
    }
    else
    {
        if (validaUsuario($login, $senha, $pdo) == true)
        {
            $login = getUsuario($pdo);
            $mensagem = "success";
        }
        else
        {
            $mensagem = "error";
        }
    }
}

echo $mensagem;
?>
