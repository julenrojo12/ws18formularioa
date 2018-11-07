<?php

	include 'dbKonfiguratu.php';

	$link = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	
	if($link->connect_errno){
		die( "Huts egin du konexioak MySQL-ra: (".
			$link-> connect_errno. ") " . 
			$link-> connect_error);
	}
	echo "Konexioa egin da, sortutako galderak hauek dira:" .$link->host_info;
	
	$sql = "SELECT * FROM questions";
	$result = $link->query($sql);
	
	if ($result->num_rows > 0){
		
		while ($row = $result ->fetch_assoc()){
			echo "<br> ePOSTA: " .$row["EPOSTA"]. " Galdera: " .$row["GALDERA"]. " Erantzun zuzena: " .$row["eZuzena"]. " Erantzun okerra 1: " .$row["eOkerra1"]. " Erantzun okerra 2: " .$row["eOkerra2"]. " Erantzun okerra 3: " .$row["eOkerra3"]. " Zailtasuna: " .$row["ZAILTASUNA"]. " Gaia: " .$row["GAIA"] ;
		}
	}else{
		echo "0 galdera";
	}	
	
	
	echo "<p><a href='layout2.php'> Hasiera </a>";
?>	
