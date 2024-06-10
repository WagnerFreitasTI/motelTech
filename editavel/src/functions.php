<?php


function tempo_corrido($time)
{

    $now = strtotime(date("Y-m-d H:i:s"));
    $time = strtotime($time);
    $diff = $now - $time;

    $seconds = $diff;
    $minutes = round($diff / 60);
    $hours = round($diff / 3600);
    $days = round($diff / 86400);
    $weeks = round($diff / 604800);
    $months = round($diff / 2419200);
    $years = round($diff / 29030400);

    if ($seconds <= 60) return "há 1 min ";
    else if ($minutes <= 60) return $minutes == 1 ? 'há 1 min ' : 'há ' . $minutes . ' min';
    else if ($hours <= 24) return $hours == 1 ? 'há 1 hrs ' : 'há ' . $hours . ' hrs ';
    else if ($days <= 7) return $days == 1 ? 'há 1 dia atras' : 'há ' . $days . ' dias';
    else if ($weeks <= 4) return $weeks == 1 ? 'há 1 semana ' : 'há ' . $weeks . ' semanas ';
    else if ($months <= 12) return $months == 1 ? 'há 1 mês ' : 'há ' . $months . ' meses';

    else return $years == 1 ? 'um ano ' : $years . ' anos ';

}

function maquina_status($time){
    $online = false;

    $now = strtotime(date("Y-m-d H:i:s"));
    $time = strtotime($time);
    $diff = $now - $time;

    $seconds = $diff;
    $minutes = round($diff / 60);
    $hours = round($diff / 3600);
    $days = round($diff / 86400);
    $weeks = round($diff / 604800);
    $months = round($diff / 2419200);
    $years = round($diff / 29030400);

    if ($seconds <= 60)
    {
        return true;
    }
    else if ($minutes <= 60)
    {
        return $minutes == 1 ? true : false;
    }
    else if ($hours <= 24)
    {
        return false;
    }
    else if ($days <= 7)
    {
        return false;
    }
    else if ($weeks <= 4)
    {
        return false;
    }
    else if ($months <= 12)
    {
        return false;
    }

    else
    {
        return false;
    }

}

function protect(&$str)
{    

    if(!is_null($str)){

        if (!is_array($str) )
    {
        $str = preg_replace('/(from|select|insert|delete|where|drop|union|order|update|database)/i', '', $str);
        $str = preg_replace('/(&lt;|<)?script(\/?(&gt;|>(.*))?)/i', '', $str);
        $tbl = get_html_translation_table(HTML_ENTITIES);
        $tbl = array_flip($tbl);
        $str = addslashes($str);
        $str = strip_tags($str);
        return strtr($str, $tbl);
    }else
    {
        return array_filter($str, "protect");
    }

    }else{
        return "null";
    }
    


}

function getQueryParam($paramName) {
    if (isset($_GET[$paramName]) && $_GET[$paramName] !== null) {
        return true;
    }
    return false;
}

function postQueryParam($paramName) {
    if (isset($_POST[$paramName]) && $_POST[$paramName] !== null) {
        return true;
    }
    return false;
}


function recebe_nome_user(){
    
    $nome_usuario = !isset($_SESSION['nome_usuario']) ?  uniqid():$_SESSION['nome_usuario'];
    $_SESSION['nome_usuario'] = $nome_usuario;
  
    return $nome_usuario;
}



function get_ip_cliente(){
    $ip = $_SERVER['REMOTE_ADDR'];

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
   return $ip;
}


function getNavegador()
{

    $navegador = filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT);

    $browsers = array(
        'amaya' => 'Amaya',
        'Camino' => 'Camino',
        'Chimera' => 'Chimera',
        'Chrome' => 'Chrome',
        'Edge' => 'Edge',
        'Firebird' => 'Firebird',
        'Firefox' => 'Firefox',
        'Flock' => 'Flock',
        'hotjava' => 'HotJava',
        'IBrowse' => 'IBrowse',
        'icab' => 'iCab',
        'Internet Explorer' => 'Internet Explorer',
        'Konqueror' => 'Konqueror',
        'Links' => 'Links',
        'Lynx' => 'Lynx',
        'Maxthon' => 'Maxthon',
        'Mozilla' => 'Mozilla',
        'MSIE' => 'Internet Explorer',
        'Netscape' => 'Netscape',
        'OmniWeb' => 'OmniWeb',
        'Opera' => 'Opera',
        'Opera.*?Version' => 'Opera',
        'Phoenix' => 'Phoenix',
        'Safari' => 'Safari',
        'Shiira' => 'Shiira',
        'Trident.* rv' => 'Internet Explorer',
        'Ubuntu' => 'Ubuntu Web Browser',
        'OPR' => 'Opera'
    );

    if (strpos($navegador, 'Edge')):
        $browserDetect = 'Edge';
    elseif (strpos($navegador, 'OPR')):
        $browserDetect = 'Opera';
    else:
        $browserDetect = null;
        foreach ($browsers as $key => $value):
            if (preg_match('|' . $key . '.*?([0-9\.]+)|i', $navegador)):
                $browserDetect = $value;
            endif;
        endforeach;
    endif;

    if (!empty($browserDetect)):
        return $browserDetect;
    else:
        return 'Desconhecido';
    endif;
}


function qualidade_rssi($rssi)
{
    $rssi = abs($rssi);
    $html = "<span class=\"text-danger\">Sem sinal</span>";

    if ($rssi >= 50 || $rssi <= 59)
    {
        $html = "<span class=\"text-success\">Excelente</span>";
    }
    else if ($rssi >= 60 || $rssi <= 69)
    {
        $html = "<span class=\"text-info\">Ótimo</span>";
    }
    else if ($rssi >= 70 || $rssi <= 79)
    {
        $html = "<span class=\"text-warning\">Bom</span>";
    }
    else if ($rssi >= 80 || $rssi <= 89)
    {
        $html = "<span class=\"text-danger\">Baixo</span>";
    }
    else if ($rssi >= 80 || $rssi <= 89)
    {
        $html = "<span class=\"text-danger\">Muito Baixo</span>";
    }

    return $html;
}


function protege_acesso($acesso_pc){
    if(!$acesso_pc){
        $detect = new \Detection\MobileDetect;
        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        
        if($deviceType == "computer"){
            echo "<span style='color:red;'> Acesso não autorizado via PC! </span>";
            exit(0);
        }
    }
    
}