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
				  header('Location: index.php');
			  }
			?>
<div>
	<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 300px; height:850px; float:left;">
	<h2 style="color: white;"><?php echo $_SESSION["user"]; ?></h2>
	  <h5 style="color: silver;"><?php echo $_SESSION["role"]; ?></h5>
      </div>


	<div class="p-3 text-white" style="width: 1000px; height: 100%; padding: 10; margin: 0 auto; float:right;">
	    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
	    </a>
	    <hr>
      <?php $connection = mysql_connect('localhost', 'root', 'root');
          mysql_select_db('demo4C');

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
  </div>
<?php
include 'pataAdmin.php';
?>