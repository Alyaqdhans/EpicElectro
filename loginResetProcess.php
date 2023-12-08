<?php 
include("connect.php");
include("library.php");
session_start();

if (!isset($_POST['mail'])) {
    header('Location: error.php'); // trying to access process from address bar
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



// generating random 8-digit code and setting user's password to it
$code = rand(10000000, 99999999);
$query = "update customers set password = password('$code') where email = '$mail'";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));



// sending reset email to the customer
$subject = "EpicElectro Password Reset";
$body    = "
<html>
    <body>
        <h1>🔑 A password reset request has been made</h1>

        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h2 style='margin: 0;'>Your Temporary Password</h2>
            </legend>

            <h1>$code</h1>
        </fieldset>

        <h3 style='color: red;'>After logging in with this password please change it in the `Profile` tab immediately.</h3>
    </body>
</html>
";
email($subject, $body, $_POST['mail'], false);



header("Location: login.php?r");
?>