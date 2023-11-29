<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    $ids = implode(", ", $_POST['box']);

    // activate who is in array
    $query = "update customers set Active = 'active' where cId in($ids) and cType != 'A'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    // disable who isnt in array
    $query = "update customers set Active = 'disabled' where cId not in($ids) and cType != 'A'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    // when array is empty that means disable all
    $query = "update customers set Active = 'disabled' where cType != 'A'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

header("Location: panelActive.php?s=1");
?>