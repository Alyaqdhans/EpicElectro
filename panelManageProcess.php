<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    foreach ($_POST['box'] as $ic) {
        $query = "delete from items where iCode = '$ic'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

        if (!unlink("images/".$ic.".jpg")) { // delete image if exist
            unlink("images/".$ic.".jpg");
        }
    }
}

header("Location: panelManage.php");
?>