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

	$imagename=$_FILES["file-upload"]["name"];
	$imagetmp=addslashes(file_get_contents($_FILES['file-upload']['tmp_name']));
	$sql = "INSERT INTO questions(EPOSTA,GALDERA,eZuzena,eOkerra1,eOkerra2,eOkerra3,ZAILTASUNA,GAIA,IRUDIA) VALUES ('$_POST[email]','$_POST[galdera]', '$_POST[zuzena]', '$_POST[okerra1]', '$_POST[okerra2]', '$_POST[okerra3]','$_POST[zailt]', '$_POST[gaia]', '$imagetmp')";
	
	$ema=mysqli_query($esteka, $sql);
	if (!$ema) {
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		echo "<p><a href='../addQuestionHTML5.html'> Sartu galdera berria! </a>";
	}
	
	echo "Erregistro bat gehitu da!";
	echo "<p><a href='showQuestions.php'> Erregistroak ikusi irudirik gabe </a>";
	echo "<p><a href='showQuestionsWithImage.php'> Erregistroak ikusi irudiekin </a>";
	echo "<p><a href='../addQuestionHTML5.html'> Beste galdera bat gehitu </a>";
	
	mysqli_close($esteka);
?>
</body>
</HTML>