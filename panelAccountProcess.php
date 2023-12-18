<?php
include('connect.php');
session_start();

if (!isset($_POST['check'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

$result = mysqli_query($conn, "select * from customers where cId = '{$_SESSION['CID']}'");
$data = mysqli_fetch_assoc($result);
// check if user still have admin rights and account enabled
if ($data['cType'] != 'A' || $data['Active'] != 'active') {
    session_unset(); // log him out if not
    session_destroy();
    header('Location: error.php?ec=8'); // lost rights
    exit;
}

if (!empty($_POST['box'])) {
    $ids = implode(", ", $_POST['box']);

    // activate who is in array
    $query = "update customers set Active = 'active' where cId in($ids)";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    // disable who isnt in array except admins and current user
    $query = "update customers set Active = 'disabled' where cId not in($ids) and cType != 'A' and cId != {$_SESSION['CID']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    // when array is empty that means disable all except admins
    $query = "update customers set Active = 'disabled' where cType != 'A'";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

// handling user type changes except current user
foreach($_POST['type'] as $value) {
    $userID = explode(' ', $value)[0];
    $userType = explode(' ', $value)[1];

    $query = "update customers set cType = '$userType' where cId = '$userID' and cId != {$_SESSION['CID']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
}

header("Location: panelAccount.php?s");
?>