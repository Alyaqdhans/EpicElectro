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


$query = "select dId from delivery where Active = 'active'";
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


$items = "";
foreach ($_SESSION['CART'] as $key => $item) {
    $name = mysqli_fetch_row(mysqli_query($conn, "select iDesc from items where iCode = {$key}"));
    $items .= "{$item['qty']} &times; {$name[0]}<br>"; // store item info for receipt

    $qty = mysqli_fetch_row(mysqli_query($conn, "select iQty from items where iCode = {$key}"));
    $sold = mysqli_fetch_row(mysqli_query($conn, "select iSold from items where iCode = {$key}"));

    $query = "update items set iSold = ". $sold[0] + $item['qty'] . ","; // update sold value
    $query .= " iQty = ". $qty[0] - $item['qty']; // update quantity value
    $query .= " where iCode = {$key}";
    mysqli_query($conn, $query);

    $query = "insert into order_items(orderID, iCode, quantity)"; // add item to the order
    $query .= " values('$orderId', '{$key}', {$item['qty']})";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    unset($_SESSION['CART'][$key]); // delete item from cart
}


// sending receipt email to the customer
$total = number_format($_POST['total']);
$deliver = mysqli_fetch_row(mysqli_query($conn, "select company_name from delivery where dId = {$DID}"))[0];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP(); 
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;                               //Enable SMTP authentication
$mail->Username   = 'epicelectro.store@gmail.com';                     //SMTP username
$mail->Password   = 'xsxgnggiwwkmgmic';                               //SMTP password

//Recipients
$mail->setFrom('epicelectro.store@gmail.com');
$mail->addAddress($_SESSION['MAIL']);     //Add a recipient
$mail->addCC('epicelectro.store@gmail.com');

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = "EpicElectro Receipt $orderId";
$mail->Body    = "
<html>
    <body>
        <h1>Thank you for your recent purchase from EpicElectro</h1>

        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h2 style='margin: 0;'>
            Order No: $orderId
            </h2>
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
            Delivery By:
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

$mail->send();



header("Location: cartReceipt.php?oi=$orderId");
?>