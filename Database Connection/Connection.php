<?php
    // Database connection parameters
    $hostname = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname   = "dbcarparksystem";

    // Create connection
    $con = new mysqli($hostname, $username, $password, $dbname); 

    // Check connection
    if ($con->connect_error) { 
        die("Connection failed: " . $con->connect_error); 
    }
?>