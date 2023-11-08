<html>
    <header>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="loginStyle.css">
    </header>
    <body>
        <?php $file = __FILE__;
        include('header.php'); ?>
        <form action="loginProcess.php" method="post">
            <div class="main">
                <h2>Login</h2>
                <input type="text" placeholder="Username" name="user">
                <input type="password" placeholder="Password" name="pass">
                <div class="buttons">
                    <input class="btn left" type="submit" value="Login">
                    <input class="btn right" type="reset" value="Clear">
                </div>
            </div>
        </form>
        <?php include('footer.php'); ?>
    </body>
</html>