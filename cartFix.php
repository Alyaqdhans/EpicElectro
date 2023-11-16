<?php
if (!isset($_GET['ic'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

header("Location: cart.php#{$_GET['ic']}"); // to delete the post array for cart
?>