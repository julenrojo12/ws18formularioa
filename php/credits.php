<!DOCTYPE html>
<?php session_start (); ?>
<html>
	<head>
        <meta charset="utf-8">
        <title>Credits</title>
		<link rel="stylesheet" type="text/css" href="../styles/caja.css">
    </head>
	
	<body>

	<div>
		<!-- <?php
				$userName = $_GET['user'];
				echo "<span id=userPhp>".$userName."</span>"
		?> -->
		<?php
			if(isset($_SESSION['erabiltzaile'])){
				echo $_SESSION['erabiltzaile'];
			}
		?>
	</div>

	<div class="cajaNaranja">
		<h3> Jon Diez Barrios eta Angela Escondrillas Diez</h3>
		<h4> Ingenieritza Informatikan lizenziatuak </h4>
		<img src="../images/pichoncinWS.jpg" alt="Italian Trulli" height="200">
		<h5>Getxo, Algorta, munduaren bihotza</h5><br>

		<?php
			echo "<p><a href='layout.php'>Home</a></p>";
		?>
	</div>
	</body>
</html>