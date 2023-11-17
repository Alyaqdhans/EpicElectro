<?php
include('connect.php');
session_start();

if (!isset($_SESSION['TYPE'])) {
    header('Location: error.php?ec=1'); // login required
    exit;
} else {
    if ($_SESSION['TYPE'] != 'A') {
        header('Location: error.php?ec=3'); // need admin
        exit;
    }
}

if (!empty($_POST['box'])) {
    foreach ($_POST['box'] as $id) {
        $query = "delete from customers where cId = '$id'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }
}

header("Location: panelDelete.php");
?>