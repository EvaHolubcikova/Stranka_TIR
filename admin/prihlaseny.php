<?php
include 'hlavickaAdmin.php';
//include 'navbarAdmin.php';
?>

<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
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
				 // header('Location: index.php');
			  }
			?>
<div>
	<div class="d-flex flex-column flex-shrink-0 p-3 text-dark bg-dark" style="position: absolute; width: 15%; height:94%; float:left;">
	<h2 style="color: white;"><?php echo $_SESSION["user"]; ?></h2>
	  <h5 style="color: silver;"><?php echo $_SESSION["role"]; ?></h5>
      </div>
	  <section class="container-fluid" style="position: absolute; left:10px; color:black;" >
  <nav class="navbar navbar-expand-lg navbar-dark container sticky-left justify-content-end">
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



  </div>
  	<div class="p-3 text-white" style="position: absolute; bottom: 10px; width: 50%; right: 10px;">
	    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
	    </a>
	    <hr>
      <?php $connection = mysql_connect('localhost', 'root', 'root');
          mysql_select_db('demo4c');

        $query = "SELECT * FROM prispevky"; 
        $result = mysql_query($query);

        echo "<table class='table table-dark'"; 

          while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['meno'] . "</td><td>" . $row['prispevok'] . "</td></tr>";  //$row['index'] the index here is a field name
        }

        echo "</table>"; //Close the table in HTML

        mysql_close(); //Make sure to close out the database connection

?>
	    
	</div>
<?php
include 'pataAdmin.php';
?>