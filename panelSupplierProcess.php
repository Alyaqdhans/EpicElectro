<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    foreach ($_POST['box'] as $sid) {
        $query = "select * from items where iSupplierId = '$sid'";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    
        if (mysqli_num_rows($result) > 0) { // update supplier item records before delete
            $supplier = mysqli_fetch_row(mysqli_query($conn, "select sId from suppliers"));

            $query = "update items set iSupplierId = {$supplier[0]} where iSupplierId = '$sid'";
            mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        }

        $query = "delete from suppliers where sId = '$sid'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }
}

header("Location: panelSupplier.php");
?>