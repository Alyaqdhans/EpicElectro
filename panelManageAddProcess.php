<?php
include('library.php');
include('connect.php');

if (!isset($_POST['code'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$errors = [];

if ($_POST['qty'] < 0) {$errors[] = "Quantity cannot be less than zero";}

if ($_POST['cost'] < 1) {$errors[] = "Cost cannot be less than one";}

if ($_POST['price'] < 1) {$errors[] = "Price cannot be less than one";}

if (count($errors) == 0) {
    $query = "update items set";
    $query .= " iSupplierId = '{$_POST['supplier']}',";
    $query .= " iQty = '{$_POST['qty']}',";
    $query .= " iCost = '{$_POST['cost']}',";
    $query .= " iPrice = '{$_POST['price']}'";
    $query .= " where iCode = {$_POST['code']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    if ($_POST['qty'] > $_POST['prevqty']) { // update date when added new supply
        $date = date('Y-m-d');
        $query = "update items set iLastPurchasedDate = '$date' where iCode = '{$_POST['code']}'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    }

    header("Location: panelManage.php?s=1");
} else {
    DisplayErrors();
}
?>