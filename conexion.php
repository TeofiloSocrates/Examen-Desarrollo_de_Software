<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bdtutoria";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to connect!");
}