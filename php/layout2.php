<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
  </head>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  
  <body onload="userName()">

  
  <div id='page-wrap'>
		<header class='main' id='h1'>
			<?php
				$userName = $_GET['user'];
				echo "<span id=userPhp>".$userName."</span>"
			?>
			<!-- <span id="user">Logeatuta</span> -->
			<span class="right"><a href="logOut.php">Log Out</a> </span>
		<h2>Quiz: crazy questions</h2>
		</header>
		<nav class='main' id='n1' role='navigation'>
			<span><a href='layout2.php'>Home</a></span>
			<span><a href='/quizzes'>Quizzes</a></span>
			<?php
				echo "<span><a href='addQuestionHTML5.php?user=$userName'>Add Question</a></span>";
				echo "<span><a href='showQuestionsWithImage.php?user=$userName'>Show Questions</a></span>";
				echo "<span><a href='../xml/questions.xml'>XML Questions</a></span>";
				echo "<span><a href='showXMLQuestions.php'>XML Questions (PHP)</a></span>";
				echo "<span><a href='../xml/questionsTransAuto.xml'>XML Questions Taula</a></span>";
				echo "<span><a href='credits2.php?user=$userName'>Credits</a></span>";
			?>
		</nav>
		<section class="main" id="s1">
			<div>
				Quizzes and credits will be displayed in this spot in future laboratories ...
			</div>
		</section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/wsjdae/ws18'>Link GITHUB</a>
	</footer>
	</div>
	</body>
	
	<script>
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			return results[1] || 0;
		}
		function userName(){
			var user = $.urlParam("user");
			document.getElementById("user").textContent=user;
			alert("Barruan zaude");
		}
	</script>
</html>
