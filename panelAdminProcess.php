<?php
include('connect.php');
session_start();

if (!isset($_POST['box'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$query = "select * from customers";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

while ($data = mysqli_fetch_assoc($result)) {
    if (in_array($data['cId'], $_POST['box']) || $data['cId'] == $_SESSION['CID']) {$type = "A";}
    else {$type = "N";}

    $query = "update customers set cType = '$type' where cId = '{$data['cId']}'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

header("Location: panelAdmin.php");
?>