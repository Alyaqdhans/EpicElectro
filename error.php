<?php
switch ($_GET['ec']) {
    // login failure
    case 0:
        $title = "Could Not Login";
        $message = "Your user name or password is incorrect, please try again.";
        break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
        $title = "Login Required";
        $message = "There was an authentication error, please log in first.";
        break;

    // session problem - logging twice
    case 2:
        $title = "Already Logged In";
        $message = "There was an authentication error, please logout and try again.";
        break;

    // missing permission
    case 3:
        $title = "Access Denied";
        $message = "You do not have permission, please logout and login using an admin account.";
        break;

    // account already exist
    case 4:
        $title = "Account Exist";
        $message = "There is already an account registered with this email, please use another email.";
        break;

    // old password is incorrect
    case 5:
        $title = "Incorrect Password";
        $message = "The old password registred does not match what you typed, please enter the correct old password.";
        break;

    // cannot delete all supplierss
    case 6:
        $title = "Cannot Delete All";
        $message = "Please leave at least one supplier for the items.";
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
                <legend style='color:red;'> <?php echo "$title"; ?> </legend>
                <?php echo "<h3> $message </h3>"; ?>
            </fieldset>
            <a href='javascript:history.back()'> Go Back </a>
        </div>
    </body>
</html>