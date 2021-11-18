<?php
include 'hlavickaAdmin.php';
//include 'navbarAdmin.php';
?>


	<body style="background-color:powderblue;">

	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <a  class="navbar text-white" href="#">Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	  </button>
	  <div class="collapse navbar-collapse " id="navbarNavSupportedContent">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
		  <?php
		  session_start();
    if(isset($_SESSION['odhlaseny'])) {
        header('Location: prihlaseny.php');
        exit();

    }?>
			 

	        <a class="nav-link text-light " href="../admin/odhlasenie.php">Odhlásiť sa</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	<?php
			  if(isset($_POST['signOut'])){
				  unset($_SESSION['user']);
				  unset($_SESSION['role']);
				  header('Location: index.php');
			  }
			?>

	<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 300px;">
	<h2 style="color: white;"><?php echo $_SESSION["user"]; ?></h2>
	  <h5 style="color: silver;"><?php echo $_SESSION["role"]; ?></h5>


	<div class="p-3 text-white" style="width: 280px; height: 100%">
	    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
	    </a>
	    <hr>
		<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
	    
	</div>
<?php
include 'pataAdmin.php';
?>