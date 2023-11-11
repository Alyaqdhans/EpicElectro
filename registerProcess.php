<?php
    include("connect.php");
    include('library.php');
    
    $errors = [];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mail = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['passwordConfirm']);
    $number = mysqli_real_escape_string($conn, $_POST['pnumber']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if (empty($name)) {$errors[] = "Please enter a name";}

    if (empty($pass) || empty($pass2)) {
        $errors[] = "Please enter a password & confirm it";
    } else {
        if ($pass != $pass2) {
            $errors[] = "Please make sure you typed the same password";
        }
    }

    if (empty($mail)) {
        $errors[] = "Please enter an email";
    } else {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email";
        }
    }

    if (empty($address)) {$errors[] = "Please enter an address";}
    
    if (empty($number)) {
        $errors[] = "Please enter a phone number";
    } else {
        if ($number < 1 || !preg_match("/^[9|7][0-9]{7}$/", $number)) {
            $errors[] = "Please enter a valid phone number";
        }
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