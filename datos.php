<html>

<head>
	<title>DOGINATOR</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>

<body>
	<header>
		<h1>DOGINATOR</h1>
	</header>

	<main>
		<?php
			//CONECTAMOS CON LA BD
			require "conexion.php";

			//HACEMOS LA CONSULTA A LA BD
			$consulta = "SELECT COUNT(5) FROM arbol WHERE pregunta = 0";
			$numero = '0';
			if ($resultado = mysqli_query($enlace, $consulta)) {
				while ($fila = mysqli_fetch_row($resultado)) {
					$numero = $fila[0];
				}
				mysqli_free_result($resultado);
			}
			echo "<h3>Personajes registrados: " . $numero . "</h3>";
			echo "<hr>";

			//-------------------------------------------------------------------
			//CONSULTA PARA VER ACIERTOS
			$consulta = "SELECT COUNT(*) FROM partida WHERE acierto = TRUE";
			$numero = '0';
			if ($resultado = mysqli_query($enlace, $consulta)) {
				while ($fila = mysqli_fetch_row($resultado)) {
					$numero 	  = $fila[0];
				}
				mysqli_free_result($resultado);
			}

			echo "<h3>Aciertos: " . $numero . "</h3>";
			echo "<hr>";

			//-------------------------------------------------------------------
			//CONSULTA PARA VER FALLOS
			$consulta = "SELECT COUNT(*) FROM partida WHERE acierto = FALSE";
			$numero = '0';

			if ($resultado = mysqli_query($enlace, $consulta)) {
				while ($fila = mysqli_fetch_row($resultado)) {
					$numero 	  = $fila[0];
				}
				mysqli_free_result($resultado);
			}

			echo "<h3>Fallos: " . $numero . "</h3>";
			echo "<hr>";

			//-------------------------------------------------------------------
			//CONSULTA PARA VER ÚLTIMOS PERSONAJES JUGADOS
			$consulta = "SELECT personaje FROM partida ORDER BY id DESC LIMIT 5";
			$nombre = '';
			echo "<h3>ÚLTIMOS PERSONAJES JUGADOS</h3>";

			if ($resultado = mysqli_query($enlace, $consulta)) {
				while ($fila = mysqli_fetch_row($resultado)) {
					$nombre 	  = $fila[0];
					echo $nombre . "<br>";
				}
				mysqli_free_result($resultado);
			}
			echo "<br>";
		?>
	</main>
	<br>
	<footer>
		<?php
			echo "<div class='contenedorRespuestas'>";
				echo "<a class='botonFooter' href='index.php?n=1&r=0'>Volver a probar</a>";
			echo "</div>";
		?>
	</footer>
</body>

</html>