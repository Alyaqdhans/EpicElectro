<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Login</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");

        if (isset($_SESSION['CID'])) {
            header('Location: error.php?ec=2'); //user is already logged in
            exit;
        }
        ?>

        <form class="form" action="loginProcess.php" method="post">
            <div class="main">
                <fieldset>
                    <legend>Login</legend>

                    <label>Email:</label>
                    <input type="text" name="mail" required>

                    <label>Password:</label>
                    <input type="password" name="pass" required>
                </fieldset>

                <h4>Don't have an account? <a href="register.php">Register</a></h4>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Login">
                    <input class="btn right" type="reset" value="Clear">
                </div>
            </div>
        </form>
        
        <?php include('footer.php'); ?>
    </body>
</html>