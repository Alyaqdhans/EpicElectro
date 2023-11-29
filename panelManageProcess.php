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
    $query = "update items set Active = 'active' where iCode in($ids)";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    // disable who isnt in array
    $query = "update items set Active = 'disabled' where iCode not in($ids)";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    // when array is empty that means disable all
    $query = "update items set Active = 'disabled'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

header("Location: panelManage.php?s=1");
?>