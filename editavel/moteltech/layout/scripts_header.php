<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\index");
    return;
   }

?>


<!-- Global stylesheets -->
<link href="../../assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
<link href="../../assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="../../assets/demo/demo_configurator.js"></script>
<script src="../../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="../../assets/js/vendor/visualization/d3/d3.min.js"></script>
<script src="../../assets/js/vendor/visualization/d3/d3_tooltip.js"></script>
<script src="../../assets/js/app.js"></script>
<script src="../../assets/demo/pages/dashboard.js"></script>
<script src="../../assets/demo/charts/pages/dashboard/streamgraph.js"></script>


<link rel="stylesheet" href="../../../assets/sweetalert2/dist/sweetalert2.min.css">

<style>
    .custom-swal-container {
        background-color: rgba(0, 0, 0, 0.9) !important;
    }

    .bg-moteltech {
        opacity: 0.5;
        background-color: #9700bd !important;
        border-color: #9700bd !important;
        color: white !important;
    }

    .bg-moteltech:hover {
        background-color: #9700bd;
        opacity: 1;
    }

    .bg-roxo{
        background-color: #9700bd !important;
        border-color: #9700bd !important;
        color: white !important;
    }
    </style>
