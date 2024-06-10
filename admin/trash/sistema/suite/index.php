<?php
session_start();
require_once "../../../src/var_system.php";
require_once "../../../src/functions.php";
require_once "../../src/usuario/function.php";
$pdo = require_once "../../../src/connection.php";



protegePagina($pdo);//SOMENTE USUARIO LOGADO
//APOS VALIDAR

//USUARIO LOGADO
$usuario = getUsuario($pdo);



?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suites |<?=$nome_sistema  ?></title>

    <?php require_once("../layout/styles.php"); ?>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">





        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="<?=$nome_sistema  ?>"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?=$nome_sistema  ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?=$usuario['nome']?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MENU -->
                <?php require_once("../layout/menu.php"); ?>



            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- CONTENT -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Suites</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="../../sair">Deslogar</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">

                    <!-- TABELA -->
                    <div class="row">

                        <div class="col-12">

                            <button style="width:200px " type="button" class="mb-2 btn btn-primary ms-2 mt-2 mt-sm-0"
                                id="adicionar_suite">
                                <svg class="icon-20" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>Adicionar</span>
                            </button>

                            <div class="card">


                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap" id="tabela_suite">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Hardware</th>
                                                <th> </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>


        </div>


        <!-- MODAL ADD | EDIT -->
        <div class="modal" id="modal_novo">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="titulo_modal">Nova suite</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="card card-primary">



                            <form id="form_suite" name="form_suite">
                                <input type="hidden" id="id_suite" name="id_suite" value="0 ">
                                <input type="hidden" id="op_suite" name="op_suite" value="0">

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nome</label>
                                        <input type="text" class="form-control" id="nome_suite" name="nome_suite"
                                            value=" " placeholder="Digite o nome">
                                    </div>





                                    <div class="form-group">

                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Hardware</label>
                                            <select class="form-control" id="hardware_suite" name="hardware_suite">
                                       
                                            </select>
                                        </div>


                                    </div>


                                </div>


                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="salvar_suite">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">fechar</button>
                    </div>

                </div>
            </div>
        </div>

        </section>
        <!-- /.content -->
    </div>

    <!--  FOOTER -->
    <?php require_once("../layout/footer.php"); ?>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- SCRIPTS -->
    <?php require_once("../layout/scripts.php"); ?>

    <!-- DATATABLE -->

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- SUITE -->
    <script src="../../dist/js/suite/script.js"></script>

</body>

</html>