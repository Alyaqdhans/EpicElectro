<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    foreach ($_POST['box'] as $ic) {
        $query = "select * from order_items where iCode = '$ic'";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

        if (mysqli_num_rows($result) > 0) { // delete order_items records if exist
            $query = "delete from order_items where iCode = '$ic'";
            mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        }

        $query = "delete from items where iCode = '$ic'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

        if (!unlink("images/".$ic.".jpg")) { // delete image if exist
            unlink("images/".$ic.".jpg");
        }
    }
}

header("Location: panelManage.php");
?>