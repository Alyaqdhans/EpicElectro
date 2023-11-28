<?php
include("connect.php");

switch ($_GET['ec']) {
    // login failure
    case 0:
        $title = "Could Not Login";
        $message = "Your user name or password is incorrect, please try again.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
        $title = "Login Required";
        $message = "There was an authentication error, please log in first.";
        $btn = "<a href='login.php'> Login </a>";
        break;

    // session problem - logging twice
    case 2:
        $title = "Already Logged In";
        $message = "There was an authentication error, please logout and try again.";
        $btn = "<a href='logout.php'> Logout </a>";
        break;

    // missing permission
    case 3:
        $title = "Access Denied";
        $message = "You do not have permission, please logout and login using an admin account.";
        $btn = "<a href='logout.php'> Logout </a>";
        break;

    // account already exist
    case 4:
        $title = "Account Exist";
        $message = "There is already an account registered with this email, please use another email.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // old password is incorrect
    case 5:
        $title = "Incorrect Password";
        $message = "The old password registred does not match what you typed, please enter the correct old password.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // cannot delete all suppliers/dilvers
    case 6:
        $title = "Cannot Delete All";
        $message = "Please leave at least one for the website functionality.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // more than available quantity in storage
    case 7:
        $item = mysqli_fetch_row(mysqli_query($conn, "select iDesc from items where iCode = {$_GET['ic']}"))[0];
        $title = "Over Available Quantity";
        $message = "Please decrease the amount of '$item' because it is more than the available.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // cannot remove all admins
    case 8:
        $title = "Cannot Remove Admin";
        $message = "There must be at least one admin in the website.";
        $btn = "<a href='panelAdmin.php'> Back </a>";
        break;

    // account doesnt exist
    case 9:
        $title = "Account Doesn't Exist";
        $message = "There is no account registred with this email, make sure you typed it correctly.";
        $btn = "<a href='javascript:history.back()'> Back </a>";
        break;

    // other errors
    default:
    $title = "Unknown Error";
    $message = "There was an error performing the requested action.";
    $btn = "<a href='javascript:history.back()'> Back </a>";
    break;
}
?>

<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Error</title>
    </head>
    <body>
        <div class='error'>
            <fieldset>
                <legend style='color:red;'> <?php echo "$title"; ?> </legend>
                <?php echo "<h3> $message </h3>"; ?>
            </fieldset>
            <?php echo $btn ?>
            <!-- <a href='javascript:history.back()'> Go Back </a> -->
        </div>
    </body>
</html>