<?php
session_start();
if (!isset($_SESSION['CART'])) {
    header('Location: error.php?ec=1'); // login required
    exit;
}

if (!isset($_POST['ic'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$in_array = false; // check if item already exist
foreach ($_SESSION['CART'] as $key => $item) {
    if (in_array($_POST['ic'], $item)) {
        $_SESSION['CART'][$key]['qty'] += $_POST['qty'];
        $in_array = true;
    }
}

if (!$in_array) {
    array_push($_SESSION['CART'], ["ic" => $_POST['ic'], "price" => $_POST['price'], "qty" => $_POST['qty']]);
}

header('Location: index.php');
?>