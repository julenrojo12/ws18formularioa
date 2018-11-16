<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>ADD QUESTION</title>
	<link rel='stylesheet' type='text/css' href='../styles/caja.css' />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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

		$("#galderenF").submit(function galderakGehitu(event){
			event.preventDefault(); //prevent default action 
			var post_url = $(this).attr("action"); //get form action url
			var request_method = $(this).attr("method"); //get form GET/POST method
			var form_data = $(this).serialize();
			
			$.ajax(
		    {
				url : post_url,
				type: request_method,
				data : form_data,
				success: function(data){$('#txtHint').fadeIn().html(data);},
				error: function(){$('#txtHint').fadeIn().html('<p class="error"><strong> Zerbitzariak ez duela erantzuten dirudi</p>');}
		    }
		           ).done(function(data){
				galderakIkusi();
				                         }
		           );
		});
		//hautazkoa
		setInterval(function galderakZenbatu(){

			$.ajax({    //create an ajax request to display.php
		        type: "GET",
		        url: "display.php",             
		        dataType: "html",   //expect html to be returned                
		        success: function(response){                    
		            $("#guztiak").html(response); 
        		}
        	})	
        	$.ajax({    //create an ajax request to display.php
		        type: "GET",
		        <?php
		        echo "url: 'display2.php?user=".$_GET['user']."',"             
		        ?>
		        dataType: "html",   //expect html to be returned                
		        success: function(response){                    
		            $("#nireak").html(response); 
        		}
        	})	
		},20000);		
		//hautazko amaiera
 

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
		<div id="demo"></div>
		<div>
			<br>
			<?php
			echo "<form id='galderenF' name='galderenF' action='addQuestionWithImageAJAX.php?user=".$_GET['user']."&tabla=true' method='POST' enctype='multipart/form-data'>";
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
		<!--hautazkoa-->
			<br>
			<div id="galderakop">
				<?php
					echo 'Datu basean zureak diren galderak: <span id="nireak"></span>, dauden galdera guztiak: <span id="guztiak"></span>   <br>' ;
				?>
			</div>

		<!--hautazkoa amaiera-->
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