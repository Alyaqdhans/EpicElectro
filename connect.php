<?php
$hostname = "localhost";
$user = "root";
$pass = "";
$db = "epicelectro";
$conn = mysqli_connect($hostname, $user, $pass, $db) or die("Unable to connect to database");

date_default_timezone_set('Asia/Muscat');
?>