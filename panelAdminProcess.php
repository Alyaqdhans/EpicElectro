<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$query = "select * from customers where cId != {$_SESSION['CID']}";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

while ($data = mysqli_fetch_assoc($result)) {
    if (!empty($_POST['box'])) {
        if (in_array($data['cId'], $_POST['box'])) {$type = "A";}
        else {$type = "N";}
    } else {
        $type = "N";
    }

    $query = "update customers set cType = '$type' where cId = '{$data['cId']}'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

header("Location: panelAdmin.php");
?>