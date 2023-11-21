<?php 
include("connect.php");
include("library.php");
session_start();

if (!isset($_POST['total'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}


foreach ($_SESSION['CART'] as $key => $item) {
    $query = "select * from items where iCode = {$item['ic']}";
    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    $data = mysqli_fetch_assoc($result);

    if ($item['qty'] > $data['iQty']) {
        header("Location: error.php?ec=7&ic={$item['ic']}"); // check if there are items more than the available
        exit;
    }
}


$query = "select dId from delivery";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
$allDID = mysqli_fetch_all($result);
$DID = array_rand($allDID); // get random delivery company from database

$date = date('Y-m-d');
$query = "insert into orders(cId, dId, orderDate, totalPrice)"; // make new order
$query .= " values('{$_SESSION['CID']}', '$DID', '$date', '{$_POST['total']}')";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));


 // we get the new order id
$orderId = $conn->insert_id;


foreach ($_SESSION['CART'] as $key => $item) {
    
}


header('Location: index.php');
?>