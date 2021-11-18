<section class="container-fluid" style="background-color:powderblue;" >
  <nav class="navbar navbar-expand-lg navbar-dark container sticky-top justify-content-end">
    <a class="navbar-brand" href="#">Spojená škola Tvrdošín-Administrácia</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <nav class="navbar navbar-expand-lg navbar-light">
	  <a  class="navbar text-white" href="#">Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	  </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

          <?php
              $aktivnaStranka = basename(dirname($_SERVER['SCRIPT_NAME']));

        //      $menu = [];

              $riadky = file('../admin/menuAdmin.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 

              foreach ($riadky as  $riadok) {
                list($k,$h) = explode('::', $riadok); 
                $menu[$k] = $h;
              }

              
          foreach ($menu as $odkaz => $hodnota) {
                echo  '<li class="nav-item">
                    <a class="nav-link" '.($aktivnaStranka == $odkaz? 'active':'').'" href="' .$odkaz. '.php">'.$hodnota.'</a>
                  </li>';
              }
           ?>  
        </ul>
     </div>
  </nav>
</section>