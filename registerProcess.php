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

if (preg_match("/^[0-9]+$/", $name)) {
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
    $query = "insert into customers(cName, password, email, cAddress, phoneNumber, registerDate, lastLogin, cType)";
    $query .= " values('$name', password('$pass'), '$mail', '$address', '$number', '$date', '0000-00-00', 'N')";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    $subject = "EpicElectro";
    $body    = "
    <html>
        <body>
            <fieldset style='border-radius: 10px; border: solid 3px black;'>
                <legend>
                <h1 style='margin: 0;'>
                👋 Welcome
                </h1>
                </legend>
    
                <h1>Thank you for registering on EpicElectro, we wish you happy shopping.</h1>
            </fieldset>
        </body>
    </html>
    ";
    email($subject, $body, $_POST['email'], false);

    header("location: login.php?s=1");
} else {
    DisplayErrors();
}
?>