<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

if (!empty($_POST['box'])) {
    $ids = implode(", ", $_POST['box']);

    // give admin who is in array
    $query = "update customers set cType = 'A' where cId in($ids) and cId != {$_SESSION['CID']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    // remove admin who isnt in array
    $query = "update customers set cType = 'N' where cId not in($ids) and cId != {$_SESSION['CID']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    if (mysqli_num_rows(mysqli_query($conn, "select * from customers where cType = 'A'")) == 1) {
        header('Location: error.php?ec=8'); // check if there is one admin left
        exit;
    } else {
        // when array is empty that means remove all admin except current
        $query = "update customers set cType = 'N' where cId != {$_SESSION['CID']}";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }
}

header("Location: panelAdmin.php?s");
?>