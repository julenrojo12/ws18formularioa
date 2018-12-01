<?php
	include 'dbKonfiguratu.php';
	$link2 = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	//$email2 = $_POST['posta'];
	$email2="proba002@ikasle.ehu.eus";
	$sql2 = "SELECT * FROM `erregistratuak` WHERE `EPOSTA` LIKE '$email2'";
	$result2 = $link2->query($sql2);
	$count = mysqli_num_rows($result2);
	echo $email2;
	if($count == "0"){
		echo " erabiltzailea ez da existitzen!";
	}else{
		$sql3 = "SELECT `BLOKEATUTA` FROM `erregistratuak` WHERE `EPOSTA` LIKE '$email2' AND `BLOKEATUTA`='1'";
		$result3 = $link2->query($sql3);
		$count2 = mysqli_num_rows($result3);
		if($count2){
		//DESBLOKEATU
			$sql4 = "UPDATE `erregistratuak` SET `BLOKEATUTA`='0' WHERE `EPOSTA` LIKE '$email2'";
			$result4 = $link2->query($sql4);
			echo " erabiltzailea desblokeatu egin da.";
		}else{
			//BLOKEATU
			$sql5 = "UPDATE `erregistratuak` SET `BLOKEATUTA`='1' WHERE `EPOSTA` LIKE '$email2'";
			$result5 = $link2->query($sql5);
			echo " erabiltzailea blokeatu egin da.";
		}
	}	
	$link2->close();
?>