<html>
    <header>
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </header>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form action="loginProcess.php" method="post">
            <div class="main">
                <h2>Login</h2>

                <label>Email: </label>
                <input type="text" name="mail">

                <label>Password: </label>
                <input type="password" name="pass">

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