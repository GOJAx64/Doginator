<?php
    $host = "localhost";
    $usuer = "root";
    $password = "";
    $DB = "doginator";
    $link = mysqli_connect($host, $usuer, $password, $DB);

    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($link,"utf8");
?>
