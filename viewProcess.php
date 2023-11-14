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

array_push($_SESSION['CART'], ["ic" => $_POST['ic'], "price" => $_POST['price'], "qty" => $_POST['qty']]);
header('Location: index.php');
?>