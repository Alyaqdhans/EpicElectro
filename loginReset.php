<?php
session_start();
if (isset($_SESSION['CID'])) {
    header('Location: error.php?ec=2'); //user is already logged in
    exit;
}
?>
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Login</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>

        <form class="form" action="loginResetProcess.php" method="post" onsubmit="loading();">
            <div class="main">
                <fieldset>
                    <legend>Reset Password</legend>

                    <label>
                        Email:<br>
                        <input type="text" name="mail" required>
                    </label>

                    <label>You will receive a temporary password<br> in your email, use it to login.</label>
                </fieldset>

                <div class="buttons">
                    <input id="sb" class="btn left" type="submit" value="Send">
                    <a class="btn right" href="login.php">Cancel</a>
                </div>
            </div>
        </form>
        
        <?php include('footer.php'); ?>
    </body>
</html>