<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    if (mysqli_num_rows(mysqli_query($conn, "select * from delivery")) == count($_POST['box'])) {
        header('Location: error.php?ec=6'); // check if user selected all deliveries
        exit;
    }

    foreach ($_POST['box'] as $did) {
        $query = "select * from orders where dId = '$did'";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    
        if (mysqli_num_rows($result) > 0) { // update delivery's order records before delete if exist
            $delivery = mysqli_fetch_row(mysqli_query($conn, "select dId from delivery where dId != $did"));

            $query = "update orders set dId = {$delivery[0]} where dId = '$did'";
            mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        }

        $query = "delete from delivery where dId = '$did'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }
}

header("Location: panelDelivery.php");
?>