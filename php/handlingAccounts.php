<!DOCTYPE html>
<?php
  session_start();    
  if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit(); // <-- terminates the current script
  }
// close the php tag and write your HTML :)
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Handling Accounts</title>
    <link rel="stylesheet" type="text/css" href="../styles/caja.css">
	<style>	
	table, th, td {
    border: 1px solid black;
	}
	#irudia{
		height: 100px;
	}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<body>
<div class="cajaHandia">
	<form id="blokForm" name="BlokForm" action="" onsubmit="return true;" method="POST" enctype="multipart/form-data"> 
		<div>
			<p>Beheko listan agertzen den erabiltzaile baten eposta sartu blokeatzeko edo ezabatzeko:</p>
			<input type="text" value="xxxxx000@ikasle.ehu.eus" onClick="this.value=''" id="posta" name="posta"/>
			<input type="button" value="Blokeatu" id="blokeatu" onclick="return blokeatzen();"> 
			<input type="button" value="Ezabatu" id="ezabatu" onclick="return ezabatzen();">
		</div>
	</form>
<br>
	<span id="mensaje"></span>
<br>
	<?php
	include 'dbKonfiguratu.php';
		echo "<br>";

		$link = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
		if($link->connect_errno){
			die( "Huts egin du konexioak MySQL-ra: (".
				$link-> connect_errno. ") " . 
				$link-> connect_error);
		}
		$sql = "SELECT * FROM erregistratuak";
		$result = $link->query($sql);
		
		if ($result->num_rows > 0){
			echo "<table id='tblData'>
					<tr>
						<th>ePosta</th>
						<th>Deitura</th>
						<th>Pasahitza</th>
						<th>Egoera(*)</th>
						<th>Argazkia</th>				
					</tr>";
			while ($row = $result ->fetch_assoc()){
				echo "<tr><td>" .$row["EPOSTA"]. "</td><td>" .$row["DEITURAK"]. "</td><td>" .$row["PASAHITZA"]. "</td><td>" .$row["BLOKEATUTA"]. "</td><td>";
				echo '<img id="irudia" src="data:image/jpeg;base64,'.base64_encode( $row['ARGAZKIA'] ).'"/>';
				echo "</td></tr>";
			}
			echo "</table>";
		}else{
			echo "0 erabiltzaile";
		}	
	?>

<h6>*0 desblokeatuta, 1 blokeatuta</h6>

<script>
		function ezabatzen(){
			var emailposta =  $('input[name="posta"]');
			var data = 'posta=' + emailposta.val();
			$.ajax({
				type: "POST",
				cache: false,
				url: "ezabatuErabil.php",
				data: data,
				dataType: "html",
				error: function(ts){alert(ts.responseText)},
				success: function(response){
					$("#mensaje").html(response);
				}
			})
		};	

		function blokeatzen(){
			var emailposta =  $('input[name="posta"]');
			var data = 'posta=' + emailposta.val();
			$.ajax({
				type: "POST",
				cache: false,
				url: "blokeatuErabil.php",
				data: data,
				dataType: "html",
				error: function(ts){alert(ts.responseText)},
				success: function(response){
					$("#mensaje").html(response);
				}
			})
		};
	</script>
	<input type="button" value="Birkargatu" onClick="window.location.reload()">
	<br>
	<span><a href='layout.php'>Home</a></span>
</div>
</body>
</html>
