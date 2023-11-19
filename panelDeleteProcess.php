<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

if (!empty($_POST['box'])) {
    foreach ($_POST['box'] as $id) {
        $query = "select * from orders where cId = '$id'";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $query = "delete from order_items where orderID = '{$data['orderId']}'"; // delete order_items records if exist
                mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
            }

            $query = "delete from orders where cId = '$id'"; // delete order records if exist
            mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        }

        $query = "delete from customers where cId = '$id'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }
}

header("Location: panelDelete.php");
?>