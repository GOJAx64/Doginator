<?php
    $mysql_host = "localhost";
    $mysql_usuer = "root";
    $mysql_password = "";
    $mysql_DB = "doginator";
    $link = mysqli_connect($mysql_host, $mysql_usuer, $mysql_password, $mysql_DB);

    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($link,"utf8");
?>
