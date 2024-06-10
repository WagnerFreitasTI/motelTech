<?php
session_start();
$pdo = require_once "src/connection.php";
require_once 'src/mobile/src/MobileDetect.php';
require_once "src/var_system.php";
require_once "src/functions.php";
require_once "src/user/function.php";
require_once "src/suite/function.php";
require_once "src/tablet/function.php";
require_once "src/comum.php";
?>


<!DOCTYPE HTML>

<html>

<head>
    <title><?=$nome_cliente." | ".$nome_sistema?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/comum.css" />
    <link rel="stylesheet" href="assets/css/cardapio.css" />

  
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header">
        <a href="#" class="logo"><strong><?=$nome_sistema?></strong> </a>
        <p class="nomesuite">   Medieval -   <?=$suite['numero']?>  <?=$suite['nome']?></p>
        <nav><a href="#menu"> </a></nav>
               
        </header>
        <!-- Menu -->
        <?php require_once("src/pages/menu.php"); ?>

        <!-- Main -->
        <div id="main" class="">
        <div class="col-12 col-12-center" style="margin-top:0px">
                        <div>
                            <ul class="actions fit">
                                <li><a href="/home" class="button fit">Voltar para Home</a>
                                </li>
                            </ul>
                        </div>
                    </div>

            <!-- One -->
            <section id="one" style="margin-top:-25px">



                <div class="box alt">
                    <div class="carousel">
                        <div class="carousel-inner">
                            <img src="assets/cardapio/1.jpg" alt="Imagem 1">
                            <img src="assets/cardapio/2.jpg" alt="Imagem 2">
                            <img src="assets/cardapio/3.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/4.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/5.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/6.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/7.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/8.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/9.jpg" alt="Imagem 3">
                            <img src="assets/cardapio/10.jpg" alt="Imagem 3">
                        </div>

                        <a style="background-color:white" class="carousel-control prev" href="#" role="button">
                            <span class="carousel-control-icon" style="color:black;font-size:30px">&lt;</span>
                        </a>

                        <a style="background-color:white" class="carousel-control next" href="#" role="button">
                            <span class="carousel-control-icon" style="color:black;font-size:30px">&gt;</span>
                        </a>
                    </div>



                </div>

                <!--
                <div class="col-12 col-12-center" style="margin-top:-25px">
                    <div>
                        <ul class="actions fit">
                            <li><a href="#" class="button fit" onClick="liga_recepcao()">Fazer pedido</a>
                            </li>
                        </ul>
                    </div>
                </div>
 Box 
                    <div class="box">

                           

                        <p>Utilize essa interface para abrir o player de sua preferência. Se houver necessiadde, utilize
                            o controle remoto para navegar nos menus. </br>Se precisar de ajuda, clique aqui que nossa
                            assistente virtual vai ligar para a recepção e vai te orientar. Bom preveito!
                        </p>

                    </div>
                   -->


        </div>
    </div>

    <?php require_once("src/pages/footer.php"); ?>
    </div>
    </section>

    </div>

    </div>

    <script>
    const url_node_red = <?="'".$url_node_red."'"?> //NODERED
    const suite = <?="'".$suite['id']."'" ?> //SUITE
    const suite_token = <?="'".$suite['token']."'" ?> //TOKEN
    var time_out_status_rele; //ATUALIZA STATUS RELE
    var aviso_erro; //ERRO SET RELE
    var is_tablet =  <?="'".$istablet."'" ?> //SUITE
    </script>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/js/comum.js"></script>
    <script src="assets/js/links.js"></script>
    <script src="assets/js/cardapio.js"></script>


</body>

</html>