<?php 
date_default_timezone_set("America/Bahia");
setlocale(LC_ALL, 'pt_BR');

$acesso_pc = true;
$debugar = true;
$nome_sistema = " MotelTech";
$nome_cliente = "Motel Medieval";

$desenvolvido_por =" GÓES CONNECT";
$desenvolvido_por_url ="http://goesconnect.com.br";

$url_node_red = "http://192.168.0.11:1880";


$token_sistema = "cassa"; //TOKEN VALIDACAO


$data_sistema =  date("Y-m-d"); // DATA
$hora_sistema =  date("H:i:s"); // HORA
$data_hora_sistema =  date("Y-m-d H:i:s"); 


//BD
$servidor_web = false;
$host_db = "localhost";
if($servidor_web){
    $host_name_db = "";
    $host_user_db = "";
    $host_pass_db = "";
}else{
    $host_name_db = "sistema";
    $host_user_db = "root";
    $host_pass_db = "goes22";
}




if($debugar){
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//GOOGLE ANALYTICS
//ANALISE DE ACESSOS
$google_analitics = "";
if($servidor_web){
    $google_analitics = "<!-- Google tag (gtag.js) -->
    <script async src=\"https://www.googletagmanager.com/gtag/js?id=G-8Q5P9ZCEKF\"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-8Q5P9ZCEKF');
    </script>";
}
