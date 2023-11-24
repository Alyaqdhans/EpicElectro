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

$in_cart = false; // check if item already exist
if (array_key_exists($_POST['ic'], $_SESSION['CART'])) {
    $_SESSION['CART'][$_POST['ic']]['qty'] += $_POST['qty'];
    $in_cart = true;
}

if ($in_cart == false) { // if not add new item
    $_SESSION['CART'][$_POST['ic']] = ["price" => $_POST['price'], "qty" => $_POST['qty']];
}

header("Location: index.php#{$_POST['ic']}");
?>