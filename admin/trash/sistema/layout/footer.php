<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\..\index");
    return;
   }

?>


<!--FOOTER -->
<footer class="main-footer">
    <strong>Copyright &copy;<script>document.write(new Date().getFullYear())</script> <a href="https://www.sgoes.com.br/"><?=$nome_sistema  ?></a>.</strong>
    Todos os direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0
    </div>
  </footer>