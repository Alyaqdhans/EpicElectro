<?php
include('library.php');
include('connect.php');

if (!isset($_POST['code'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

$errors = [];

$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

if ($phone < 1 || !preg_match("/^[0-9]{8}$/", $phone)) {
    $errors[] = "Please enter a valid phone number";
}


if (count($errors) > 0) {
    DisplayErrors();
    exit;
}


$query = "update delivery set";
$query .= " company_name = '$name',";
$query .= " dPhone = '$phone'";
$query .= " where dId = {$_POST['code']}";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

header("Location: panelDelivery.php?s");
?>