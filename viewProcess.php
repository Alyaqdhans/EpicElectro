<?php
session_start();
if (!isset($_SESSION['CART'])) {
    header('Location: error.php?ec=1'); // login required
    exit;
}

array_push($_SESSION['CART'], ["ic" => $_POST['ic'], "price" => $_POST['price'], "qty" => $_POST['qty']]);
header('Location: index.php');
?>