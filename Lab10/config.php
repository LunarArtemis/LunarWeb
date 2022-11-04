<?php
    // $host = 'localhost';
    // $DBUser = "root";
    // $DBPassword = "";
    // $db = 'cp251db';

    $host = "10.1.3.40";
    $DBUser= "64102010080";
    $DBPassword= "64102010080";
    $db = "64102010080";

    $conn = new mysqli($host, $DBUser, $DBPassword, $db);

    if(!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        echo("<script>console.log('Connected successfully');</script>");
    }
?>