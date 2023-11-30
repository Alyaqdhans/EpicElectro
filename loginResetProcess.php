<?php 
include("connect.php");
include("library.php");
session_start();

if (!isset($_POST['mail'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$mail = mysqli_real_escape_string($conn, $_POST['mail']);

$accounts = mysqli_query($conn, "select * from customers where email = '$mail'");
$account = mysqli_fetch_assoc($accounts);

if (mysqli_num_rows($accounts) == 0) {
    header('Location: error.php?ec=9'); // account doesnt exist
    exit;
}

if ($account['Active'] != 'active') {
    header('Location: error.php?ec=10'); // account is disabled
    exit;
}



// generating random 4-digit code and setting user's password to it
$code = rand(1000, 9999);
$query = "update customers set password = password('$code') where email = '$mail'";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));



// sending reset email to the customer
$to = $mail;
$subject = "EpicElectro Password Reset";
$receipt = "
<html>
    <body>
        <h1>A password reset request has been made</h1>

        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h2 style='margin: 0;'>
            Your Code
            </h2>
            </legend>

            <h1>$code</h1>
        </fieldset>

        <h3>After logging with this code please change your password in the `Profile` tab.</h3>
        <h3>*Note: If you didn't make this request please login with this code and change your password immediately.</h3>
    </body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: epicelectro.store@gmail.com" . "\r\n";

mail($to, $subject, $receipt, $headers);



header("Location: login.php");
?>