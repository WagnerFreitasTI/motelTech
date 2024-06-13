<?php
session_start();
require_once "../../../src/var_system.php";
require_once "../../src/usuario/function.php";
$pdo = require_once "../../../src/connection.php";


protegePagina($pdo); //SOMENTE USUARIO LOGADO
//APOS VALIDAR

//USUARIO LOGADO
$usuario = getUsuario($pdo);

?>


<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <title>MotelTech - Dashboard</title>


    <!-- SCRIPTS -->

    <?php require_once("../layout/scripts_header.php"); ?>
    <style>
        .no-focus-outline:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .red {
            background-color: red;
            animation: animateRed 1s linear infinite;
        }

        @keyframes animateRed {
            0% {
                background-color: #1c1c1c;
            }

            50% {
                background-color: #f51616;
            }

            100% {
                background-color: #1c1c1c;

            }
        }

        .blue {
            background-color: blue;
            animation: animateBlue 1s linear infinite;
        }

        @keyframes animateBlue {
            0% {
                background-color: #1c1c1c;
            }

            50% {
                background-color: #306ed1;
            }

            100% {
                background-color: #1c1c1c;

            }
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
                            Sair
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
                            <a class="nav-link active">
                                <i class="ph-gauge"></i>
                                <span>
                                    Painel
                                </span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a class="nav-link">
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
                                    <i class="ph-bed"></i>
                                    <span>Usuário</span>
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
                                    <i class="ph-bed"></i>
                                    <span>Configurações</span>
                                </a>
                                <ul class="nav-group-sub collapse">
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Parametros do Sistemas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Suites </a>
                                    </li>

                                </ul>
                            </li>


                        <?php } ?>


                    </ul>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                <div class="content">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row" id="suites">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
        <div class="position-absolute top-50 end-100 visible">
            <button type="button" style="" class="btn bg-roxo btn-icon translate-middle-y
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
                                <div class="fs-sm text-muted">Alternar para o tema claro</div>
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
    <!-- /demo config -->

</body>

<!-- SCRIPTS -->
<?php require_once("../layout/scripts_footer.php"); ?>

<!-- JS HOME -->
<script src="../../assets/js/home/script.js"></script>

</html>