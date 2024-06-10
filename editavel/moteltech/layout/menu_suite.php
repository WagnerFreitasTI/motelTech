<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\index");
    return;
   }


?>

