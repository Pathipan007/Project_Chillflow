<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savetime_v12";

//Create connection
$conn = mysqli_connect($servername,$username,$password,$dbname);

//Check
if (!$conn){
    die("Connection failed" . mysqli_connect_error());
}
?>