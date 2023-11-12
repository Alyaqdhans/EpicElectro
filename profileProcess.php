<?php
    include("connect.php");
    include('library.php');
    
    $errors = [];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mail = mysqli_real_escape_string($conn, $_POST['email']);
    $pass0 = mysqli_real_escape_string($conn, $_POST['passwordOld']);
    $pass = mysqli_real_escape_string($conn, $_POST['passwordNew']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['passwordConfirm']);
    $number = mysqli_real_escape_string($conn, $_POST['pnumber']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if (empty($name)) {
        $errors[] = "Please enter a name";
    } else {
        if (!preg_match("/^[a-zA-Z\-\s]{3-20}$/", $name)) {
            $errors[] = "Please enter a valid name";
        }
    }

    if (empty($pass) || empty($pass2) || empty($pass0)) {
        $errors[] = "Please enter the old password, new password & confirm it";
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
        $query = "select * from customers where password = password('$pass0')";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        if (mysqli_num_rows($result) == 0) {
            header('Location: error.php?ec=5'); // old password is incorrect
            exit;
        }

        $query = "select * from customers where cId = '{$_POST['cid']}'";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        $customer = mysqli_fetch_assoc($result);
        if ($customer['email'] != $mail) { // check if user change email
            $query = "select * from customers where email = '$mail'";
            $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
            if (mysqli_num_rows($result) == 1) {
                header('Location: error.php?ec=4'); // account already exists
                exit;
            }
        }

        $query = "update customers set";
        $query .= " cName = '$name',";
        $query .= " password = password('$pass'),";
        $query .= " email = '$mail',";
        $query .= " cAddress = '$address',";
        $query .= " phoneNumber = $number";
        $query .= " where cId = '{$_POST['cid']}'";
        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

        header("location: index.php");
    } else {
        DisplayErrors();
    }
?>