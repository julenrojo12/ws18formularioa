<?php
	include 'dbKonfiguratu.php';
	$link = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	$sql = "SELECT * FROM questions";
	$result = $link->query($sql);
	$total=$result->num_rows;
	//$user=$_GET['user'];
	/*$sql2 = "SELECT * FROM questions WHERE eposta='$user'";
	$result2 = $link->query($sql2);
	$total2=$result2->num_rows;*/
	echo $total;
	$link->close();
?>