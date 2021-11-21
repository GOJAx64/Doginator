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

			//Registered characters
			$query = "SELECT COUNT(*) FROM arbol WHERE pregunta = 0";
			$number = '0';
			if ($result = mysqli_query($link, $query)) {
				while ($row = mysqli_fetch_row($result)) {
					$number = $row[0];
				}
				mysqli_free_result($result);
			}
			echo "<h3>Personajes registrados: ".$number."</h3>";
			echo "<hr>";

			//Hits
			$query = "SELECT COUNT(*) FROM partida WHERE acierto = TRUE";
			$number = '0';
			if ($result = mysqli_query($link, $query)) {
				while ($row = mysqli_fetch_row($result)) {
					$number = $row[0];
				}
				mysqli_free_result($result);
			}
			echo "<h3>Aciertos: ".$number."</h3>";
			echo "<hr>";

			//Failures
			$query = "SELECT COUNT(*) FROM partida WHERE acierto = FALSE";
			$number = '0';
			if ($result = mysqli_query($link, $query)) {
				while ($row = mysqli_fetch_row($result)) {
					$number = $row[0];
				}
				mysqli_free_result($result);
			}
			echo "<h3>Fallos: ".$number."</h3>";
			echo "<hr>";

			//Last characters played
			$query = "SELECT personaje FROM partida ORDER BY id DESC LIMIT 5";
			$name = '';
			echo "<h3>ÚLTIMOS PERSONAJES JUGADOS</h3>";
			if ($result = mysqli_query($link, $query)) {
				while ($row = mysqli_fetch_row($result)) {
					$name = $row[0];
					echo $name."<br>";
				}
				mysqli_free_result($result);
			}
			echo "<br>";
		?>
	</main>

	<footer>
		<?php
			echo "<div class='answerContainer'>";
				echo "<a class='buttonFooter' href='index.php?n=1&r=0'>Volver a probar</a>";
			echo "</div>";
		?>
	</footer>
</body>
</html>