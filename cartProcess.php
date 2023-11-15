<?php 
include("connect.php");
include('library.php');

session_start();
if (empty($_SESSION['CART'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}



header('Location: index.php');
?>