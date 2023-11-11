<?php
switch ($_GET['ec']) {
    // login failure
    case 0:
        $title = "<legend style='color:red;'>Could Not Login</legend>";
        $message = "Your user name or password is incorrect!
        <a href=javascript:history.back()>Please try again</a>";
        break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
        $title = "<legend style='color:red;'>Login Required</legend>";
        $message = "There was an authentication error, please
        <a href=login.php>log in</a> first.";
        break;

    // session problem - logging twice
    case 2:
        $title = "<legend style='color:red;'>Already Logged In</legend>";
        $message = "There was an authentication error. 
        Please <a href=logout.php>logout</a> and try again.";
        break;

    // missing permission
    case 3:
        $title = "<legend style='color:red;'>Access Denied</legend>";
        $message = "You do not have permission. Please
        <a href=logout.php>logout</a> and login using an admin account.";
        break;

    // account already exist
    case 4:
        $title = "<legend style='color:red;'>Account Exist</legend>";
        $message = "There is already an account registered with this email. Please
        <a href=javascript:history.back()>enter</a> another email.";
        break;

    // old password is incorrect
    case 5:
        $title = "<legend style='color:red;'>Incorrect Password</legend>";
        $message = "The old password registred does not match what you typed. Please
        <a href=javascript:history.back()>enter</a> the correct old password.";
        break;

    // if it doesnt match any case
    default:
    $title = "<legend style='color:red;'>Unknown Login Error</legend>";
    $message = "There was an error performing the requested action. Please
    <a href=login.php>log in</a> again.";
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