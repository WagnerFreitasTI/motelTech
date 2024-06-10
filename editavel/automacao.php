<?php
session_start();
$pdo = require_once "src/connection.php";
require_once 'src/mobile/src/MobileDetect.php';
require_once "src/var_system.php";
require_once "src/functions.php";
require_once "src/user/function.php";
require_once "src/suite/function.php";
require_once "src/device/function.php";
require_once "src/tablet/function.php";
require_once "src/iluminacao/function.php";
require_once "src/comum.php";
$iluminacao_nome = get_iluminacao_nome($pdo,$id_suite);

?>



<!DOCTYPE HTML>

<html>

<head>
    <title>Automação - <?=$nome_cliente." | ".$nome_sistema?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/comum.css" />
    <link rel="stylesheet" href="assets/css/automacao.css" />
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header">
            <a href="#" class="logo"><strong><?=$nome_sistema?></strong> </a>
            <p class="nomesuite">  Medieval -   <?=$suite['numero']?>  <?=$suite['nome']?></p>
            <nav><a href="#menu"> </a></nav>

        </header>
        <!-- Menu -->
        <?php require_once("src/pages/menu.php"); ?>

        <!-- Main -->
        <div id="main" class="alt">

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


                   <!--  <div class="col-12 col-12-left ">
                        <div>
                            <ul class="actions fit" onClick="liga_recepcao()">
                                <li><a href="/home" class="button fit" style="height:50px!important">
                                        <span style="display: block;" class="aperteparafalar">APERTE PARA FALAR COM A
                                            RECEPÇÃO</span>
                                        <span style="display: block; " class="chamarrecepcao">CONVERSE COM A
                                            RECEPÇÃO PELO SISTEMA ALEXA</span>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                    Main -->


                    <header class="major">
                        <h1>Iluminação</h1>
                    </header>





                    <div class="row gtr-200">

                        <!-- RELE A -->
                        <div class="col-12 col-12-center">
                            <div>


                               <?php for($x=0; $x<$iluminacao_nome['qtd'];$x++){ 
                                $index_nome = "l".($x+1);
                                if($iluminacao_nome[$index_nome] != "null"){
                                ?>

                                <ul class="actions fit">
                                    <li>
                                        <a class=" button fit" id="r<?=($x+1)?>" onClick="set_status_rele('#r<?=($x+1)?>',<?=($x+1)?>)"><?=$iluminacao_nome[$index_nome]?></a>
                                    </li>
                                </ul>
                        
                                <?php }} ?>

                                <!-- 

                                <ul class="actions fit">
                                    <li><a class="button fit" id="r7" onClick="set_status_rele('#r7',6)">Extra 01</a></li>
                                </ul>

                                <ul class="actions fit">
                                    <li><a class="button fit" id="r8" onClick="set_status_rele('#r8',7)">Extra 02</a></li>
                                </ul>

-->
                                <ul class="actions fit">
                                    <li><a class=" button fit" onClick="set_all('2')">Liga tudo</a></li>
                                </ul>

                                <ul class="actions fit">
                                    <li><a class=" button fit" onClick="set_all('3')">Desliga tudo</a></li>
                                </ul>


                            </div>
                            <h3>RGB</h3>
                            <ul class="actions">
                                <li><input type="submit" value="" class="red btn-alexa" onClick=" set_rgb(1)" />
                                </li><!-- RGB VERMELHO -->
                                <!-- TRIGGER 21 -->
                                <li><input type="submit" value="" class="green btn-alexa" onClick=" set_rgb(2)" />
                                </li> <!-- RGB VERDE -->
                                <!-- TRIGGER 22 -->
                                <li><input type="submit" value="" class="blue btn-alexa" onClick=" set_rgb(3)" />
                                </li> <!-- RGB AZUL -->
                                <!-- TRIGGER 23 -->
                                <li><input type="submit" value="" class="orange btn-alexa" onClick=" set_rgb(4)" />
                                </li> <!-- RGB LARANJA -->
                                <!-- TRIGGER 24 -->
                                <li><input type="submit" value="" class="pink btn-alexa" onClick=" set_rgb(5)" />
                                </li> <!-- RGB ROSA -->
                                <!-- TRIGGER 25 -->
                                <li><input type="submit" value="" class="white btn-alexa" onClick=" set_rgb(6)" />
                                </li> <!-- RGB BRANCO -->
                                <!-- TRIGGER 26 -->
                                <li><input type="submit" value="" class="black btn-alexa" onClick=" set_rgb(7)" />
                                </li> <!-- RGB DESLIGADO -->
                                <!-- TRIGGER 27 -->
                            </ul>
                        </div>

                        <!-- 
                        
                        <div class="col-6 col-6-right">
                            <div>

                                <ul class="actions fit">
                                    <li><a class=" button fit" id="r1_b" onClick="set_status_rele_b('#r1_b',0)">Extra
                                            3</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r2_b" onClick="set_status_rele_b('#r2_b',1)">LExtra
                                            4</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r3_b" onClick="set_status_rele_b('#r3_b',2)">Tomada
                                            chapinha</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r4_b" onClick="set_status_rele_b('#r4_b',3)">Relé
                                            B4</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r5_b" onClick="set_status_rele_b('#r5_b',4)">Relé
                                            B5</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r6_b" onClick="set_status_rele_b('#r6_b',5)">Porta
                                            cliente</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" id="r7_b" onClick="set_status_rele_b('#r7_b',6)">Porta
                                            serviço</a></li>
                                </ul>


                                <ul class="actions fit">
                                    <li><a class="button fit" id="r8_b" onClick="set_status_rele_b('#r8_b',7)">Botão
                                            serviço</a></li>

                                </ul>


                            </div>
-->

                    </div>






                </div>
            </section>


            <section id="one">
                <div class="inner">
                    <header class="major">
                        <h1>Ar condicionado</h1>
                    </header>
                    <div class="row gtr-200">
                        <div class="col-12 col-12-center">

                            <div>
                                <ul class="actions fit">
                                    <li>
                                        <a class="button fit" onClick=" set_ar(1)">Frio 20°</a>
                                    </li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" onClick=" set_ar(2)">Ambiente
                                            22°</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" onClick=" set_ar(3)">Quente
                                            24°</a></li>
                                </ul>
                                <ul class="actions fit">
                                    <li><a class="button fit" onClick=" set_ar(4)">Desligar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </section>
            <div class="inner">
                <header class="major">
                    <h1>Cenários</h1>
                </header>
                <div class="row gtr-200">
                    <div class="col-12 col-12-center">
                        <!-- Botões -->
                        <div>
                            <h3></h3>
                            <ul class="actions fit">
                                <li><a class="button fit" onClick="set_cenario(5)">Jantar</a>
                                </li>
                                <li><a onClick="set_cenario(6)" class="button fit">Romântico</a>
                                </li>
                            </ul>
                            <ul class="actions fit">
                                <li><a class="button fit" onClick="set_cenario(7)">Spa</a>
                                </li>
                                <li><a class="button fit" onClick="set_cenario(8)">Dormir</a>
                                </li>
                            </ul>


                        </div>
                    </div>
                    </section>
                </div>

                <?php require_once("src/pages/footer.php"); ?>

            </div>

            <script>
            //SUITE
            const url_node_red = <?="'".$url_node_red."'"?> //NODERED
            const suite = <?="'".$suite['id']."'" ?> //SUITE
            const suite_token = <?="'".$suite['token']."'" ?> //TOKEN
            var time_out_status_rele; //ATUALIZA STATUS RELE
            var aviso_erro; //ERRO SET RELE
            var is_tablet = <?="'".$istablet."'" ?> //SUITE

            var qtd_lampada = <?=$iluminacao_nome['qtd']?>
           
            </script>



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
            <script src="assets/js/automacao.js"></script>





</body>

</html>