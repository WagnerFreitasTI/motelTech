<?php

namespace App;

class User
{
    protected static $pdo;

    public static function init($pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getLoggedUser()
    {
        // Lógica para obter usuário logado
        // Supondo que o ID do usuário está armazenado na sessão
        $userId = $_SESSION['user_id'];
        $stmt = self::$pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch();
    }
}
