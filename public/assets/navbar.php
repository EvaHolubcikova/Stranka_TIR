<section class="container-fluid" style="background-color:lightblue;">
  <nav style="background-color:lightblue;" class="navbar navbar-expand-lg navbar-dark container sticky-top">
    <a style="background-color:lightblue;" class="navbar-brand" href="#">Spojená škola Tvrdošín</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

        <?php
              $aktivnaStranka = basename(dirname($_SERVER['SCRIPT_NAME']));

              $riadky = file('../../assets/menu.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 

              foreach ($riadky as  $riadok) {
                list($k,$h) = explode('::', $riadok); 
                $menu[$k] = $h;
              }
                  ?>
              
              <?php foreach ($menu as $odkaz => $hodnota):?>
                <li class="nav-item">
                    <a class="nav-link" <?php if($odkaz == $aktivnaStranka):?>class="active"<?php endif;?> href ="<?php echo $odkaz;?>"> <?php echo $hodnota;?>
                      </a>
                    </li>
                    <?php endforeach;?>
                    <?php

              if($h == $aktivnaStranka){
                ?> <div class="active">
                  <?php echo $aktivnaStranka ?>

                </div>
                <?php
              }
              ?>
        </ul>
     </div>
  </nav>
</section>


 
