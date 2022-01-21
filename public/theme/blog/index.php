<?php 
	date_default_timezone_get('Europe/Bratislava');
	include '../../assets/hlavicka.php';
	include '../../assets/navbar.php';
	include '../../assets/rozne.php';

	$success = '';

	$mysqli = new mysqli("localhost","root","root","demo4c");
	$mysqli -> set_charset("utf8");
  
	$sql = 'SELECT * FROM prispevky ORDER BY cas DESC';
	  $result = $mysqli->query($sql);
  

?>
<style>
	body{background-color: pink;
	color: white;}
</style>


<?php 

$chyba ="";
$meno = "";
$sprava = "";

/// odlišujeme prvy krat stranka spustena

if($_SERVER['REQUEST_METHOD'] == 'POST'){



if(kontrola($_POST['odpoved']) == $_POST['spravna_odpoved']){

$suborPrispevky = fopen('prispevky.csv', 'a');

$novyPrispevok = array();


$novyPrispevok[] = $_POST['pocet'] + 1;	
$novyPrispevok[] = kontrola($_POST['meno']);
$novyPrispevok[] = kontrola($_POST['sprava']);
$novyPrispevok[] = date('Y-m-d H:i:s',time());

$sql = 'INSERT INTO prispevky (meno, prispevok, cas) VALUES ("'.kontrola($_POST['meno']).'", "'.kontrola($_POST['sprava']).'", "'.date('Y-m-d H:i:s', time() ).'")';
          echo $sql;
          $mysqli->query($sql);
          $success .= 'true';

          unset($_POST);
			    header("Location: " . $_SERVER['PHP_SELF']);

 fputcsv($suborPrispevky, $novyPrispevok, ';');
fclose($suborPrispevky);

}
else
{
 $chyba = "Nespravna odpoved na otazku";
 $meno = kontrola($_POST['meno']);
 $sprava = kontrola($_POST['sprava']);
}



 ?>

<?php  
if(!empty($chyba)){

?>	

<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <strong> Ups! </strong> <?php echo $chyba; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php }  ?>

<?php  
if(empty($chyba)){

?>	

<div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong> Výborne </strong> <?php echo "Uspešne sme pridali váš názor" ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php } 

}
 ?>


<?php 



	$suborCaptcha = file('captcha.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	//$antiSpam = [];

	for ($i=0; $i < count($suborCaptcha) ; $i+=2){

		$antiSpam[str_replace("odpoved: ","",$suborCaptcha[$i+1])] = str_replace("otazka: ","", $suborCaptcha[$i]);

	}


	$vybranyKluc = array_rand($antiSpam);
	
	$prispevky = [];
	$suborPrispevky = fopen('prispevky.csv', 'r');

	while($prispevok = fgetcsv($suborPrispevky,1000,';')){
		$prispevky[] = $prispevok;
	}

	fclose($suborPrispevky);

	$prispevky = array_reverse($prispevky);
 ?>





<section>
	<h1 style="text-align: center;">Blog </h1>

	<div class="container">
		<form action="index.php"  method="post">
			<div class="form-group was-validated">
				<small id="emailHelp" class="form-text text-muted"><b>Meno</b></small>
				<input type="text" placeholder="Meno autora" class="form-control" required autocomplete="" 	pattern="\S.{2,20}" name="meno"  value="<?php echo $meno ?>"> 
				<div class="invalid-feedback">
					Prosím vyplňte túto položku (3-20 znakov)
				</div>
			</div>			
			<div class="form-group ">
				 <small id="emailHelp" class="form-text text-muted"><b>Správa</b></small>
				<textarea name="sprava"  cols="98" rows="5" placeholder="Váš text" class="form-control" required><?php echo $sprava ?></textarea>
			</div>
		
			<div class="form-group">
					 <small> <b>Antispam:</b> <?php echo $antiSpam[$vybranyKluc]  ?> </small> 
			 <div class="form-group was-validated">

			 	<div class="row" >	
						<div class="col-md-7"> <input type="text" placeholder="Odpoveď" class="form-control just" required name="odpoved" pattern="<?php echo $vybranyKluc ?>" > </div>
						<div class="col-md-4">
							 <button type="reset" class="btn btn-light float-right border-dark">Vynulovať</button>		
						</div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-light float-right border-dark">Odoslať</button>
						</div>
					 
				</div>
		</div>
		
		<input type="hidden" name="spravna_odpoved" value="<?php echo $vybranyKluc ?>">
		<input type="hidden" name="pocet" value="<?php echo count($prispevky) ?>">
			
		
		</form>
	</div>


	<hr class="border-dark"> 
	<div class="container">
 		<?php
    if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
		 ?>
			<h4><?= $row["meno"] ?></h4>
			<small><i> Odoslane: <?= $row["cas"] ?></i></small>
			<p>
				<?php echo prelozBBCode(nl2br($row["prispevok"])) ?>
			</p>
			<hr>
		<?php
			}
		}
    ?>
 	</div>
</section>

<?php 
include '../../assets/pata.php';
?>