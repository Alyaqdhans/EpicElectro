<?php
include("connect.php");
session_start();

if (!isset($_POST['password'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$pass = mysqli_real_escape_string($conn, $_POST['password']);

$query = "select * from customers where password = password('$pass') and cId = {$_SESSION['CID']}";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
if (mysqli_num_rows($result) == 0) {
    header('Location: error.php?ec=5&type=d'); // current password is incorrect
    exit;
}

$query = "update customers set";
$query .= " Active = 'disabled'";
$query .= " where cId = '{$_SESSION['CID']}'";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));


header("location: logout.php");
?>