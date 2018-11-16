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

	//lab03:
	$nameErr=false;
	$email =($_POST["email"]);
	if (!preg_match("^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$^",$email)) {
		$nameErr = "Sartu emaila formatu egokian";
	}
	elseif (!preg_match("^.{10}^",($_POST["galdera"]))) {
		$nameErr = "Sartu gutxienez 10 karaktereko luzeera duen galdera";
	}
	elseif (!preg_match("^[0-5]$^",($_POST["zailt"]))) {
		$nameErr = "Zailtasuna 0 eta 5 arteko zenbakia izan behar da";
	}
	elseif (empty($_POST["zuzena"]) || empty($_POST["okerra1"]) || empty($_POST["okerra2"]) || empty($_POST["okerra3"]) || empty($_POST["gaia"])){
		$nameErr = "Eremu guztiak bete behar dira";
	}

	if ($nameErr){
		echo "Formularioa ez da egokia: ";
		echo $nameErr;
	}else{
		$nameErr="Eremu guztiak egokiak dira: ";
		echo $nameErr;
	//

	$esteka = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if($esteka->connect_errno){
		die( "Huts egin du konexioak MySQL-ra: (".
			$esteka-> connect_errno. ") " .
			$esteka-> connect_error);
	}
	echo "Konexioa egin da:" .$esteka->host_info;

	$imagename=$_FILES["file-upload"]["name"];
	if (!empty($imagename)){
		$imagetmp=addslashes(file_get_contents($_FILES['file-upload']['tmp_name']));
		$sql = "INSERT INTO questions(EPOSTA,GALDERA,eZuzena,eOkerra1,eOkerra2,eOkerra3,ZAILTASUNA,GAIA,IRUDIA) VALUES ('$_POST[email]','$_POST[galdera]', '$_POST[zuzena]', '$_POST[okerra1]', '$_POST[okerra2]', '$_POST[okerra3]','$_POST[zailt]', '$_POST[gaia]', '$imagetmp')";
	}else{
		$sql = "INSERT INTO questions(EPOSTA,GALDERA,eZuzena,eOkerra1,eOkerra2,eOkerra3,ZAILTASUNA,GAIA) VALUES ('$_POST[email]','$_POST[galdera]', '$_POST[zuzena]', '$_POST[okerra1]', '$_POST[okerra2]', '$_POST[okerra3]','$_POST[zailt]', '$_POST[gaia]')";

	}

	$ema=mysqli_query($esteka, $sql);
	if (!$ema) {
		die('Errorea query-a gauzatzerakoan: ' .mysqli_error($esteka));
		echo "<p><a href='../addQuestionHTML5.html'> Sartu galdera berria! </a>";
	}

	//lab04:
	$file='../xml/questions.xml';
	$xml= simplexml_load_file($file);

	if(!$xml){
		die('Errorea xml fitxategia kargatzean. ');
		echo "<p><a href='addQuestionHTML5.php'> Sartu galdera berria! </a>";
	}

	$assessmentItem=$xml->addChild("assessmentItem");

	$assessmentItem->addAttribute('author',$_POST['email']);
	$assessmentItem->addAttribute('subject',$_POST['gaia']);

	$itemBody=$assessmentItem->addChild('itemBody');
	$itemBody->addChild('p',$_POST['galdera']);

	$correctResponse=$assessmentItem->addChild('correctResponse');
	$correctResponse->addChild('value',$_POST['zuzena']);

	$incorrectResponses=$assessmentItem->addChild('incorrectResponses');
	$incorrectResponses->addChild('value',$_POST['okerra1']);
	$incorrectResponses->addChild('value',$_POST['okerra2']);
	$incorrectResponses->addChild('value',$_POST['okerra3']);

	$xml->asXML($file);

	//lab04 haut1
	 $file='../xml/questionsTransAuto.xml';
	$xml= simplexml_load_file($file);

	if(!$xml){
		die('Errorea xml fitxategia kargatzean. ');
		echo "<p><a href='addQuestionHTML5.php'> Sartu galdera berria! </a>";
	}

	$assessmentItem=$xml->addChild("assessmentItem");

	$assessmentItem->addAttribute('author',$_POST['email']);
	$assessmentItem->addAttribute('subject',$_POST['gaia']);

	$itemBody=$assessmentItem->addChild('itemBody');
	$itemBody->addChild('p',$_POST['galdera']);

	$correctResponse=$assessmentItem->addChild('correctResponse');
	$correctResponse->addChild('value',$_POST['zuzena']);

	$incorrectResponses=$assessmentItem->addChild('incorrectResponses');
	$incorrectResponses->addChild('value',$_POST['okerra1']);
	$incorrectResponses->addChild('value',$_POST['okerra2']);
	$incorrectResponses->addChild('value',$_POST['okerra3']);

	$xml->asXML($file);
	//
	echo "<br>Erregistro bat gehitu da!";
	echo "<p><a href='showQuestions.php'> Erregistroak ikusi irudirik gabe </a>";
	echo "<p><a href='showQuestionsWithImage.php'> Erregistroak ikusi irudiekin </a>";
	echo "<p><a href='addQuestionHTML5.php'> Beste galdera bat gehitu </a>";
	echo "<p><a href='../xml/questions.xml'>Galderak.xml bistaratu</a>";

	mysqli_close($esteka);
	}
	header("Location: ./handlingQuizesAJAX.php?user=".$_GET['user']."&tabla=".$_GET['tabla']);
    ?>
	
</body>
</HTML>
