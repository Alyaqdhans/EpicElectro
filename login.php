<html>
    <head>
        <?php include('link.php') ?>
        <title>Login</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form action="loginProcess.php" method="post">
            <div class="main">
                <fieldset>
                    <legend>Login</legend>

                    <label>Email:</label>
                    <input type="text" name="mail">

                    <label>Password:</label>
                    <input type="password" name="pass">
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