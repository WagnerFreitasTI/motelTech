<?php

namespace App;

class Auth
{
    protected static $pdo;

    public static function init($pdo)
    {
        self::$pdo = $pdo;
    }

    public static function checkLogin()
    {
        session_start();
        if (!isset($_SESSION['logged_in'])) {
            header('Location: index.php');
            exit;
        }
    }
}
