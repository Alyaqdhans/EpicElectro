<?php
include('library.php');
include('connect.php');

if (!isset($_POST['name'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

$errors = [];

$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

if (preg_match("/^[0-9]+$/", $name)) {
    $errors[] = "Please enter a valid name";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email";
}

if ($phone < 1 || !preg_match("/^[0-9]{8}$/", $phone)) {
    $errors[] = "Please enter a valid phone number";
}


if (count($errors) > 0) {
    DisplayErrors();
    exit;
}


$query = "insert into suppliers (sName, sPhone, sEmail, sAddress)";
$query .= " values ('$name', '$phone', '$email', '$address')";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

header("Location: panelSupplier.php?s");
?>