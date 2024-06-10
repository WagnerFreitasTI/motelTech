<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\index");
    return;
   }

?>


<footer id="footer">
            <div class="inner">
                <ul class="icons">
                    <li><a onClick="link_playstore()" class="icon brands alt fa-google-play"><span class="label">App android</span></a></li>
                    <li><a onClick="" class="icon brands alt fa-apple"><span class="label">App IOS</span></a></li>
                    <li><a onClick="link_facebook()" class="icon brands alt fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a onClick="link_instagram()" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a onClick="link_whatsapp()" class="icon brands alt fa-whatsapp"><span class="label">Whatsapp</span></a></li>
                    <li><a onClick="link_website()" class="icon regular alt fa-globe"><span class="label">Site</span></a></li>
                </ul>
                <ul class="copyright">
                    <li>Desenvolvimento  <a href="<?=$desenvolvido_por?>"><?=$desenvolvido_por?></a></li>
                </ul>
            </div>
        </footer>