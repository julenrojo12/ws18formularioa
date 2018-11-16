<!DOCTYPE HTML>
<html>
<head> 
	<title>LOG IN</title> 
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../styles/caja.css">
</head>
<body>
	<div class="cajaNaranja">
	<h3>LOG IN</h3>
	<p>Sartu sure eposta eta pasahitza</p>
	
	<br>
		<form id="signUpF" name="signUpF" action="" onsubmit="return true;" method="POST" enctype="multipart/form-data"> 
			Eposta(*): <input type="email" name="email" id="email" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$" value="xxxxxx000@ikasle.ehu.eus" onClick="this.value=''" oninvalid="this.setCustomValidity('Sartu emaila formatu egokian')" oninput="setCustomValidity('')"><br>
			Pasahitza(*): <input type="password" name="pasahitza" id="pasahitza" required pattern="^.{8,}$" oninvalid="this.setCustomValidity('Gutxienez 8ko luzeera izan behar du.')" oninput="setCustomValidity('')"><br>	
			<input type="submit" name="bidali" value="Sartu"/>
			<input type="reset" value="Ezabatu"/>
	</form> 	
	<br>	
	<span><a href='signUp.php'>SignUp</span>
	<span><a href='../layout.html'>Home</a></span>
	</div>
	
	<?php
	include 'dbKonfiguratu.php';
	
	if(isset($_POST['bidali'])){
		$esteka = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
		
		if($esteka->connect_errno){
			die( "Huts egin du konexioak MySQL-ra: (".
				$esteka-> connect_errno. ") " . 
				$esteka-> connect_error);
		}
		echo "Konexioa egin da: - " .$esteka->host_info;
		
		$sql = mysqli_query($esteka,"SELECT * FROM `erregistratuak` WHERE `EPOSTA` LIKE '$_POST[email]'");
		$count = mysqli_num_rows($sql);
			if($count == "0"){
				echo " Erabiltzailea ez dago erregistratuta.";
			}else{
				$q = "SELECT PASAHITZA FROM `erregistratuak` WHERE `EPOSTA` LIKE '$_POST[email]'";
				$result = $esteka->query($q);
				$row = $result->fetch_assoc();
				$p = $row["PASAHITZA"];
				$q2 = "SELECT EPOSTA FROM `erregistratuak` WHERE `EPOSTA` LIKE '$_POST[email]'";
				$result2 = $esteka->query($q2);
				$row2 = $result2->fetch_assoc();
				$mail = $row2["EPOSTA"];
				if ($p !=($_POST['pasahitza'])){
					echo " Pasahitza ez da egokia";
				}else{
					echo " Ondo sartu zara!";
					echo "<p><a href='layout2.php?user=$mail'> Hasiera </a>";
			}
			}
			
	}
	
		
	?>
</body>

</html>