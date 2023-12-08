<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

if (!empty($_POST['box'])) {
    $ids = implode(", ", $_POST['box']);

    // activate who is in array
    $query = "update delivery set Active = 'active' where dId in($ids)";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    // disable who isnt in array
    $query = "update delivery set Active = 'disabled' where dId not in($ids)";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    header('Location: error.php?ec=6&type=c'); // check if user disable all couriers
    exit;
}

header("Location: panelDelivery.php?s");
?>