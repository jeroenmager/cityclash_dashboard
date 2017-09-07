<?php


$servername = "localhost";
$username = "cityclash";
$password = "cityclash123";
$dbname = "cityclash_db";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);