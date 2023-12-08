<?php
include("connect.php");
include("library.php");
session_start();

if (!isset($_POST['password'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

$pass = mysqli_real_escape_string($conn, $_POST['password']);

$query = "select * from customers where password = password('$pass') and cId = {$_SESSION['CID']}";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
if (mysqli_num_rows($result) == 0) {
    header('Location: error.php?ec=5'); // current password is incorrect
    exit;
}

$query = "update customers set";
$query .= " Active = 'disabled'";
$query .= " where cId = '{$_SESSION['CID']}'";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

$subject = "EpicElectro Account Disabled";
$body    = "
<html>
    <body>
        <fieldset style='border-radius: 10px; border: solid 3px black;'>
            <legend>
            <h1 style='margin: 0;'>❗ Notice</h1>
            </legend>

            <h2>Your account in EpicElectro has been disabled, if this wasn't done by you please 
            <a href='mailto:epicelectro.store@gmail.com'>contact</a> support.</h2>
        </fieldset>
    </body>
</html>
";
email($subject, $body, $_SESSION['MAIL'], false);

// logout user
session_unset();
session_destroy();

header('Location: login.php?d');
?>