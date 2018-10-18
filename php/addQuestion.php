<!DOCTYPE HTML>
<HTML>
<head> 
	<title>ADD QUESTION PHP</title> 
	<meta charset="UTF-8">
</head>

<body>
<h3>AddQuestion-en kudeaketa</h3>

<?php
	include 'dbKonfiguratu.php';
	
	
	$esteka = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	
	if($esteka->connect_errno){
		die( "Huts egin du konexioak MySQL-ra: (".
			$esteka-> connect_errno. ") " . 
			$esteka-> connect_error);
	}
	echo "Konexioa egin da:" .$esteka->host_info;

	echo $sql = "INSERT INTO questions(EPOSTA,GALDERA,eZuzena,eOkerra1,eOkerra2,eOkerra3,ZAILTASUNA,GAIA) VALUES ('$_POST[email]','$_POST[galdera]', '$_POST[zuzena]', '$_POST[okerra1]', '$_POST[okerra2]', '$_POST[okerra3]','$_POST[zailt]', '$_POST[gaia]')";

	$ema=mysqli_query($esteka, $sql);
	if (!$ema) {
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		echo "<p><a href='../addQuestionHTML5.html'> Sartu galdera berria! </a>";
	}
	
	echo "Erregistro bat gehitu da!";
	echo "<p><a href='showQuestions.php'> Erregistroak ikusi </a>";
	
	mysqli_close($esteka);
?>
</body>
</HTML>