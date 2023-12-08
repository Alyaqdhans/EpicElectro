<?php
$code = $_GET['ec'] ?? -1;
$page = "javascript:history.back()";

switch ($code) {
    // login failure
    case 0:
        $title = "Could Not Login";
        $message = "Your user name or password is incorrect, please try again.";
        break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
        $title = "Login Required";
        $message = "There was an authentication error, please <a href='login.php'>login</a> first.";
        break;

    // session problem - logging twice
    case 2:
        $title = "Already Logged In";
        $message = "There was an authentication error, please <a href='logout.php'>logout</a> and try again.";
        break;

    // missing permission
    case 3:
        $title = "Access Denied";
        $message = "You do not have permission, please <a href='logout.php'>logout</a> and login using an admin account.";
        break;

    // account already exist
    case 4:
        $title = "Account Exist";
        $message = "There is already an account registered with this email, please use another email.";
        break;

    // current password is incorrect
    case 5:
        $title = "Wrong Password";
        $message = "The current password registred does not match what you typed, please enter the correct password.";
        break;

    // cannot disable all suppliers/couriers
    case 6:
        $title = "Cannot Disable All";
        $message = "Please leave at least one for the website functionality.";
        if (isset($_GET["type"]) && $_GET["type"] == "s") {
            $page = "panelSupplier.php";
        } else if (isset($_GET["type"]) && $_GET["type"] == "c") {
            $page = "panelDelivery.php";
        }
        break;

    // more than available quantity in storage
    case 7:
        $item = $_GET['nm'] ?? 'item';
        $title = "Over Available Quantity";
        $message = "Please decrease the amount of '$item' because it is more than the available.";
        break;

    // cannot remove all admins
    case 8:
        $title = "Cannot Remove Admin";
        $message = "There must be at least one admin in the website.";
        break;

    // account doesnt exist
    case 9:
        $title = "Account Doesn't Exist";
        $message = "There is no account registred with this email, if you do not have an account please <a href='register.php'>register</a> a new one.";
        break;

    // account disabled
    case 10:
        $title = "Account Disabled";
        $message = "The account you are trying to access is disabled, please <a href='mailto:epicelectro.store@gmail.com'>contact</a> the support to activate it.";
        break;

    // register fail
    case 11:
        $title = "Registering Failed";
        $message = "Please check that the registered email is real or/and working.";
        break;

    // code doesn't exist
    case 12:
        $title = "Missing Record";
        $message = "The thing you're trying to access doesn't exist.";
        break;

    // other errors
    default:
    $title = "Unknown Error";
    $message = "There was an error performing the requested action.";
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
                <legend style='color: var(--red);'> <?php echo "$title"; ?> </legend>
                <?php echo "<h3> $message </h3>"; ?>
            </fieldset>
            <?php echo "<a id='eback' href='$page'> Go Back </a>"; ?>
        </div>
    </body>
</html>