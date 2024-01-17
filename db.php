<?php
    $db_name = "flickflair";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";

    $connection = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>