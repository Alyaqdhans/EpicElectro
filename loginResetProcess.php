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



// generating random 8-digit code and setting user's password to it
$code = rand(10000000, 99999999);
$query = "update customers set password = password('$code') where email = '$mail'";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));



// sending reset email to the customer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP(); 
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;                               //Enable SMTP authentication
$mail->Username   = 'epicelectro.store@gmail.com';                     //SMTP username
$mail->Password   = 'xsxgnggiwwkmgmic';                               //SMTP password

//Recipients
$mail->setFrom('epicelectro.store@gmail.com');
$mail->addAddress($_POST['mail']);     //Add a recipient

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = "EpicElectro Password Reset";
$mail->Body    = "
<html>
    <body>
        <h1>A password reset request has been made</h1>

        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h2 style='margin: 0;'>
            Your Temporary Password
            </h2>
            </legend>

            <h1>$code</h1>
        </fieldset>

        <h3 style='color: red;'>After logging in with this password please change it in the `Profile` tab immediately.</h3>
    </body>
</html>
";

$mail->send();



header("Location: login.php?r=1");
?>