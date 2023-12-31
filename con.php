<?php

    $host = "localhost";
    $usern = "root"; 
    $dbpass = "password";
    $db = "login";

    $con = mysqli_connect($host, $usern, $dbpass, $db);

    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
       }
?>