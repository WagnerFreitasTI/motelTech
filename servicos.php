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
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header">

            <a href="#" class="logo"><strong><?=$nome_sistema?></strong> </a>
            <p class="nomesuite"> Medieval -   <?=$suite['numero']?>  <?=$suite['nome']?></p>
            <nav><a href="#menu"> </a></nav>

        </header>
        <!-- Menu -->
        <?php require_once("src/pages/menu.php"); ?>

        <!-- Main -->
        <div id="main" class="alt">

            <!-- One -->
            <section id="one">
               

                <div class="inner">
                <div class="col-12 col-12-center" style="margin-top:-40px">
                    <div>
                        <ul class="actions fit">
                            <li><a href="/home" class="button fit">Voltar para Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
                    <header class="major">
                        <h1>Serviços</h1>
                    </header>

                    <h3>Confira nossos serviços</h3>

                    <div class="row gtr-200">
                        <div class="col-12 col-12-center">
                            <!-- Botões -->
                            <div>
                                <ul class="actions fit" onClick="servicos_reservas()">
                                    <li>
                                        <a href="#" class="button fit">Reservas</a>
                                    </li>
                                </ul>
                                <ul class="actions fit" onClick="servicos_travesseiros()">
                                    <li><a href="#" class="button fit">Cardápio de travesseiros</a></li>
                                </ul>
                                <ul class="actions fit" onClick="servicos_higiene()">
                                    <li><a href="#" class="button fit">Processo de higienização</a></li>
                                </ul>
                                <ul class="actions fit" onClick="servicos_enxoval()">
                                    <li><a href="#" class="button fit">Processo de lavagem de enxoval</a></li>
                                </ul>
                                <ul class="actions fit" onClick="servicos_ozonio()">
                                    <li><a href="#" class="button fit">Utilização de ozônio</a> </li>
                                </ul>
                                <ul class="actions fit" onClick="servicos_chef()">
                                    <li><a href="#" class="button fit">Conheça nosso chef</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php require_once("src/pages/footer.php"); ?>

    </div>

    <script>
    const url_node_red = <?="'".$url_node_red."'"?> //NODERED
    const suite = <?="'".$suite['id']."'" ?> //SUITE
    const suite_token = <?="'".$suite['token']."'" ?> //TOKEN
    var time_out_status_rele; //ATUALIZA STATUS RELE
    var aviso_erro; //ERRO SET RELE
    var is_tablet = <?="'".$istablet."'" ?> //SUITE
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
    <script src="assets/js/servicos.js"></script>



</body>

</html>