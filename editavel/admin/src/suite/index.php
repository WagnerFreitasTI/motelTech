<?php

session_start();
require_once "../../../src/functions.php";
require_once "../../src/usuario/function.php";
require_once "function.php";
require_once "../function.php";
require_once "../var_system.php";
$pdo = require_once "../../../src/connection.php";
protegePagina($pdo); //SOMENTE USUARIO LOGADO


//USUARIO LOGADO
$usuario = getUsuario($pdo);

 //RETORNO
 $retorno_json = array();
 $retorno_json['status'] = "erro";
 $json_return = true;

//OPERACAO
$operacao = "";
$nome  = " ";
$suite = " ";


//SOMENTE GET
if (($_SERVER['REQUEST_METHOD'] == 'GET'))
{

    if (isset($_GET['op']) )
    {

        $operacao = protect($_GET['op']);

        //LISTA TODAS SUITES by Home
        if ($operacao == "todas_suites_home")
        {
                $retorno_json['mensagem'] = "sucesso";
                $retorno_json['suites'] = busca_all_suite_home($pdo);
                
        } //LISTA TODAS SUITES
        if ($operacao == "todas_suites")
        {
                $retorno_json['mensagem'] = "sucesso";
                $retorno_json['suites'] = busca_all_suite($pdo);
                
        }
         //LISTA SUITE
        else if ($operacao == "by_id")
         {
                 $id_suite = protect($_GET['id']);
                 $retorno_json['mensagem'] = "sucesso";
                 $retorno_json['suite'] = recebe_suite_by_id($pdo,$id_suite);
                 $retorno_json['hw'] = recebe_suite_hw($pdo,$id_suite);
                 $retorno_json['iluminacao'] = recebe_suite_iluminacao($pdo,$id_suite);
                 $retorno_json['portas'] = recebe_suite_portas($pdo,$id_suite);
                 $retorno_json['chapinha'] = recebe_suite_chapinha($pdo,$id_suite);
                 $retorno_json['tv'] = recebe_suite_tv($pdo,$id_suite);
                 
         }
 

    }

    

}
//METODO POST
else if (($_SERVER['REQUEST_METHOD'] == 'POST')){
   
    if (isset($_POST['op']) )
    {
        
       
        $operacao = $_POST['op'];

         //MUDAR STATUS 
         if ($operacao == "set_status"){

            if($usuario['nivel'] == "1"){
                $retorno_json['mensagem'] ="nivel";
            }
           else if(!get_status_pdv($pdo)){
                if ( isset($_POST['ipv4'] ) && isset( $_POST['status_suite'] ) && isset( $_POST['id_suite'] ) ){

                    $ipv4 = protect($_POST['ipv4'] ) ;
                    $status_suite = protect($_POST['status_suite'] ) ;
                    $id_suite = protect($_POST['id_suite'] ) ;
                    
                    
   
   
                    ///dash/suite/:suite/set/:status/:token
                    //NODERED
                    $url_request = $url_node_red;
                    $url_request .=  "/dash/suite/".$id_suite."/set";
                    $url_request .="/".$status_suite;
                    $url_request .="/".$token_node_red ;
       
                    reequest_api_post($url_request);
                    
   
   
                    //ESP32
                    $url_request = "http://".$ipv4.":8090/suite/dash/set/status?id=";
                    $url_request .= $status_suite;
                    error_log($url_request);
                    $retorno_json =  alterar_status_suite_hardware($url_request);
                    
               
                }
            }else  if(get_status_pdv($pdo)){
                $retorno_json['mensagem'] ="pdv";
            }  
  
            
              
    
         }
         else if ($operacao == "toogle_iluminacao") {

          
             if ( isset($_POST['ipv4'] ) && isset( $_POST['lampada'] )){

              

                 $ipv4 = protect($_POST['ipv4']) ;
                 $lampada = protect($_POST['lampada'] ) ;

                 $url_request = "http://".$ipv4.":8090/rele/toogle?id=";
                 $url_request .= $lampada;

                 $suite = recebe_suite_status_by_ip($pdo,$ipv4);
                 if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $retorno_json =  reequest_api_post($url_request);
                }else  if($usuario['nivel'] == "1" && $suite['status'] != 2){
                    $retorno_json['mensagem'] ="nivel";
                }else{
                    $retorno_json =  reequest_api_post($url_request);
                }

              
            
             }
              
    
         }
         else if ($operacao == "toogle_all_iluminacao")  {

          
             if ( isset($_POST['ipv4'] ) && isset( $_POST['status'] ) && isset( $_POST['id'] )){
               
                $id_suite = protect($_POST['id']);
                $ipv4 = protect($_POST['ipv4']) ;
                $status = protect($_POST['status'] ) ;
                $suite = recebe_suite_status_by_ip($pdo,$ipv4);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }

                if($libera){
                 //NODE RED ILUMINACAO SET RESET ALL
                 // /dash/suite/:suite/iluminacao/all/:status
                 $url_request_node_red = $url_node_red;
                 $url_request_node_red .=  "/dash/suite/".$id_suite."/iluminacao";
                 $url_request_node_red .="/all/".$status;
                 $url_request_node_red .="/".$token_node_red ;
                 reequest_api_post($url_request_node_red);


                 //ESP32
                 $url_request = "http://".$ipv4.":8090/rele/all/reset";
                 if($status >= 1){
                    $url_request =   "http://".$ipv4.":8090/rele/all/set";
                 }
            
        
                $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }

                
            
            
             }
              
    
         }
         else if ($operacao == "enviar_audio") {

            if ( isset($_POST['id'] ) && isset( $_POST['texto'] )){

                $id = protect($_POST['id']) ;
                $texto = protect($_POST['texto'] ) ;
                $url_request = $url_node_red;
                $url_request .=  "/dash/suite/".$id."/";
                $url_request .= str_replace('+', '%20', urlencode($texto)) ;
                $url_request .="/".$token_node_red ;
   
              $retorno_json =  reequest_api_post($url_request);
           
             
            }
             
        }
        else if ($operacao == "alterar_rgb") {

            if ( isset($_POST['id'] ) && isset( $_POST['cor'] )){

                $id = protect($_POST['id']) ;
                $cor = protect($_POST['cor'] ) ;
                $suite = recebe_suite_status_by_id($pdo,$id);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }

                if( $libera){
                    $url_request = $url_node_red;
                    $url_request .=  "/dash/suite/".$id."/rgb";
                    $url_request .="/".$cor;
                    $url_request .="/".$token_node_red ;
       
                    $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }
                
               
             
            }
             
        }
        else if ($operacao == "call_suite") {

            if ( isset($_POST['id'] ) ){

                $id = protect($_POST['id']) ;
    
               ///dash/recepcao/call/suite/:suite/:token
                $url_request = $url_node_red;
                $url_request .=  "/dash/recepcao/call/suite/".$id;
                $url_request .="/".$token_node_red ;
   
                $retorno_json =  reequest_api_post($url_request);
               
                
            }
             
        }
        else if ($operacao == "audio_video") {

            if ( isset($_POST['id'] )  && isset( $_POST['index'] ) ){

                $id = protect($_POST['id']) ;
                $index = protect($_POST['index']) ;
                $suite = recebe_suite_status_by_id($pdo,$id);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }
                

                if($libera){
                 // /dash/suite/:suite/audio/:index/:token
                 $url_request = $url_node_red;
                 $url_request .= "/dash/suite/".$id;
                 $url_request .= "/audio/".$index;
                 $url_request .="/".$token_node_red ;
                 $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }
              
               
                
            }
             
        }
        else if ($operacao == "cenario") {

            if ( isset($_POST['id'] )  && isset( $_POST['index'] ) ){

                $id = protect($_POST['id']) ;
                $index = protect($_POST['index']) ;
                $suite = recebe_suite_status_by_id($pdo,$id);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }

                if($libera){
                // /dash/suite/:suite/cenario/:index/:token
                $url_request = $url_node_red;
                $url_request .= "/dash/suite/".$id;
                $url_request .= "/cenario/".$index;
                $url_request .="/".$token_node_red ;
                $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }

    
               
               
                
            }
             
        } 
        else if ($operacao == "arcondicionado") {

            if ( isset($_POST['id'] )  && isset( $_POST['status'] ) ){

                $id = protect($_POST['id']) ;
                $status = protect($_POST['status']) ;
                $suite = recebe_suite_status_by_id($pdo,$id);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }


                if($libera){
                // /dash/suite/:suite/ar/set/:status/:token
                $url_request = $url_node_red;
                $url_request .= "/dash/suite/".$id;
                $url_request .= "/ar/set/".$status;
                $url_request .="/".$token_node_red ;
                $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }

    
               
               
                
            }
             
        }
        else if ($operacao == "arcondicionado_temp") {

            if ( isset($_POST['id'] )  && isset( $_POST['temp'] ) ){

                $id = protect($_POST['id']) ;
                $temp = protect($_POST['temp']) ;
                $suite = recebe_suite_status_by_id($pdo,$id);
                $libera = false;

               
                if($usuario['nivel'] == "1" && $suite['status'] == 2){
                    $libera = true;
                }else if($usuario['nivel'] != "1"){
                    $libera = true;
                }


                if($libera){
                // /dash/suite/:suite/ar/temp/:status/:token
                $url_request = $url_node_red;
                $url_request .= "/dash/suite/".$id;
                $url_request .= "/ar/temp/".$temp;
                $url_request .="/".$token_node_red ;
                $retorno_json =  reequest_api_post($url_request);
                }else{
                    $retorno_json['mensagem'] ="nivel";
                }

    
               
               
                
            }
             
        }
       
    }
    
}


header('Content-Type: application/json; charset=UTF-8');
echo json_encode($retorno_json); 