<?php
	include 'dbKonfiguratu.php';
	$link = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	$sql = "SELECT * FROM questions";
	$result = $link->query($sql);
	$total=$result->num_rows;
	echo $total;
	$link->close();
?>