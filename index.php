<html>
<head>
	<title>DOGINATOR</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<header> <h1>DOGINATOR</h1> </header>

	<main>
		<?php
			require "connection.php";
			//Get the number of the node inside the three to know which road we've taken
			$node = 1;
			$spareNode = 0;
			$questionNumber = 1;
			$nextQuestion = 2;

			if (isset($_GET['n'])) {
				$node = $_GET["n"];
			}
			if (isset($_GET['r'])) {
				$spareNode = $_GET["r"];
			}
			if (isset($_GET['np'])) {
				$questionNumber = $_GET["np"];
				$nextQuestion = $questionNumber + 1;
			}

			//If there is a spare node, it is added to the list $spareNodes
			if ($spareNode != 0) {
				session_start();
				$spareNodes = array();
				//Check if the session variable exists, that is, if we have saved any nodes in which we doubt
				if (isset($_SESSION['spareNodes'])) {
					$spareNodes = $_SESSION['spareNodes'];
					array_push($spareNodes, $spareNode);
					$_SESSION['spareNodes'] = $spareNodes;
				} else {
					array_push($spareNodes, $spareNode);
					$_SESSION['spareNodes'] = $spareNodes;
				}
			}

			//Calculete the nexts steps to follow
			$nodeYes = $node * 2;
			$nodeNo = $node * 2 + 1;
			$nodeProbablyYes = $nodeYes;
			$nodeProbablyNo = $nodeNo;

			//Get a random number between zero and one, we do it to avoid having a tendency to always travel the same path
			$random = rand(0, 1);
			$randomNode = 0;
			$oppositeRandomNode = 0;

			if ($random == 0) {
				$randomNode = $nodeNo;
				$oppositeRandomNode = $nodeYes;
			} else {
				$randomNode = $nodeYes;
				$oppositeRandomNode = $nodeNo;
			}

			$query = "SELECT text,question FROM tree WHERE node = ".$node.";";
			$text = '';
			$question = true;

			if ($result = mysqli_query($link, $query)) {
				if ($result->num_rows === 0) {
					echo 'No existe el nodo';
				}
				else {
					while ($row = mysqli_fetch_row($result)) {
						$text = $row[0];
						$question = $row[1];
					}

					echo "<h2>PREGUNTA #" . $questionNumber . "</h2>";
					if ($question == 0) { //If it's not a question is a final result
						echo "<div class='questionContainer'>";
							echo "<h2>¿Has pensado en " .$text. "?</h2>";
						echo "</div>";
						echo "<div class='answerContainer'>";
							echo "<a class='button' href='answer.php?r=1&n=" .$node. "&p=" .$text. "&np=" .$nextQuestion. "'>SÍ</a>";
							echo "<a class='button' href='answer.php?r=0&n=" .$node. "&p=" .$text. "&np=" .$nextQuestion. "'>NO</a>";
						echo "</div>";
					}
					else { //If it's a question, we ask (If in doubt, in the 'r' parameter we save the alternativa branch, it;s not value zero)
						echo "<div class='questionContainer'>";
							echo "<h2>¿Tu perro es ".$text."?</h2>";
						echo "</div>";
						echo "<div class='answerContainer'>";
							echo "<a class='button' href='index.php?n=" .$nodeYes. "&r=0&np=" .$nextQuestion. "'>SÍ</a>";
							echo "<a class='button' href='index.php?n=" .$randomNode. "&r=" .$oppositeRandomNode. "&np=" .$nextQuestion. "'>NO LO SÉ</a>";
							echo "<a class='button' href='index.php?n=" .$nodeNo. "&r=0&np=" .$nextQuestion. "'>NO</a>";
							
						echo "</div>";
						echo "<div class='answerContainer'>";
							echo "<a class='button' href='index.php?n=" .$nodeProbablyYes. "&r=" .$nodeProbablyNo. "&np=" .$nextQuestion. "'>PROBABLEMENTE</a>";
							echo "<a class='button' href='index.php?n=" .$nodeProbablyNo. "&r=" .$nodeProbablyYes. "&np=" .$nextQuestion. "'>PROBABLEMENTE NO</a>";
						echo "</div>";
					}
				}
				mysqli_free_result($result);
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