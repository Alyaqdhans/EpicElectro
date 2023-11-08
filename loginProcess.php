<?php
include('connect.php');

$user = mysqli_real_escape_string($conn, $_POST['user']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$query = "select * from customers where cUserName = '$user' and password = password('$pass')";

$request = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark><br>\n". mysqli_error($conn));

if (mysqli_num_rows($request) == 1) {
    if (!isset($_SESSION['UID'])) {
        $customer = mysqli_fetch_assoc($request);

        session_start();
        
        $_SESSION['UID'] = $customer['cUserName'];
        $_SESSION['NAME'] = $customer['cName'];
        $_SESSION['TYPE'] = $customer['cType'];

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