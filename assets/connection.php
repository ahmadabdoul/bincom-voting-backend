<?php

$servername = 'localhost';
$username = "root";
$password = "";
$dbname = "bincomphptest";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Error connecting to mysql server");
