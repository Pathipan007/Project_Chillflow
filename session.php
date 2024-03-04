<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chillflow_time";

    //Create connection
    $db = mysqli_connect($servername,$username,$password,$dbname);

    //Check
    if (!$db){
        die("Connection failed" . mysqli_connect_error());
    }
?>