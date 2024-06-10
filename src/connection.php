<?php 
require_once "var_system.php";
//Conexao com Banco de Dados
return new PDO(sprintf("mysql:host=%s;dbname=%s", $host_db, $host_name_db), $host_user_db, $host_pass_db);
