<!DOCTYPE html>
<html lang="pt-br" dir="ltr">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Motel Tech - Autenticação</title>

    <!-- Global stylesheets -->
    <link href="assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="assets/demo/demo_configurator.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- /core JS files -->
    <link rel="stylesheet" href="../assets/sweetalert2/dist/sweetalert2.min.css">

</head>

<body class="bg-dark">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">

                    <!-- Login card -->
                    <form class="login-form" id="form_login" name="form_login">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                        <img src="assets/images/logo.png" class="h-18px " alt="">
                                    </div>
                                    <h5 class="mb-0">Autenticação</h5>
                                    <span class="d-block text-muted">Entre com o usuário e senha</span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Login</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        <input type="text" class="form-control" placeholder=" " id="login" name="login">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-user-circle text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Senha</label>
                                    <div class="form-control-feedback form-control-feedback-start">
                                        <input type="password" class="form-control" placeholder=" " id="senha" name="senha">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                           

                                <div class="mb-3">
                                    <button  class="btn btn-primary w-100" id="autenticar">Autenticar</button>
                                </div>


                            </div>
                        </div>
                    </form>
                    <!-- /login card -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    


</body>

<!-- jQuery -->
<script src="../assets/js/jquery.min.js"></script>



<!-- sweet -->
<script src="../assets/sweetalert2/dist/sweetalert2.min.js" async=""></script>
<script src="../assets/js/comum.js"></script>
<script src="assets/js/usuario/script.js"></script>


</html>