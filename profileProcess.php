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
        $query = "update customers set";
        $query .= " cName = '{$_POST['name']}',";
        $query .= " password = password('{$_POST['password']}'),";
        $query .= " email = '{$_POST['email']}',";
        $query .= " cAddress = '{$_POST['address']}',";
        $query .= " phoneNumber = {$_POST['pnumber']}";
        $query .= " where cId = '{$_POST['cid']}'";

        $r = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <br>". mysqli_error($conn));
        header("location: profile.php");
    } else {
        DisplayErrors();
    }
?>