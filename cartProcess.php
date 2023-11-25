<?php 
include("connect.php");
include("library.php");
session_start();

if (!isset($_POST['total'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}


foreach ($_SESSION['CART'] as $key => $item) {
    $query = "select * from items where iCode = {$key}";
    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    $data = mysqli_fetch_assoc($result);

    if ($item['qty'] > $data['iQty']) {
        header("Location: error.php?ec=7&ic={$key}"); // check if there are items in cart more than the available
        exit;
    }
}


$query = "select dId from delivery";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
$allDID = mysqli_fetch_all($result);
$DID = rand(0, count($allDID)-1); // get random delivery index
$DID = $allDID[$DID][0]; // get delivery id

$date = date('Y-m-d');
$query = "insert into orders(cId, dId, orderDate, totalPrice)"; // make new order
$query .= " values('{$_SESSION['CID']}', '$DID', '$date', '{$_POST['total']}')";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));


// we get the new order id
$orderId = $conn->insert_id;


$items = [];
foreach ($_SESSION['CART'] as $key => $item) {
    $name = mysqli_fetch_row(mysqli_query($conn, "select iDesc from items where iCode = {$key}"));
    $items[] = $name[0]; // store item names for receipt

    $qty = mysqli_fetch_row(mysqli_query($conn, "select iQty from items where iCode = {$key}"));

    $query = "update items set iSold = {$item['qty']},";
    $query .= " iQty = ". $qty[0] - $item['qty']; // update qty and sold values
    $query .= " where iCode = {$key}";
    mysqli_query($conn, $query);

    $query = "insert into order_items(orderID, iCode, quantity)"; // add item to the order
    $query .= " values('$orderId', '{$key}', {$item['qty']})";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    unset($_SESSION['CART'][$key]); // delete item from cart
}


// sending receipt email to the customer
$items = implode(", ", $items);
$total = number_format($_POST['total']);
$deliver = mysqli_fetch_row(mysqli_query($conn, "select company_name from delivery where dId = {$DID}"))[0];

$to = $_SESSION['MAIL'];
$subject = "EpicElectro Receipt ($orderId)";
$receipt = "
<html>
    <body>
        <h1>Thank you for your recent purchase from EpicElectro</h1>

        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h1 style='margin: 0;'>
            Order No: $orderId
            </h1>
            </legend>

            <h2 style='margin-bottom: .5rem;'>
            Items:
            </h2>
            <h3 style='margin-top: 0;'>
            $items
            </h3>

            <h2 style='margin-bottom: .5rem;'>
            Total Cost:
            </h2>
            <h3 style='margin-top: 0;'>
            $total OMR
            </h3>

            <h2 style='margin-bottom: .5rem;'>
            Delivered By:
            </h2>
            <h3 style='margin-top: 0;'>
            $deliver
            </h3>
        </fieldset>

        <h3>Your order will be delivered in 3 - 7 bussiness days,
        if you want more details about the order go to `Orders` tab in the website.</h3>
    </body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: s26s2025@nct.edu.om" . "\r\n";
// $headers .= "Cc: s26s2025@nct.edu.om" . "\r\n";

mail($to, $subject, $receipt, $headers);



header("Location: cartReceipt.php?oi=$orderId");
?>