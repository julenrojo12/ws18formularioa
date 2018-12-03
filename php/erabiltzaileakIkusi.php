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