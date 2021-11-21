<html>
<head>
	<title>Doginator</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<header> <h1>Doginator</h1> </header>

	<main>
		<?php
			require "connection.php";
			//Collect the data from the URL
			$answer = $_GET["r"];
			$node = $_GET["n"];
			$previousName = $_GET["p"];
			$questionNumber = $_GET["np"];

			function replyForm($n, $p){
				echo "<div class='questionContainer'>";
					echo "<textarea id='node' name='node' form='replyForm' placeholder='nombre' style='display:none;'>" .$n. "</textarea>";
					echo "<textarea id='previousName' name='previousName' form='replyForm' placeholder='nombre' style='display:none;'>" .$p. "</textarea>";

					echo "<h2>¿En cuál perro habías pensado?</h2>";
					echo "<textarea class='input' id='name' name='name' form='replyForm' placeholder='Raza'></textarea>";
					echo "<h2>¿Qué característica tiene este perro que no tenga un " .$p. "?</h2>";
					echo "<textarea class='input' id='features' name='features' form='replyForm' placeholder='Característica'></textarea>";

					echo "<form action='create.php' id='replyForm' method='POST' >";
						echo "<button class='buttonForm' type='submit' name='send'>ENVIAR</button>";
					echo "</form>";
				echo "</div>";
			}

			if ($answer == 0) { // Failed
				session_start();
				$spareNodes = array();	
				//Check if the session variable exists, that is, if we have saved any nodes in which we doubt
				if (isset($_SESSION['spareNodes'])) {
					$spareNodes = $_SESSION['spareNodes'];
					$size = count($spareNodes);
					if ($size != 0) {
						$nodoReview = array_pop($spareNodes);	//Get the last element (like a stack)
						$_SESSION['spareNodes'] = $spareNodes;
						header("Location:index.php?n=".$nodoReview."&r=0&np=".$questionNumber.""); //Back to nodeReview
					} else {
						replyForm($node, $previousName);
					}
				} 
				else {
					replyForm($node, $previousName);
				}
			}
			else { 	//Save the hit
				$query = "INSERT INTO partida (personaje,acierto) VALUES('".$previousName."',TRUE);";
				mysqli_query($link, $query);

				session_start(); //Delete the session variable with a new intantiation
				$emptyArray = array();
				if (isset($_SESSION['spareNodes'])) {
					$_SESSION['spareNodes'] = $emptyArray;
				}
				echo "<h2>¡GRACIAS POR JUGAR A DOGINATOR!</h2>";
				echo "<img src='img/cheems.png' style='width:330px; height:440px'>";
			}
		?>
	</main>

	<footer>
		<?php
			echo "<div class='answerContainer'>";
				echo "<a class='buttonFooter' href='index.php?n=1&r=0'>Volver a probar</a>";
				echo "<a class='buttonFooter' href='game_data.php'>Datos de Doginator</a>";
			echo "</div>";
		?>
	</footer>
</body>
</html>