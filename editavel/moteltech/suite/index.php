<?php
session_start();
require_once "../../../src/var_system.php";
require_once "../../../src/functions.php";
require_once "../../src/usuario/function.php";
require_once "../../src/suite/function.php";
require_once "../../src/iluminacao/function.php";
$pdo = require_once "../../../src/connection.php";


protegePagina($pdo); //SOMENTE USUARIO LOGADO
//APOS VALIDAR

//USUARIO LOGADO
$usuario = getUsuario($pdo);


$suite = recebe_suite_view($pdo, "id");
$hardware = recebe_suite_hw($pdo, $suite['id']);
$iluminacao_nome = get_iluminacao_nome($pdo, $suite['id']);

?>


<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <title>MotelTech - Suíte <?= $suite['numero'] ?> | <?= $suite['nome'] ?></title>

    <!-- SCRIPTS -->
    <?php require_once("../layout/scripts_header.php"); ?>

    <style>
        #luz_principal:checked {
            background-color: #9700bd;
        }

        #luz_lustre:checked {
            background-color: #9700bd;
        }

        #luz_cortina:checked {
            background-color: #9700bd;
        }

        #luz_criado_mudo:checked {
            background-color: #9700bd;
        }

        #luz_wc_pia:checked {
            background-color: #9700bd;
        }

        #luz_wc_box:checked {
            background-color: #9700bd;
        }

        .square {
            height: 40px;
            width: 40px;
        }

        .square-vermelho {
            background-color: red;
        }

        .square-verde {
            background-color: green;
        }

        .square-azul {
            background-color: blue;
        }

        .square-laranja {
            background-color: orange;
        }

        .square-roxa {
            background-color: purple;
        }

        .square-branco {
            background-color: white;
            border: 1px solid black;
        }

        .square-preto {
            background-color: black;
        }
    </style>

    </style>

</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom
    border-bottom-white border-opacity-10">
        <div class="container-fluid">
            <div class="d-flex d-lg-none me-2">
                <button type="button" class="navbar-toggler sidebar-mobile-main-toggle
                rounded-pill">
                    <i class="ph-list"></i>
                </button>
            </div>
            <div class="navbar-brand flex-1 flex-lg-0">
                <a href="../home" class="d-inline-flex align-items-center">
                    <img src="../../assets/images/logo.png" class="d-none d-sm-inline-block h-26px
                    ms-3" alt="">
                </a>
            </div>
            <ul class="nav flex-row">
                <li class="nav-item d-lg-none">
                    <a href="#navbar_search" class="navbar-nav-link navbar-nav-link-icon
                    rounded-pill" data-bs-toggle="collapse">
                        <i class="ph-magnifying-glass"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav flex-row justify-content-end order-1 order-lg-2">

                <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                    <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                        <div class="status-indicator-container">
                            <img src="../../assets/images/demo/users/face1.jpg" class="w-32px h-32px
                            rounded-pill" alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        <span class="d-none d-lg-inline-block mx-lg-2"><?= $usuario['nome'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item" onClick="alterar_senha()">
                            <i class="ph-lock text-muted me-2"></i>
                            Alterar Senha
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../../sair" class="dropdown-item">
                            <i class="ph-sign-out me-2"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-sm" style="width:200px">
            <!-- Sidebar content -->
            <div class="sidebar-content">
                <!-- Sidebar header -->
                <div class="sidebar-section">
                    <div class="sidebar-section-body d-flex justify-content-center">
                        <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Menu</h5>
                        <div>

                            <button type="button" class="btn btn-flat-white btn-icon btn-sm
                            rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                <i class="ph-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /sidebar header -->
                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <!-- Main -->
                        <li class="nav-item">
                            <a href="../home" class="nav-link ">
                                <i class="ph-gauge"></i>
                                <span>
                                    Painel
                                </span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a class="nav-link active">
                                <i class="ph-bed"></i>
                                <span>Suítes</span>
                            </a>
                            <ul class="nav-group-sub collapse">
                                <li class="nav-item">
                                    <a href="../suite/?id=1" class="nav-link">05 - Black</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=2" class="nav-link">06 - Gardem</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=3" class="nav-link">08 - Moscatel</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=4" class="nav-link">09 - Living</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=5" class="nav-link">11 - Elegance</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=6" class="nav-link">14 - Stone</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=7" class="nav-link">16 - La Vitta</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=8" class="nav-link">17 - Sunset</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=9" class="nav-link">18 - Medieval</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=10" class="nav-link">19 - Bella</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=11" class="nav-link">20 - Summer</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=12" class="nav-link">21 - Acqua</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=13" class="nav-link">22 - Clean</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=14" class="nav-link">23 - Natura</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=15" class="nav-link">24 - Lumina
                                        Loft</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=16" class="nav-link">25 - Blanc</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=17" class="nav-link">26 - Lounge</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=18" class="nav-link">28 - Malbec</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=19" class="nav-link">29 - Safira</a>
                                </li>

                                <li class="nav-item">
                                    <a href="../suite/?id=20" class="nav-link">30 - Prime</a>
                                </li>

                                <li class="nav-item">
                                    <a href="../suite/?id=21" class="nav-link">31 - Diamond</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=22" class="nav-link">32 - Madero</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=23" class="nav-link">34 - Cristal</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=24" class="nav-link">36 - Femini</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../suite/?id=25" class="nav-link">38 - Hi tech</a>
                                </li>
                            </ul>
                        </li>
                        <?php if (!($usuario['nivel'] === "1")) { ?>


                            <li class="nav-item nav-item-submenu">
                                <a class="nav-link ">
                                    <i class="ph-user"></i>
                                    <span>Usuári000o</span>
                                </a>
                                <ul class="nav-group-sub collapse">
                                    <li class="nav-item">
                                        <a href="../usuario" class="nav-link">Usuários</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../usuario/log" class="nav-link">Logs </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a class="nav-link ">
                                    <i class="ph-warning-circle"></i>
                                    <span>Ocorrencias</span>
                                </a>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a class="nav-link ">
                                    <i class="ph-fork-knife"></i>
                                    <span>Cardápio</span>
                                </a>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a class="nav-link ">
                                    <i class="ph-chart-bar-horizontal"></i>
                                    <span>Histórico</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Inner content -->
                    <div class="content-inner">



                        <!-- Content area -->
                        <div class="content" style="margin-top:-15px" id="row_contente">

                            <input type="hidden" id="id_suite" name="id_suite" value="<?= $suite['id'] ?>">
                            <input type="hidden" id="ip_suite" name="ip_suite" value="<?= $hardware['ipv4'] ?>">

                            <!-- ERRO COMUNICACAO -->
                            <div class="container " id="erro_conn" id="erro_conn" style="display:none">

                                <div class="alert alert-danger fs-5 text-center">
                                    <strong>ERRO!</strong>
                                    <span> A suíte encontra-se indisponível no momento </span>
                                </div>


                            </div>

                            <!-- ROW SUITE-->
                            <div class="row" id="row_suite" name="row_suite" style="display:none">

                                <!-- STATUS SUITE |  ENVIAR MENSAGEM DE VOZ | EFETUAR LIGACAO PARA A SUITE -->
                                <div class="col-lg-6 col-xl-3">
                                    <!-- STATUS SUITE -->
                                    <div id="bg_<?= $suite['id'] ?>" class="card card-body bg-danger text-white" style="height:90px;background-image: url(assets/images/backgrounds/panel_bg.png);">
                                        <div class="d-flex">
                                            <div class="flex-fill text-center" style="margin-top:-10px">
                                                <span onClick="suite_load_qrcode('<?= $suite['qrcode'] ?>')"> <i class="ph-qr-code ph-2x"></i></span>
                                                <h1 style="margin-top:-10px">
                                                    <?= $suite['numero'] ?>
                                                    <span class="d-none d-lg-inline-block mx-lg-1 " style="font-size:18px"><?= $suite['nome'] ?>
                                                    </span>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ENVIAR MENSAGEM DE VOZ -->
                                    <div class="card" style="margin-top: -10px; height: 281px">
                                        <div class="card-header d-flex justify-content-center">
                                            <h5 class="mb-0">Mensagem de voz</h5>
                                        </div>
                                        <div class="card-body">

                                            <textarea id="mensagem_alexa" name="mensagem_alexa" class="form-control mb-3" rows="5" cols="1" placeholder="Escreva a mensagem para o cliente ouvir..."></textarea>
                                            <div class="d-flex align-items-center">
                                                <button onClick="texto_to_audio()" class="btn  ms-auto bg-moteltech ">
                                                    Enviar
                                                    <i class="ph-paper-plane-tilt ms-2"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- EFETUAR LIGACAO PARA A SUITE -->
                                    <div class="card" style="margin-top: -8px;height:190px">
                                        <div class="card-header d-flex justify-content-center">
                                            <h5 class="mb-0">Ligação</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="d-flex ms-3">
                                                <p onClick="suite_call()" class="btn  bg-moteltech " style="margin-top: 20px;height:50px">
                                                    Ligar para a suíte
                                                    <i class="ph-phone ms-2"></i>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- LAMPADA -->
                                <div class="col-lg-6 col-xl-3">

                                    <div class="card">
                                        <div class="list-group list-group-borderless py-2">



                                            <a class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l1'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_principal" name="luz_principal" onClick="toogle_lampada_suite(1)" type="checkbox" class="form-check-input form-check-input-dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark"><?= $iluminacao_nome['l1'] ?></label>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l2'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_lustre" name="luz_lustre" onClick="toogle_lampada_suite(2)" type="checkbox" class="form-check-input form-check-input-dark" id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark"><?= $iluminacao_nome['l2'] ?></label>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l3'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_cortina" name="luz_cortina" onClick="toogle_lampada_suite(3)" type="checkbox" class="form-check-input form-check-input-dark" id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark"><?= $iluminacao_nome['l3'] ?></label>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l4'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_criado_mudo" name="luz_criado_mudo" onClick="toogle_lampada_suite(4)" type="checkbox" class="form-check-input form-check-input-dark" id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark">
                                                        <?= $iluminacao_nome['l4'] ?></label>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l5'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_wc_pia" name="luz_wc_pia" onClick="toogle_lampada_suite(5)" type="checkbox" class="form-check-input form-check-input-dark" id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark">
                                                        <?= $iluminacao_nome['l5'] ?></label>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l6'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_wc_box" name="luz_wc_box" onClick="toogle_lampada_suite(6)" type="checkbox" class="form-check-input form-check-input-purple " id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark">
                                                        <?= $iluminacao_nome['l6'] ?></label>
                                                </div>
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="form-check form-switch mb-0 opacity-<?= $iluminacao_nome['l7'] == "null" ? 0 : 100 ?>">
                                                    <div class="font-size: 15px opacity-100 ph-lightbulb"></div>
                                                    <input id="luz_wc_box" name="luz_wc_box" onClick="toogle_lampada_suite(7)" type="checkbox" class="form-check-input form-check-input-purple " id="sc_r_dark">
                                                    <label class="form-check-label opacity-100" for="sc_r_dark"><?= $iluminacao_nome['l7'] ?></label>
                                                </div>
                                            </a>



                                            <span class="ms-2 mt-4">

                                                <button class="btn text-white bg-moteltech " onClick="toogle_all_lampada_suite(1)">
                                                    Ligar tudo
                                                </button>

                                                <button class="btn  text-white bg-moteltech " onClick="toogle_all_lampada_suite(0)">
                                                    Desligar tudo
                                                </button>

                                            </span>
                                        </div>

                                    </div>
                                    <!--RGB -->
                                    <div class="card" style="width:auto;margin-top:-8px">

                                        <div class="card-header d-flex justify-content-center">
                                            <h5 class="mb-0">RGB</h5>
                                        </div>


                                        <div class="card-body" style="margin-left:20px">

                                            <div class="">

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="square square-vermelho" style=" display: inline-block; " onClick="suite_rgb_change(1)"></div>
                                                        <div class="square square-verde" style=" display: inline-block; " onClick="suite_rgb_change(2)"></div>
                                                        <div class="square square-azul" style=" display: inline-block; " onClick="suite_rgb_change(3)"></div>
                                                        <div class="square square-laranja" style=" display: inline-block; " onClick="suite_rgb_change(4)"></div>

                                                    </div>
                                                </div>

                                                <div class="row" style="margin-left:10px">
                                                    <div class="col">
                                                        <div class="square square-roxa" style=" display: inline-block; " onClick="suite_rgb_change(5)"></div>
                                                        <div class="square square-branco" style=" display: inline-block; " onClick="suite_rgb_change(6)"></div>
                                                        <div class="square square-preto" style=" display: inline-block; " onClick="suite_rgb_change(7)"></div>


                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!-- PORTAS | CHAPINHA | AR -->
                                <div class="col-lg-6 col-xl-3">
                                    <!--PORTAS -->
                                    <div class="card">

                                        <div class="card-body text-center">

                                            <div class="row" style="margin-bottom: -30px">
                                                <h5> Portas </h5>
                                                <div class="col">
                                                    <div id="porta_cliente" name="porta_cliente" class="d-inline-flex bg-secondary bg-opacity-50 text-light rounded-pill p-2 mb-2 mt-1">
                                                        <i class="ph-door ph-2x m-1" style=" color: white;"></i>
                                                    </div>
                                                    <h5 class="card-title">Cliente</h5>
                                                </div>

                                                <div class="col">
                                                    <div id="porta_servico" name="porta_servico" class="d-inline-flex bg-secondary bg-opacity-50 text-light rounded-pill p-2 mb-2 mt-1">
                                                        <i class="ph-door ph-2x m-1" style=" color: white;"></i>
                                                    </div>
                                                    <h5 class="bg-opacity-70 text-dark card-title">Serviço</h5>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <!-- CHAPINHA -->
                                    <div class="card" style="margin-top: -10px;">
                                        <div class="card-body text-center " style="margin-bottom: -30px;">
                                            <h5> Chapinha </h5>
                                            <div id="chapinha" name="chapinha" class="d-inline-flex bg-grey bg-opacity-50 text-light rounded-pill p-2 mb-3 mt-1">
                                                <i class="ph-plug ph-2x m-1" style=" color: white;"></i>
                                            </div>

                                            <p class="mb-3" id="tempo_chapinha" name="tempo_chapinha">Aguardando...</p>

                                        </div>
                                    </div>
                                    <!--AR CONDICIONADO -->
                                    <div class="card" style="width:auto;height:190px;margin-top:-8px">

                                        <div class="card-header d-flex justify-content-center">
                                            <h5 class="mb-0">Ar-condicionado</h5>
                                        </div>


                                        <div class="card-body" style="margin-left:20px">

                                            <div class=" row" style="margin-left:-10px">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <label class=" mb-4 col-lg-4 text-lg-end fs-2 ">**º</label>
                                                        <label class="col-lg-2  ">
                                                            <i class="ph-arrow-up  text-muted"></i>
                                                            <i class="ph-arrow-down   text-muted"></i>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <input id="temp_ar" type="text" class="form-control" style="width:60px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="margin-top:-10px">
                                                    <button class="btn text-white bg-moteltech " onClick="liga_arcondicionado()">
                                                        LIGAR
                                                    </button>
                                                    <button class="btn text-white bg-moteltech " onClick="desliga_arcondicionado()">
                                                        DESLIGAR
                                                    </button>
                                                </div>

                                            </div>


                                        </div>


                                    </div>
                                </div>

                                <!-- MIDIA | CENARIO-->
                                <div class="col-lg-6 col-xl-3">
                                    <!-- Audio & vídeo -->
                                    <div class="card" style="height:382px">

                                        <div class="card-body text-center" style="margin-top:-20px;">
                                            <div class="justify-content-center">
                                                <h5 class="">Audio & vídeo</h5>
                                            </div>

                                            <div class="row" style="margin-left: -25px;margin-top:-15px">

                                                <div class=" btn-group">

                                                    <button onClick="suite_audio_video(1)" style="width:80px" class="btn btn-light flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Spotify
                                                    </button>

                                                    <button onClick="suite_audio_video(2)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Youtube
                                                    </button>

                                                    <button onClick="suite_audio_video(3)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Netflix
                                                    </button>


                                                </div>

                                            </div>


                                            <div class="row mt-1" style="margin-left: -25px;margin-top:-10px">

                                                <div class=" btn-group">

                                                    <button onClick="suite_audio_video(4)" style="width:80px" class="btn btn-light flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        IPTV
                                                    </button>

                                                    <button onClick="suite_audio_video(5)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Românticas
                                                    </button>

                                                    <button onClick="suite_audio_video(6)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Rock
                                                    </button>


                                                </div>

                                            </div>

                                            <div class="row mt-1" style="margin-left: -25px;margin-top:-10px">

                                                <div class=" btn-group">

                                                    <button onClick="suite_audio_video(7)" style="width:80px" class="btn btn-light flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Samba
                                                    </button>

                                                    <button onClick="suite_audio_video(8)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start ">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        Sertanejo
                                                    </button>

                                                    <button onClick="suite_audio_video(9)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start">
                                                        <i class="ph-youtube-logo text-danger ph-1x mb-1"></i>
                                                        MPB
                                                    </button>


                                                </div>

                                            </div>

                                            <div class="row mt-1" style="margin-left: -25px;margin-top:-10px">

                                                <div class=" btn-group">

                                                    <button onClick="suite_audio_video(10)" style="width:80px" class="btn btn-light flex-column rounded-0 rounded-start ">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        Spotify
                                                    </button>

                                                    <button onClick="suite_audio_video(11)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start ">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        Românticas
                                                    </button>

                                                    <button onClick="suite_audio_video(12)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        Rock
                                                    </button>


                                                </div>

                                            </div>

                                            <div class="row mt-1" style="margin-left: -25px;margin-top:-10px">

                                                <div class=" btn-group">

                                                    <button onClick="suite_audio_video(13)" style="width:80px" class="btn btn-light flex-column rounded-0 rounded-start ">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        Samba
                                                    </button>

                                                    <button onClick="suite_audio_video(14)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start ">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        Sertanejo
                                                    </button>

                                                    <button onClick="suite_audio_video(15)" class="ms-1 btn btn-light w-10 flex-column rounded-0 rounded-start">
                                                        <i class="ph-spotify-logo text-success ph-1x mb-1"></i>
                                                        MPB
                                                    </button>


                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <!--CENARIO -->
                                    <div class="card" style="width:auto;height:190px;margin-top:-8px">

                                        <div class="card-header d-flex justify-content-center">
                                            <h5 class="mb-0">Cenários</h5>
                                        </div>


                                        <div class="card-body" style="margin-left:-10px">

                                            <div class=" row" style="margin-left:0px">


                                                <div class="col-lg-6" style="margin-top:-10px">
                                                    <button style="width:100px" class="btn text-white bg-moteltech " onClick="suite_cenario(5)">
                                                        Jantar
                                                    </button>

                                                </div>

                                                <div class="col-lg-6 " style="margin-top:-10px">
                                                    <button style="width:100px" class="btn text-white bg-moteltech " onClick="suite_cenario(6)">
                                                        Romântico
                                                    </button>
                                                </div>

                                            </div>

                                            <div class="row mt-4" style="margin-left:0px">


                                                <div class="col-lg-6" style="margin-top:-10px">
                                                    <button style="width:100px" class="btn text-white bg-moteltech " onClick="suite_cenario(7)">
                                                        SPA
                                                    </button>

                                                </div>

                                                <div class="col-lg-6 " style="margin-top:-10px">
                                                    <button style="width:100px" class="btn text-white bg-moteltech " onClick="suite_cenario(8)">
                                                        Dormir
                                                    </button>
                                                </div>

                                            </div>


                                        </div>
                                    </div>


                                </div>


                            </div>

                        </div>





                    </div>
                    <!-- /inner content -->

                </div>
                <!-- /main content -->
            </div>
        </div>
    </div>
    <!-- ALTERAR TEMA -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
        <div class="position-absolute top-50 end-100 visible">
            <button type="button" class="btn bg-roxo btn-icon translate-middle-y
            rounded-end-0 opacity-50" data-bs-toggle="offcanvas" data-bs-target="#demo_config">
                <i class="ph-gear"></i>
            </button>
        </div>

        <div class="offcanvas-header border-bottom py-0">
            <h5 class="offcanvas-title py-3">Configuração de tela</h5>
            <button type="button" class="btn btn-light btn-sm btn-icon
            border-transparent rounded-pill" data-bs-dismiss="offcanvas">
                <i class="ph-x"></i>
            </button>
        </div>

        <div class="offcanvas-body">
            <div class="fw-semibold mb-2">Modo de cor</div>
            <div class="list-group mb-3">
                <label class="list-group-item list-group-item-action form-check
                border-width-1 rounded mb-2">
                    <div class="d-flex flex-fill my-1">
                        <div class="form-check-label d-flex me-2">
                            <i class="ph-sun ph-lg me-3"></i>
                            <div>
                                <span class="fw-bold">Tema claro</span>
                                <div class="fs-sm text-muted">SAlternar para o tema claro</div>
                            </div>
                        </div>
                        <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="light" checked>
                    </div>
                </label>

                <label class="list-group-item list-group-item-action form-check
                border-width-1 rounded mb-2">
                    <div class="d-flex flex-fill my-1">
                        <div class="form-check-label d-flex me-2">
                            <i class="ph-moon ph-lg me-3"></i>
                            <div>
                                <span class="fw-bold">Tema escuro</span>
                                <div class="fs-sm text-muted">Alternar para o tema escuro</div>
                            </div>
                        </div>
                        <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="dark">
                    </div>
                </label>

            </div>

        </div>

    </div>


</body>


<!-- SCRIPTS -->
<?php require_once("../layout/scripts_footer.php"); ?>

<!-- JS SUITE -->
<script src="../../assets/js/suite/script.js"></script>



</html>