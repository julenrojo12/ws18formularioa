<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	include 'dbKonfiguratu.php';
	$link3 = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	$email =  $_POST['posta'];
	echo $email;
	$sql6 = mysqli_query($link3,"SELECT * FROM `erregistratuak` WHERE `EPOSTA` LIKE '$email'");
	$count = mysqli_num_rows($sql6);
	if($count == "0"){
		echo " erabiltzailea ez da existitzen!";
	}else{
		$sql7 = "DELETE FROM `erregistratuak` WHERE `EPOSTA` LIKE '$email'";
		$result7 = $link3->query($sql7);
		echo " erabiltzailea ezabatu egin da.";
	}	
	$link3->close();
?>