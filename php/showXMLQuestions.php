<style>	
	table, th, td {
		border: 1px solid black;
		font-family: Trebuchet MS;
	}
	
	th {
		background-color: #834DFF;
		color: white;
	}
</style>

<?php
	$file='../xml/questions.xml';
	$xml= simplexml_load_file($file);
	
?>
<table>
	<thead>
		<tr>
			<th>Egilea</th>
			<th>Enuntziatua</th>
			<th>Erantzun zuzena</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($xml->children() as $assessmentItem){
		echo "<tr>";
			echo "<td>" .$assessmentItem->attributes()->author."</td>";
			echo "<td>" .$assessmentItem->itemBody->p."</td>";
			echo "<td>" .$assessmentItem->correctResponse->value."</td>";
		echo "</tr>";
	}
	?>
	</tbody>
</table>
<?php
	echo "<span><a href='layout2.php?user=$userName'>HOME</a></span>";
?>
