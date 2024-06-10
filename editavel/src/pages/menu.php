<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\index");
    return;
   }

?>


<nav id="menu">
            <ul class="links">
                <li><a href="home">Home</a></li>
                <li><a href="automacao">Automação</a></li>
                <li><a href="cardapio">Cardápio</a></li>
                <li><a href="servicos">Serviços</a></li>
                <li onClick="link_apresentacao()"><a href="#">Apresentação</a></li>
                <li onClick="link_website()"><a href="#">Nosso site</a></li>
                <li onClick="link_reclamacao()"><a href="#">Sugestão e reclamação</a></li>
                <li onClick="link_whatsapp()"><a href="#">Whatsapp</a></li>
            </ul>
            <!--
                <ul class="actions stacked">
                <li>
                    <a href="#" onClick="liga_recepcao()" class="button fit">Chamar recepção</a>
                </li>
                 -->
            </ul>
</nav>