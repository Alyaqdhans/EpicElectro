<?php
include('connect.php');

$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$query = "select * from customers where email = '$mail' and password = password('$pass')";

$request = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <br>". mysqli_error($conn));

if (mysqli_num_rows($request) == 1) {
    if (!isset($_SESSION['UID'])) {
        $customer = mysqli_fetch_assoc($request);

        session_start();
        
        $_SESSION['MAIL'] = $customer['email'];
        $_SESSION['NAME'] = $customer['cName'];
        $_SESSION['TYPE'] = $customer['cType'];
        $_SESSION['CID'] = $customer['cId'];

        header('Location: index.php');
    } else {
        header('Location: error.php?ec=2'); //user is already logged in
        exit;
    }
} else {
    header('Location: error.php?ec=0'); //userid or pswd is wrong
    exit;
}
?>
