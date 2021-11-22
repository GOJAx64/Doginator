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
    $query = "INSERT INTO tree (node,text,question) VALUES('".$leftChild."','".$name."',FALSE);";
    mysqli_query($link, $query);

    $query = "INSERT INTO tree (node,text,question)  VALUES('".$rightChild."','".$previousName."',FALSE);";
    mysqli_query($link, $query);

    $query = "UPDATE tree SET text = '".$features."',question = TRUE WHERE node = '".$node."';";
    mysqli_query($link, $query);

    $query = "INSERT INTO game (personage,hit) VALUES('".$name."',FALSE);";
    mysqli_query($link, $query);

    //Return index page
    header("Location:index.php?n=1&r=0");
?>