<?php 
include("connect.php");
include('library.php');

if (empty($_SESSION['CART'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}


?>