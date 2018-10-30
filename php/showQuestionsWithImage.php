<style>	
	table, th, td {
    border: 1px solid black;
	}
</style>

<?php
	
	include 'dbKonfiguratu.php';

	$link = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
	// No se si esto se puede:
	//table, th, td {
    //border: 1px solid black;
	//}
	
	if($link->connect_errno){
		die( "Huts egin du konexioak MySQL-ra: (".
			$link-> connect_errno. ") " . 
			$link-> connect_error);
	}
	echo "Konexioa egin da, sortutako galderak hauek dira:" .$link->host_info;
	
	$sql = "SELECT * FROM questions";
	$result = $link->query($sql);
	
	if ($result->num_rows > 0){
		echo "<table>
				<tr>
					<th>ePosta</th>
					<th>Galdera</th>
					<th>Erantzun zuzena</th>
					<th>Erantzun okerra 1</th>
					<th>Erantzun okerra 2</th>
					<th>Erantzun okerra 3</th>
					<th>Zailtasuna</th>
					<th>Gaia</th>
				</tr>";
		while ($row = $result ->fetch_assoc()){
			echo "<tr><td>" .$row["EPOSTA"]. "</td><td>" .$row["GALDERA"]. "</td><td>" .$row["eZuzena"]. "</td><td>" .$row["eOkerra1"]. "</td><td>" .$row["eOkerra2"]. "</td><td>" .$row["eOkerra3"]. "</td><td>" .$row["ZAILTASUNA"]. "</td><td>" .$row["GAIA"]. "</td><td>";
			echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['IRUDIA'] ).'"/>';
			echo "</td></tr>";
		}
		echo "</table>";
	}else{
		echo "0 galdera";
	}	
	
	echo "<p><a href='../layout.html'> Hasiera </a>";
	
?>