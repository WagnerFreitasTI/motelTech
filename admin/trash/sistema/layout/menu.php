<?php
   if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
    header("Location: ..\..\index");
    return;
   }

?>


 <!-- MENU -->
 <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
        <!-- HOME -->
          <li class="nav-item">
            <a href="../home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Dashboard   </p>
            </a>
          </li>
            <!-- SUITE -->
            <li class="nav-item">
            <a href="../suite" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Suites</p>
            </a>
          </li>

           <!-- SUITE -->
           <li class="nav-item">
            <a href="../acesso" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Acessos</p>
            </a>
          </li>

            <!-- DEVICE -->
            <li class="nav-item">
            <a href="../device" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p> Hardwares</p>
            </a>
          </li>
       

          

        </ul>
      </nav>