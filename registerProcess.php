<?php
    include("connect.php");
    include('library.php');
    
    $errors = [];

    if (empty($_POST['name'])) {$errors[] = "Please enter a name";}
    if (empty($_POST['password'])) {$errors[] = "Please enter a password";}
    if (empty($_POST['email'])) {$errors[] = "Please enter an email";}
    if (empty($_POST['address'])) {$errors[] = "Please enter an address";}
    if (empty($_POST['pnumber'])) {$errors[] = "Please enter a phone number";}

    if (count($errors) == 0) {
        $query = "insert into customers(cName, password, email, cAddress, phoneNumber, cType)";
        $query .= " values('{$_POST['name']}', password('{$_POST['password']}'), '{$_POST['email']}', '{$_POST['address']}', '{$_POST['pnumber']}', 2)";
        $r = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <br>". mysqli_error($conn));
        header("location: login.php");
    } else {
        DisplayErrors();
    }
?>