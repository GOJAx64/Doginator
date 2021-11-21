<?php
    require "connection.php";

    //Collect the parameters by URL
    $node = $_POST['node'];
    $name = $_POST['name'];
    $features = $_POST['features'];
    $previousName = $_POST['previousName'];

    //New nodes
    $leftChild = $node * 2;
    $rightChild = $node * 2 + 1;
    //$NombreHijoI = $name;
    //$NombreHijoD = $previousName;

    //Save new data ang record game
    $query = "INSERT INTO arbol (nodo,texto,pregunta) VALUES('".$leftChild."','".$name."',FALSE);";
    mysqli_query($link, $query);

    $query = "INSERT INTO arbol (nodo,texto,pregunta) VALUES('".$rightChild."','".$previousName."',FALSE);";
    mysqli_query($link, $query);

    $query = "UPDATE arbol SET texto = '".$features."',pregunta = TRUE WHERE nodo = '".$node."';";
    mysqli_query($link, $query);

    $query = "INSERT INTO partida (personaje,acierto) VALUES('".$name."',FALSE);";
    mysqli_query($link, $query);

    //Return index page
    header("Location:index.php?n=1&r=0");
?>