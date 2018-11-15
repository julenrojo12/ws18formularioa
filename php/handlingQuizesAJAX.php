<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>ADD QUESTION</title>
	<link rel='stylesheet' type='text/css' href='../styles/caja.css' />
	<script type="text/javascript" lenguage="javascript">
		xhro=new XMLHttpRequest();
		xhro.onreadystatechange=function(){
			//alert(xhro.readyState);
			if((xhro.readyState==4)&&(xhro.status==200)){
				document.getElementById("txtHint").innerHTML=xhro.responseText;
			}
		}
		function galderakIkusi(){
		<?php
			echo "xhro.open('GET','showXMLQuestionsByAuthor.php?user=".$_GET['user']."', true);";
		?>
			xhro.send();
			
		}

	</script>

	<script>
function addQuestion() {
	<?php
	include 'dbKonfiguratu.php';
	

	//lab03:
	$nameErr=false;
	$email =($_POST["email"]);
	if (!preg_match("^.{10}^",($_POST["galdera"]))) {
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
		
	//
	
	$esteka = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	
	if($esteka->connect_errno){
		die( "Huts egin du konexioak MySQL-ra: (".
			$esteka-> connect_errno. ") " . 
			$esteka-> connect_error);
	}

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
	}
	
	//lab04:
	$file='../xml/questions.xml';
	$xml= simplexml_load_file($file);
	
	if(!$xml){
		die('Errorea xml fitxategia kargatzean. ');
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

	 $file='../xml/questionsTransAuto.xml';
	$xml= simplexml_load_file($file);
	
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
	mysqli_close($esteka);
	
	}
	?>
}

</script>

</head>

<body>
	
	<?php
		if($_GET['tabla']=="true") {
			echo "<script>galderakIkusi();</script>";
		}
		echo "Erabiltzaile izena: <span>".$_GET['user']."</span>";
	?>
	<div class="cajaHandia">

		<div>
			<br>
			<?php
				echo "<form id='galderenF' name='galderenF' action='handlingQuizesAJAX.php?user=".$_GET['user']."&tabla=true' onsubmit='addQuestion()' method='POST' enctype='multipart/form-data'>";
			?>
				<input type='button' name='show' value='Bistaratu nire galderak' onClick="galderakIkusi()">
				<input type='submit' name='add' value='Add Question'>
				<br>
				<br>
				<?php
					echo "Egilearen eposta(*): <input type='email' readonly name='email' id='email' required value=".$_GET['user']."> <br>";
				?>
				Galderaren testua(*): <input type="text" name="galdera" id="galdera" required pattern="[^']{10,}?$" oninvalid="this.setCustomValidity('Sartu gutxienez 10 karaktereko luzeera duen galdera')" oninput="setCustomValidity('')"><br>
				Erantzun zuzena(*): <input type="text" name="zuzena" id="zuzena" required oninvalid="this.setCustomValidity('Erantzun zuzena ezin da hutsik utzi.')" oninput="setCustomValidity('')"><br>
				Erantzun okerra #1(*): <input type="text" name="okerra1" id="okerra1" required oninvalid="this.setCustomValidity('Erantzun okerra ezin da hutsik utzi.')" oninput="setCustomValidity('')"><br>
				Erantzun okerra #2(*): <input type="text" name="okerra2" id="okerra2" required oninvalid="this.setCustomValidity('Erantzun okerra ezin da hutsik utzi.')" oninput="setCustomValidity('')"><br>
				Erantzun okerra #3(*): <input type="text" name="okerra3" id="okerra3" required oninvalid="this.setCustomValidity('Erantzun okerra ezin da hutsik utzi.')" oninput="setCustomValidity('')"><br>
				Galderaren zailtasuna(*): <input type="text" name="zailt" id="zailt" required pattern="^[0-5]$" oninvalid="this.setCustomValidity('Zailtasuna 0 eta 5 arteko zenbakia izan behar da')" oninput="setCustomValidity('')"><br>
				Galderaren gai-arloa(*): <input type="text" name="gaia" id="gaia" required oninvalid="this.setCustomValidity('Gaia ezin da hutsik utzi.')" oninput="setCustomValidity('')"><br>
				Galderarekin zer-ikusia duen irudia:
							<div id="divMain">
								<div id="divInputLoad">
									<div id="divFileUpload">
										<input id="file-upload" name="file-upload" type="file" accept="image/*" />
									</div>

									<div id="file-preview-zone">
									</div>
								</div>
							</div>
							<br>
				 <input type="reset" value="Ezabatu" />			
			</form>
		</div>
	
		<div>
			<br>
			<br>
			<div id="txtHint" align="center">
				<p>Questions...</p>
			</div>
		</div>
		<div>
			<?php
				echo "<br>";
				echo "<span><a href='handlingQuizesAJAX.php?user=".$_GET['user']."&tabla=false'>Refresh</a></span>";
			?>
		</div>
	</div><!--cajaHandia itxi-->
	<div align="center">
		<?php
			echo "<span><a href='credits2.php?user=".$_GET['user']."'>Credits</a></span>";
			echo "&nbsp";
			echo "<span><a href='layout2.php?user=".$_GET['user']."'>Home</a></span>";
		?>
	</div>
	
</body>
</html>