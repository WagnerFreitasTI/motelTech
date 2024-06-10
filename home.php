<?php
session_start();
$pdo = require_once "src/connection.php";
require_once 'src/mobile/src/MobileDetect.php';
require_once "src/var_system.php";
require_once "src/functions.php";
require_once "src/user/function.php";
require_once "src/suite/function.php";
require_once "src/tablet/function.php";
require_once "src/comum.php";

?>

<!DOCTYPE HTML>
<html>

<head>
    <title><?=$nome_cliente." | ".$nome_sistema?> </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/comum.css" />
    <link rel="stylesheet" href="assets/css/home.css" />

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

        <!-- Banner -->
        <section id="banner" class="major" >
            <div class="inner inerhome" >
                <header class="major majorhome" >
                    <h3>Bem vindo ao <span style="font-size:25px"> MOTEL MEDIEVAL</span> </h3> 
                </header>

                <div class="container " style="">
                    <div class="content">
                        <div class="content-inner">
                        
                        <ul class="actions botoeshome">
                                <li onClick="link_apresentacao()">
                                    <a href="#" class="button  ">Apresentação</a>
                                </li>
                        </ul>
                        </div>
                        <p class="textbemvindo">Aqui está nossa solução especial para você!.</p>

                            
                    </div>

                   <!--  <div class="content">
                        <div class="content-inner">
                            <p class="textbemvindo">Fale com nossa recepção virtual clicando aqui.</p>
                            <ul class="actions botoeshome">
                                <li onClick="liga_recepcao()">
                                    <a href="#" class="button  ">Chamar recepção</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    -->
                </div>

            </div>
        </section>

        <!-- Main -->
        <div id="main">

            <!-- One -->
            <section id="one" class="tiles">

                <article  class="homearticles" >
                    <span class="image">
                        <img src="images/pic01.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3><a href="automacao" class="link">Automação</a></h3>
                        <p>Acesse para comandar iluminação, ar-condicionado, TV, som, etc.</p>
                    </header>
                </article>

                <article class="homearticles">
                    <span class="image">
                        <img src="images/pic02.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3><a href="cardapio" class="link">Cardápio</a></h3>
                        <p>Faça seu pedido por aqui. Receba em sua suíte com muito glamour.</p>
                    </header>
                </article>

                <article class="homearticles">
                    <span class="image">
                        <img src="imagens/pic03.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3><a href="servicos" class="link">Serviços</a></h3>
                        <p>Estamos pronto para te atender por aqui</p>
                    </header>
                </article>

                <article class="homearticles">
                    <span class="image">
                        <img src="images/pic04.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3><a href="audioevideo" class="link">Áudio & Vídeo</a></h3>
                        <p>Comande Spotify, youtube, netflix, canais ao vivo, etc</p>
                    </header>
                </article>

                <article onClick="link_playstore()" class="homearticles">
                    <span class="image">
                        <img src="images/pic05.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3>Nosso APP</h3>
                        <p>Baixe nosso app e aproveite benefícios exclusivos! Desfrute de recursos personalizados e descontos incríveis. Faça o download agora!</p>
                    </header>
                </article>

                <article onClick="link_reclamacao()" class="homearticles">
                    <span class="image">
                        <img src="images/pic06.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3>Sugestão e reclamação</h3>
                        <p>Gostaríamos de ouvir suas sugestões e reclamações para melhorar nossos serviços e garantir sua satisfação.</p>
                    </header>
                </article>




                <article onClick="link_whatsapp()" class="homearticles">
                    <span class="image">
                        <img src="images/pic05.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3>Whatsapp</h3>
                        <p>Agora você pode nos contatar diretamente pelo WhatsApp para tirar suas dúvidas, enviar sugestões ou relatar problemas. Estamos aqui para ajudar!</p>
                    </header>
                </article>

                <article onClick="link_website()" class="homearticles">
                    <span class="image">
                        <img src="images/pic06.jpg" alt="" />
                    </span>
                    <header class="major">
                        <h3>Site</h3>
                        <p>Acesse nosso site e descubra benefícios exclusivos em tempo real. Encontre informações atualizadas, recursos úteis e soluções personalizadas para suas necessidades. Explore agora!</p>
                    </header>
                </article>
            </section>



            <!-- Two -->
            <section id="two">
                <div class="inner">
                    <header class="major">
                        <h2>LGPD</h2>
                    </header>
                    <p>A Lei Geral de Proteção de Dados Pessoais (LGPD), Lei n° 13.709/2018, foi promulgada para
                        proteger os direitos fundamentais de liberdade e de privacidade e a livre formação da
                        personalidade de cada indivíduo. A Lei fala sobre o tratamento de dados pessoais, dispostos em
                        meio físico ou digital, feito por pessoa física ou jurídica de direito público ou privado,
                        englobando um amplo conjunto de operações que podem ocorrer em meios manuais ou digitais.</p>
                    <ul class="actions" onClick="link_lgpd()">
                        <li>Saiba mais</li>
                    </ul>
                </div>
            </section>

        </div>

        <!-- Footer -->
        <?php require_once("src/pages/footer.php"); ?>



    </div>

    <script>
    const url_node_red = <?="'".$url_node_red."'"?> //NODERED
    const suite = <?="'".$suite['id']."'" ?> //SUITE
    const suite_token = <?="'".$suite['token']."'" ?> //TOKEN
    var time_out_status_rele; //ATUALIZA STATUS RELE
    var aviso_erro; //ERRO SET RELE
    var is_tablet =  <?="'".$istablet."'" ?> //SUITE
   
    </script>

    

    <!-- Scripts -->
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

   <script>
    window.addEventListener('load', function() {
  var largura = window.innerWidth;
  var altura = window.innerHeight;
  
  //alert('Dimensões da tela: ' + largura + 'x' + altura);
});
    </script>

</body>

</html>