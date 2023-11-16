<?php
switch ($_GET['ec']) {
    // login failure
    case 0:
        $title = "<legend style='color:red;'> Could Not Login </legend>";
        $message = "Your user name or password is incorrect,
        <a href=javascript:history.back()> please try again </a>";
        break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
        $title = "<legend style='color:red;'> Login Required </legend>";
        $message = "There was an authentication error,
        <a href=login.php> please log in first </a>";
        break;

    // session problem - logging twice
    case 2:
        $title = "<legend style='color:red;'> Already Logged In </legend>";
        $message = "There was an authentication error,
        <a href=logout.php> please logout and try again </a>";
        break;

    // missing permission
    case 3:
        $title = "<legend style='color:red;'> Access Denied </legend>";
        $message = "You do not have permission,
        <a href=logout.php> please logout and login using an admin account </a>";
        break;

    // account already exist
    case 4:
        $title = "<legend style='color:red;'> Account Exist </legend>";
        $message = "There is already an account registered with this email,
        <a href=javascript:history.back()> please use another email </a>";
        break;

    // old password is incorrect
    case 5:
        $title = "<legend style='color:red;'> Incorrect Password </legend>";
        $message = "The old password registred does not match what you typed,
        <a href=javascript:history.back()> please enter the correct old password </a>";
        break;

    // other errors
    default:
    $title = "<legend style='color:red;'> Unknown Error </legend>";
    $message = "There was an error performing the requested action,
    <a href=javascript:history.back()>please try again</a>";
    break;
}
?>

<html>
    <head>
        <?php include('link.php') ?>
        <title>Error</title>
    </head>
    <body>
        <div class='error'>
            <fieldset>
                <?php echo "$title"; ?>
                <?php echo "<h3> $message </h3>"; ?>
            </fieldset>
        </div>
    </body>
</html>