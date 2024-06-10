<?php
session_start();
$pdo = require_once "src/connection.php";
require_once 'src/mobile/src/MobileDetect.php';
require_once "src/var_system.php";
require_once "src/functions.php";
require_once "src/user/function.php";
require_once "src/suite/function.php";
require_once "src/tablet/function.php";
require_once "src/tv/function.php";
require_once "src/comum.php";

$tv = get_tv($pdo,$id_suite);

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
            <p class="nomesuite">  Medieval -   <?=$suite['numero']?>  <?=$suite['nome']?></p>
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
                   

                    <h3 style="text-align: center;">- Comande a TV -</h3>

                        <!--   - <h1>TV <span id="status_tv"><?=$tv['status']==="0" ? "Desligada":"Ligada"?></span> </h1>  -->
              

                    <div class="col-12 col-12-center" >
                        <div>
                            <ul class="actions fit">
                                </li>
                                <li>
                                    <a href="#" class="button fit"  onClick="set_tv_vol('2')">Volume -</a>
                                </li>
                                <li>
                                    <a href="#" class="button fit" onClick="set_tv('1')">Liga / Desliga </a>
                                </li>
                                <li>
                                    <a href="#" class="button fit"  onClick="set_tv_vol('1')">Volume +</a>
                                </li>
                            </ul>

                           <!-- <ul class="actions fit">
                                <li><a href="#" class="button fit" onClick="set_tv('2')">Desligar</a>
                                
                            </ul>
                            -->            
                        </div>
                    </div>

                    <header class="major">
                       
                    </header>

                    <!--<h3>Veja na TV</h3>-->
                    <div class="box alt">
                        <div class="row gtr-50 gtr-uniform">

                           

                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(2)">
                                    <img class="btn-alexa-trigger" src="images/youtube.jpg" alt="Vídeo - Youtube"
                                        style="cursor: pointer;" />
                                </span>
                            </div>

                            <div class="col-4"><span class="image fit" onClick="set_audio(3)">
                                    <img class="btn-alexa-trigger" src="images/netflix.jpg" alt="Vídeo - Netflix"
                                        style="cursor: pointer;" /></span>
                            </div>

                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(1)">
                                    <img class="btn-alexa-trigger" src="images/video_noticias.png" alt="Vídeo - Notícias"
                                        style="cursor: pointer;" />
                                </span>
                            </div>
                            <!-- Break -->
                            
                            <div class="col-4"><span class="image fit" onClick="set_audio(5)">
                                    <img src="images/youtube_romanticas.jpg" alt="Vídeo - Românticas"
                                        style="cursor: pointer;" /></span>
                            </div>
                            <div class="col-4"><span class="image fit" onClick="set_audio(6)">
                                    <img src="images/youtube_rock.jpg"alt="Vídeo - Rock"
                                        style="cursor: pointer;" /></span>
                            </div>
                            <!-- Break -->
                            <div class="col-4"><span class="image fit" onClick="set_audio(7)">
                                    <img src="images/youtube_samba.jpg" alt="Vídeo - Samba"
                                        style="cursor: pointer;" /></span>
                            </div>
                            <div class="col-4"><span class="image fit" onClick="set_audio(8)">
                                    <img src="images/youtube_sertanejo.jpg" alt="Vídeo - Sertanejo"
                                        style="cursor: pointer;" /></span>
                            </div>
                            <div class="col-4"><span class="image fit" onClick="set_audio(9)">
                                    <img src="images/youtube_mpb.jpg" alt="Vídeo - MPB"
                                        style="cursor: pointer;" /></span>
                            </div>
                            <div class="col-4"><span class="image fit" onClick="set_audio(4)">
                                    <img src="images/youtube_funk.jpeg" alt="Vídeo - Funk"
                                        style="cursor: pointer;" /></span>
                            </div>
                        </div>
                    </div>
                    <h3 style="text-align: center;">- Comande o som -</h3>

 <div>
                            <ul class="actions fit">
                                </li>
                                <li>
                                    <a href="#" class="button fit"  onClick="set_tv_vol('2')">Volume -</a>
                                </li>
                               
                                <li>
                                    <a href="#" class="button fit"  onClick="set_tv_vol('1')">Volume +</a>
                                </li>
                            </ul>

                           <!-- <ul class="actions fit">
                                <li><a href="#" class="button fit" onClick="set_tv('2')">Desligar</a>
                                
                            </ul>
                            -->            
                        </div>


                    <div class="box alt">
                        <div class="row gtr-50 gtr-uniform">
                            
                            <div class="col-4"><span class="image fit" onClick="set_audio(11)">
                                    <img src="images/musica_romanticas.png" alt="Música - Românticas"
                                        style="cursor: pointer;" />
                                </span>
                            </div>
                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(12)">
                                    <img src="images/musica_rock.png" alt="Música - Rock"
                                        style="cursor: pointer;" />
                                </span>
                            </div>
                            <!-- Break -->
                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(13)">
                                    <img src="images/musica_samba.png" alt="Música - Samba"
                                        style="cursor: pointer;" />
                                </span>
                            </div>

                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(14)">
                                    <img src="images/musica_sertanejo.png" alt="Música - Sertanejo"
                                        style="cursor: pointer;" />
                                </span>
                            </div>
                            <div class="col-4">
                                <span class="image fit" onClick="set_audio(15)">
                                    <img src="images/musica_mpb.png" alt="Música - MPB"
                                        style="cursor: pointer;" />
                                </span>
                            </div>
                            <div class="col-4"><span class="image fit" onClick="set_audio(10)">
                                    <img src="images/musica_funk.png" alt="Música"
                                        style="cursor: pointer;" /></span>
                            </div>

                        </div>
                    </div>

                    <!-- Box -->
                    <div class="box">
                        <p>Utilize essa interface para abrir o player de sua preferência. Se houver necessiadde, utilize
                            o controle remoto para navegar nos menus. </br>Se precisar de ajuda, clique aqui que nossa
                            assistente virtual vai ligar para a recepção e vai te orientar. Bom preveito!</p>
                    </div>



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
    var is_tablet = <?="'".$istablet."'" ?> //SUITE
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
    <script src="assets/js/audioevideo.js"></script>



</body>

</html>