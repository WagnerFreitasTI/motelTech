<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\index");
    return;
   }

?>
<script>
   var is_tablet = false
</script>

<!-- COMUM -->
<script src="../../assets/js/comum.js"></script>

<!-- jQuery -->
<script src="../../../assets/js/jquery.min.js"></script>

<!-- sweet -->
<script src="../../../assets/sweetalert2/dist/sweetalert2.min.js" async=""></script>
<script src="../../../assets/js/comum.js"></script>
