<?php
include("connect.php");
include('library.php');

if (!isset($_POST['name'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$errors = [];

$name = mysqli_real_escape_string($conn, $_POST['name']);
$mail = mysqli_real_escape_string($conn, $_POST['email']);
$pass = mysqli_real_escape_string($conn, $_POST['password']);
$pass2 = mysqli_real_escape_string($conn, $_POST['passwordConfirm']);
$number = mysqli_real_escape_string($conn, $_POST['pnumber']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

if (!preg_match("/^[a-zA-Z\-\s]+$/", $name)) {
    $errors[] = "Please enter a valid name";
}

if ($pass != $pass2) {
    $errors[] = "Please make sure you typed the same password";
} else if (strlen($pass) < 8) {
    $errors[] = "Please make sure your password contains 8 or more characters";
}

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email";
}

if ($number < 1 || !preg_match("/^[9|7][0-9]{7}$/", $number)) {
    $errors[] = "Please enter a valid phone number";
}

if (count($errors) == 0) {
    $query = "select * from customers where email = '$mail'";
    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
    if (mysqli_num_rows($result) == 1) {
        header('Location: error.php?ec=4'); // account already exists
        exit;
    }

    $date = date('Y-m-d');
    $query = "insert into customers(cName, password, email, cAddress, phoneNumber, registerDate, cType)";
    $query .= " values('$name', password('$pass'), '$mail', '$address', '$number', '$date', 'N')";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    header("location: login.php");
} else {
    DisplayErrors();
}
?>