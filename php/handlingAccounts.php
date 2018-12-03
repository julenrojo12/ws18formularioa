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
	<script type="text/javascript">
		xhro=new XMLHttpRequest();
		xhro.onreadystatechange=function(){
			//alert(xhro.readyState);
			if((xhro.readyState==4)&&(xhro.status==200)){
				document.getElementById("erabiltzaileak").innerHTML=xhro.responseText;
			}
		}

		function erabiltzaileakBistaratu(){
			<?php
			echo "xhro.open('GET','erabiltzaileakIkusi.php', true);";
			?>
			xhro.send();
		};

	</script>
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

	<div id="erabiltzaileak" align="center">
				<?php echo "<script>erabiltzaileakBistaratu();</script>"; ?>
	</div>

<h6>*0 desblokeatuta, 1 blokeatuta</h6>

<script type="text/javascript" lenguage="javascript">

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
			}).done(function(data){
				erabiltzaileakBistaratu();
				                }
		           );
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
			}).done(function(data){
				erabiltzaileakBistaratu();
				                }
		           );
		};
	</script>
	<br>
	<span><a href='layout.php'>Home</a></span>
</div>
</body>
</html>
