<?php
switch ($_GET['ec']) {
    // login failure
    case 0:
    $message = "Your user name or password is incorrect!
    <a href=login.php>Please try again</a>";
    break;

    // session problem, for users who try to access a secured page without logging-in
    case 1:
    $message = "There was an authentication error, please
    <a href=login.php>log in</a> correctly.";
    break;

    // session problem - logging twice
    case 2:
    $message = "There was an authentication error. You should logout 
    first please <a href=logout.php>logout</a> or change the user.";
    break;

    // missing permission
    case 3;
    $message = "You dont have permission. Please
    <a href=logout.php>log in</a> using an admin account.";
    break;

    // default action
    default:
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
        <?php
        echo "<div class='error'>";
        echo "<h3 style='color:red;'>Could Not Login</h3><p>\n";
        echo "<h4> $message </h4>";
        echo "</div>";
        ?>
    </body>
</html>